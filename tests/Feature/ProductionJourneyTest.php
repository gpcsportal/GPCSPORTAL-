<?php

namespace Tests\Feature;

use App\Models\Note;
use App\Models\Paper;
use App\Models\PortalNotification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductionJourneyTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_paper_journey_login_upload_moderate_download_and_logout(): void
    {
        Storage::fake('public');

        $student = User::create($this->userAttributes([
            'email' => 'journey-student@example.com',
            'role' => 'student',
        ]));
        $admin = User::create($this->userAttributes([
            'email' => 'journey-admin@example.com',
            'role' => 'admin',
            'admin_identifier' => 'journey-admin',
        ]));

        $this->postJson('/login', [
            'email' => $student->email,
            'password' => 'password123',
            'role' => 'student',
            'redirect' => '/#upload',
        ])->assertOk()->assertJson(['redirect' => '/#upload']);

        $upload = $this->postJson('/papers', [
            'file' => UploadedFile::fake()->create('computer-networks.pdf', 120, 'application/pdf'),
            'paper_code' => 'TEST-403',
            'subject_code' => '403',
            'paper_name' => 'Computer Networks',
            'subject_name' => 'Computer Networks',
            'branch' => 'CS',
            'semester' => 'Semester IV',
            'year' => 2026,
            'session' => 'June 2026',
        ])->assertCreated();

        $paper = Paper::findOrFail($upload->json('id'));
        $this->assertSame('pending', $paper->status);
        Storage::disk('public')->assertExists($paper->file_path);

        $this->actingAs($admin)
            ->patch('/admin/content/papers/'.$paper->id.'/status', ['status' => 'approved'])
            ->assertRedirect();

        $this->actingAs($student)
            ->getJson('/api/papers')
            ->assertOk()
            ->assertJsonFragment(['id' => $paper->id, 'paper_name' => 'Computer Networks']);

        $this->actingAs($student)
            ->get('/papers/'.$paper->id.'/download')
            ->assertOk()
            ->assertHeader('content-disposition');

        $this->actingAs($student)->post('/logout')->assertRedirect('/?logged_out=1#home');
        $this->assertGuest();
        $this->getJson('/api/papers')->assertUnauthorized();
    }

    public function test_faculty_notes_journey_login_upload_moderate_download_and_logout(): void
    {
        Storage::fake('public');

        $faculty = User::create($this->userAttributes([
            'email' => 'journey-faculty@example.com',
            'role' => 'faculty',
        ]));
        $admin = User::create($this->userAttributes([
            'email' => 'journey-admin2@example.com',
            'role' => 'admin',
            'admin_identifier' => 'journey-admin2',
        ]));

        $this->postJson('/login', [
            'email' => $faculty->email,
            'password' => 'password123',
            'role' => 'faculty',
            'redirect' => '/#notes',
        ])->assertOk()->assertJson(['redirect' => '/#notes']);

        $upload = $this->postJson('/notes', [
            'branch' => 'CS',
            'semester' => 'Semester III',
            'year' => 2026,
            'subject_name' => 'Scripting Languages',
            'subject_code' => '302',
            'title' => 'Unit 1 Notes',
            'description' => 'Production journey test notes.',
            'attachment' => UploadedFile::fake()->create('unit-1.pdf', 120, 'application/pdf'),
        ])->assertCreated();

        $note = Note::findOrFail($upload->json('id'));
        $this->assertSame('pending', $note->status);
        Storage::disk('public')->assertExists($note->attachment_path);

        $this->actingAs($admin)
            ->patch('/admin/content/notes/'.$note->id.'/status', ['status' => 'approved'])
            ->assertRedirect();

        $this->actingAs($faculty)
            ->getJson('/api/notes')
            ->assertOk()
            ->assertJsonFragment(['id' => $note->id, 'title' => 'Unit 1 Notes']);

        $this->actingAs($faculty)
            ->get('/notes/'.$note->id.'/download')
            ->assertOk()
            ->assertHeader('content-disposition');

        $this->actingAs($faculty)->post('/logout')->assertRedirect('/?logged_out=1#home');
        $this->assertGuest();
        $this->getJson('/api/notes')->assertUnauthorized();
    }

    public function test_upload_size_limits_are_enforced_by_server_rules(): void
    {
        Storage::fake('public');
        $user = User::create($this->userAttributes(['email' => 'limits@example.com']));

        config()->set('gpcs_uploads.paper_max_mb', 1);
        config()->set('gpcs_uploads.notes_max_mb', 1);

        $this->actingAs($user)
            ->postJson('/papers', [
                'file' => UploadedFile::fake()->create('too-large.pdf', 2048, 'application/pdf'),
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['file']);

        $this->actingAs($user)
            ->postJson('/notes', [
                'branch' => 'CS',
                'semester' => 'Semester I',
                'year' => 2026,
                'subject_name' => 'Test Subject',
                'subject_code' => 'T-101',
                'attachment' => UploadedFile::fake()->create('too-large-notes.pdf', 2048, 'application/pdf'),
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['attachment']);
    }

    public function test_digital_board_respects_audience_and_handles_empty_result(): void
    {
        $student = User::create($this->userAttributes([
            'email' => 'board-student@example.com',
            'role' => 'student',
        ]));
        $faculty = User::create($this->userAttributes([
            'email' => 'board-faculty@example.com',
            'role' => 'faculty',
        ]));
        $admin = User::create($this->userAttributes([
            'email' => 'board-admin@example.com',
            'role' => 'admin',
            'admin_identifier' => 'board-admin',
        ]));

        $this->actingAs($student)->getJson('/api/notifications')->assertOk()->assertExactJson([]);

        PortalNotification::create([
            'admin_id' => $admin->id,
            'audience' => 'all',
            'title' => 'College Notice',
            'message' => 'Visible to all portal users.',
        ]);
        PortalNotification::create([
            'admin_id' => $admin->id,
            'audience' => 'students',
            'title' => 'Student Notice',
            'message' => 'Student-only notice.',
        ]);
        PortalNotification::create([
            'admin_id' => $admin->id,
            'audience' => 'faculty',
            'title' => 'Faculty Notice',
            'message' => 'Faculty-only notice.',
        ]);

        $studentResponse = $this->actingAs($student)->getJson('/api/notifications')->assertOk();
        $studentResponse->assertJsonFragment(['title' => 'College Notice']);
        $studentResponse->assertJsonFragment(['title' => 'Student Notice']);
        $studentResponse->assertJsonMissing(['title' => 'Faculty Notice']);

        $facultyResponse = $this->actingAs($faculty)->getJson('/api/notifications')->assertOk();
        $facultyResponse->assertJsonFragment(['title' => 'College Notice']);
        $facultyResponse->assertJsonFragment(['title' => 'Faculty Notice']);
        $facultyResponse->assertJsonMissing(['title' => 'Student Notice']);
    }

    public function test_admin_login_dashboard_and_logout_real_flow(): void
    {
        $admin = User::create($this->userAttributes([
            'email' => 'real-admin@example.com',
            'role' => 'admin',
            'admin_identifier' => 'real-admin',
        ]));

        $this->post('/admin/hidden-login', [
            'admin_login' => $admin->admin_identifier,
            'password' => 'password123',
        ])->assertRedirect('/admin');

        $this->get('/admin')->assertOk()->assertSee('Admin Dashboard');

        $this->post('/admin/logout')->assertRedirect('/?logged_out=1#home');
        $this->assertGuest();
    }

    private function userAttributes(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Journey',
            'surname' => 'User',
            'email' => 'journey@example.com',
            'password' => 'password123',
            'role' => 'student',
            'gender' => 'Male',
            'college_name' => 'Government Polytechnic College Shivpuri',
            'address' => 'Shivpuri',
            'is_active' => true,
        ], $overrides);
    }
}
