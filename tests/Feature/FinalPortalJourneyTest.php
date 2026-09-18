<?php

namespace Tests\Feature;

use App\Models\Note;
use App\Models\Paper;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FinalPortalJourneyTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_and_faculty_can_login_reach_intended_feature_and_logout(): void
    {
        foreach (['student', 'faculty'] as $role) {
            $user = User::create($this->userAttributes([
                'email' => "{$role}-journey@example.com",
                'role' => $role,
            ]));

            $this->postJson('/login', [
                'email' => $user->email,
                'password' => 'password123',
                'role' => $role,
                'redirect' => '/#notes',
            ])->assertOk()->assertJson([
                'role' => $role,
                'redirect' => '/#notes',
            ]);

            $this->getJson('/api/notes')->assertOk();

            $this->post('/logout')
                ->assertRedirect('/?logged_out=1#home');

            $this->assertGuest();
            $this->getJson('/api/notes')->assertUnauthorized();
        }
    }

    public function test_admin_can_login_open_dashboard_and_logout(): void
    {
        $admin = User::create($this->userAttributes([
            'email' => 'admin-journey@example.com',
            'role' => 'admin',
            'admin_identifier' => 'journey-admin',
        ]));

        $this->post('/admin/hidden-login', [
            'admin_login' => $admin->admin_identifier,
            'password' => 'password123',
        ])->assertRedirect(route('admin.dashboard'));

        $this->get('/admin')
            ->assertOk()
            ->assertSee('Logout');

        $this->post('/admin/logout')
            ->assertRedirect('/?logged_out=1#home');

        $this->assertGuest();
        $this->get('/admin')->assertRedirect();
    }

    public function test_paper_upload_limit_save_and_download_flow(): void
    {
        Storage::fake('public');
        config()->set('gpcs_uploads.volume_capacity_mb', 0);

        $student = User::create($this->userAttributes([
            'email' => 'paper-journey@example.com',
        ]));

        $tooLarge = UploadedFile::fake()->create(
            'too-large.docx',
            (100 * 1024) + 1,
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        );

        $this->actingAs($student)
            ->postJson('/papers', [
                'file' => $tooLarge,
                'branch' => 'CS',
                'semester' => 'I',
                'year' => 2026,
                'paper_name' => 'Oversize Paper',
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('file');

        // Use a real in-memory image payload for the successful write path;
        // UploadedFile::fake()->create() can report a logical size while its
        // temporary file remains empty, which is correctly rejected by the
        // production post-write integrity check.
        $file = UploadedFile::fake()->image('scripting-language.jpg', 320, 240);

        $response = $this->actingAs($student)
            ->postJson('/papers', [
                'file' => $file,
                'branch' => 'CS',
                'semester' => 'I',
                'year' => 2026,
                'paper_code' => 'CS101',
                'paper_name' => 'Scripting Language',
                'session' => '2026',
            ])
            ->assertCreated();

        $paper = Paper::findOrFail($response->json('id'));
        $this->assertSame('pending', $paper->status);
        Storage::disk('public')->assertExists($paper->file_path);

        $paper->update(['status' => 'approved']);

        $this->actingAs($student)
            ->get(route('papers.download', $paper))
            ->assertOk();
    }

    public function test_notes_upload_limit_save_and_download_flow(): void
    {
        Storage::fake('public');
        config()->set('gpcs_uploads.volume_capacity_mb', 0);

        $faculty = User::create($this->userAttributes([
            'email' => 'notes-journey@example.com',
            'role' => 'faculty',
        ]));

        $tooLarge = UploadedFile::fake()->create(
            'too-large.pdf',
            (200 * 1024) + 1,
            'application/pdf'
        );

        $base = [
            'branch' => 'CS',
            'semester' => 'I',
            'year' => 2026,
            'subject_name' => 'Computer Fundamentals',
            'subject_code' => 'CS102',
            'title' => 'Unit 1 Notes',
        ];

        $this->actingAs($faculty)
            ->postJson('/notes', $base + ['attachment' => $tooLarge])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('attachment');

        $image = UploadedFile::fake()->image('unit-1.jpg', 320, 240);

        $response = $this->actingAs($faculty)
            ->postJson('/notes', $base + ['attachment' => $image])
            ->assertCreated();

        $note = Note::findOrFail($response->json('id'));
        $this->assertSame('pending', $note->status);
        Storage::disk('public')->assertExists($note->attachment_path);

        $note->update(['status' => 'approved']);

        $this->actingAs($faculty)
            ->get(route('notes.download', $note))
            ->assertOk();
    }

    public function test_digital_board_feature_is_completely_removed(): void
    {
        $bridge = (string) file_get_contents(public_path('assets/gpcs-backend-bridge.js'));
        $adminLayout = (string) file_get_contents(resource_path('views/admin/layout.blade.php'));

        $this->assertStringNotContainsString('gpcs-digital-board', $bridge);
        $this->assertStringNotContainsString('loadDigitalBoard', $bridge);
        $this->assertStringNotContainsString('admin.notifications', $adminLayout);
        $this->assertFalse(\Illuminate\Support\Facades\Route::has('portal.notifications'));
        $this->assertFalse(\Illuminate\Support\Facades\Route::has('admin.notifications.index'));
        $this->assertFalse(\Illuminate\Support\Facades\Schema::hasTable('portal_notifications'));
        $this->get('/api/notifications')->assertNotFound();
        $this->get('/admin/notifications')->assertNotFound();
    }

    public function test_retired_frontend_endpoints_are_not_referenced_by_the_portal_template(): void
    {
        $template = (string) file_get_contents(resource_path('views/portal.blade.php'));

        $this->assertStringNotContainsString("fetch('chunk_upload.php'", $template);
        $this->assertStringNotContainsString("papers_api.php", $template);
        $this->assertStringNotContainsString("download.php?type=paper", $template);
    }

    private function userAttributes(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Portal',
            'surname' => 'User',
            'email' => 'portal-journey@example.com',
            'password' => 'password123',
            'role' => 'student',
            'gender' => 'Male',
            'college_name' => 'Government Polytechnic College Shivpuri',
            'address' => 'Shivpuri',
            'is_active' => true,
        ], $overrides);
    }
}
