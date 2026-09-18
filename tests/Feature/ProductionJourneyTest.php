<?php

namespace Tests\Feature;

use App\Models\Paper;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductionJourneyTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_full_journey_login_upload_admin_approve_download_logout(): void
    {
        Storage::fake('public');

        $student = User::create($this->userAttributes([
            'email' => 'journey.student@example.com',
            'role' => 'student',
        ]));

        $admin = User::create($this->userAttributes([
            'email' => 'journey.admin@example.com',
            'role' => 'admin',
            'admin_identifier' => 'journey-admin',
        ]));

        $this->postJson('/login', [
            'email' => $student->email,
            'password' => 'password123',
            'role' => 'student',
            'redirect' => '/#upload',
        ])->assertOk()->assertJson([
            'role' => 'student',
            'redirect' => '/#upload',
        ]);

        $upload = $this->postJson('/papers', [
            'file' => UploadedFile::fake()->image('student-paper.png', 80, 80),
            'paper_code' => 'CS-101',
            'subject_code' => 'CS-101',
            'paper_name' => 'Production Journey Paper',
            'subject_name' => 'Computer Fundamentals',
            'branch' => 'CS',
            'semester' => 'I',
            'year' => 2026,
            'session' => '2026',
        ])->assertCreated()->assertJsonStructure(['message', 'id']);

        $paper = Paper::findOrFail((int) $upload->json('id'));
        $this->assertSame('pending', $paper->status);
        Storage::disk('public')->assertExists($paper->file_path);

        $this->post('/logout')->assertRedirect('/?logged_out=1#home');
        $this->assertGuest();

        $this->post('/admin/hidden-login', [
            'admin_login' => 'journey-admin',
            'password' => 'password123',
        ])->assertRedirect('/admin');

        $this->patch("/admin/content/papers/{$paper->id}/status", [
            'status' => 'approved',
        ])->assertRedirect();

        $paper->refresh();
        $this->assertSame('approved', $paper->status);

        $this->get(route('papers.download', $paper, false))
            ->assertOk()
            ->assertHeader('content-disposition');

        $this->post('/admin/logout')->assertRedirect('/?logged_out=1#home');
        $this->assertGuest();

        $this->getJson('/api/papers')->assertUnauthorized();
    }

    public function test_faculty_can_upload_notes_and_download_after_approval(): void
    {
        Storage::fake('public');

        $faculty = User::create($this->userAttributes([
            'email' => 'journey.faculty@example.com',
            'role' => 'faculty',
        ]));

        $this->actingAs($faculty);

        $upload = $this->postJson('/notes', [
            'branch' => 'CS',
            'semester' => 'II',
            'year' => 2026,
            'subject_name' => 'Scripting Language',
            'subject_code' => 'CS-202',
            'title' => 'Unit 1 Notes',
            'description' => 'Production regression notes.',
            'attachment' => UploadedFile::fake()->image('notes.png', 80, 80),
        ])->assertCreated()->assertJsonStructure(['message', 'id']);

        $note = \App\Models\Note::findOrFail((int) $upload->json('id'));
        Storage::disk('public')->assertExists($note->attachment_path);

        $note->update(['status' => 'approved']);

        $this->get(route('notes.download', $note, false))
            ->assertOk()
            ->assertHeader('content-disposition');

        $this->post('/logout')->assertRedirect('/?logged_out=1#home');
        $this->assertGuest();
        $this->getJson('/api/notes')->assertUnauthorized();
    }

    public function test_upload_size_limits_block_oversized_files_before_storage(): void
    {
        Storage::fake('public');
        config()->set('gpcs_uploads.paper_max_mb', 1);
        config()->set('gpcs_uploads.notes_max_mb', 1);

        $student = User::create($this->userAttributes([
            'email' => 'limits@example.com',
            'role' => 'student',
        ]));

        $this->actingAs($student);

        $this->postJson('/papers', [
            'file' => UploadedFile::fake()->create('too-large.pdf', 2048, 'application/pdf'),
        ])->assertUnprocessable()->assertJsonValidationErrors(['file']);

        $this->postJson('/notes', [
            'branch' => 'CS',
            'semester' => 'I',
            'year' => 2026,
            'subject_name' => 'Computer Fundamentals',
            'subject_code' => 'CS-101',
            'attachment' => UploadedFile::fake()->create('too-large.pdf', 2048, 'application/pdf'),
        ])->assertUnprocessable()->assertJsonValidationErrors(['attachment']);

        $this->assertEmpty(Storage::disk('public')->allFiles());
    }

    public function test_login_wall_preserves_deep_link_and_rejects_external_redirects(): void
    {
        $student = User::create($this->userAttributes([
            'email' => 'deep.student@example.com',
            'role' => 'student',
        ]));

        $guest = $this->get('/go/syllabus');
        $guest->assertRedirect();
        $this->assertStringContainsString('redirect=%2Fgo%2Fsyllabus', (string) $guest->headers->get('Location'));

        $this->postJson('/login', [
            'email' => $student->email,
            'password' => 'password123',
            'role' => 'student',
            'redirect' => '/#notes',
        ])->assertOk()->assertJson(['redirect' => '/#notes']);

        $this->post('/logout')->assertRedirect('/?logged_out=1#home');

        $this->postJson('/login', [
            'email' => $student->email,
            'password' => 'password123',
            'role' => 'student',
            'redirect' => 'https://evil.example/steal',
        ])->assertOk()->assertJson(['redirect' => '/#student-dashboard']);
    }

    private function userAttributes(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Production',
            'surname' => 'Tester',
            'email' => 'production@example.com',
            'password' => 'password123',
            'role' => 'student',
            'gender' => 'Male',
            'college_name' => 'Government Polytechnic College Shivpuri',
            'address' => 'Shivpuri',
            'is_active' => true,
        ], $overrides);
    }
}
