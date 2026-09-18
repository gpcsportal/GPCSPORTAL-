<?php

namespace Tests\Feature;

use App\Models\GalleryImage;
use App\Models\Note;
use App\Models\Paper;
use App\Models\SubjectMaster;
use App\Models\User;
use App\Services\PortalSettingsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminControlAuditTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_and_faculty_cannot_access_sensitive_admin_routes(): void
    {
        foreach (['student', 'faculty'] as $role) {
            $user = User::create($this->userAttributes([
                'email' => $role.'-blocked@example.com',
                'role' => $role,
            ]));

            $this->actingAs($user);

            foreach ([
                '/admin',
                '/admin/users',
                '/admin/settings',
                '/admin/subjects',
                '/admin/content/papers',
                '/admin/content/notes',
                '/admin/content/gallery',
                '/admin/reports',
                '/admin/logs',
                '/admin/account',
            ] as $path) {
                $this->get($path)->assertForbidden();
            }

            auth()->logout();
        }
    }

    public function test_admin_settings_apply_immediately_to_limits_branches_links_and_login_wall(): void
    {
        $admin = $this->admin();
        $this->actingAs($admin);

        $this->put('/admin/settings', $this->settingsPayload([
            'paper_max_mb' => 5,
            'notes_max_mb' => 10,
            'gallery_max_mb' => 3,
            'branches' => 'CS, ME, EE, ET, CE',
            'login_wall_enabled' => 0,
        ]))->assertSessionHasNoErrors();

        $settings = app(PortalSettingsService::class);
        $this->assertSame(5, $settings->paperMaxMb());
        $this->assertSame(10, $settings->notesMaxMb());
        $this->assertSame(3, $settings->galleryMaxMb());
        $this->assertContains('CE', $settings->branches());
        $this->assertFalse($settings->loginWallEnabled());

        auth()->logout();

        $this->getJson('/api/papers')->assertOk();
        $this->postJson('/papers', [])->assertUnauthorized();

        $this->actingAs($admin)
            ->put('/admin/settings', $this->settingsPayload([
                'paper_max_mb' => 1,
                'notes_max_mb' => 10,
                'gallery_max_mb' => 3,
                'branches' => 'CS, ME, EE, ET, CE',
                'login_wall_enabled' => 1,
            ]))->assertSessionHasNoErrors();

        auth()->logout();
        $this->getJson('/api/papers')->assertUnauthorized();

        $student = User::create($this->userAttributes([
            'email' => 'dynamic-limit@example.com',
            'branch' => 'CE',
        ]));

        $this->actingAs($student)
            ->postJson('/papers', [
                'file' => UploadedFile::fake()->create('too-large.pdf', 2048, 'application/pdf'),
                'branch' => 'CE',
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('file');
    }

    public function test_admin_can_create_edit_suspend_and_delete_users_without_losing_academic_content(): void
    {
        $admin = $this->admin();
        $this->actingAs($admin);

        $this->post('/admin/users', [
            'role' => 'student',
            'name' => 'Managed',
            'surname' => 'Student',
            'email' => 'managed@example.com',
            'mobile' => '9999999999',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'gender' => 'Male',
            'college_name' => 'Government Polytechnic College Shivpuri',
            'college_year' => '1st Year',
            'branch' => 'CS',
            'semester' => 'I',
            'address' => 'Shivpuri',
            'is_active' => 1,
        ])->assertRedirect(route('admin.users.index'));

        $managed = User::where('email', 'managed@example.com')->firstOrFail();
        $this->assertTrue(Hash::check('password123', $managed->password));

        $this->put(route('admin.users.update', $managed), [
            'role' => 'faculty',
            'name' => 'Managed',
            'surname' => 'Faculty',
            'email' => 'managed@example.com',
            'mobile' => '9999999999',
            'password' => '',
            'password_confirmation' => '',
            'gender' => 'Male',
            'college_name' => 'Government Polytechnic College Shivpuri',
            'subject_department' => 'Computer Science',
            'employee_id' => 'FAC-01',
            'address' => 'Shivpuri',
            'is_active' => 1,
        ])->assertRedirect(route('admin.users.index'));

        $managed->refresh();
        $this->assertSame('faculty', $managed->role);
        $this->assertNull($managed->branch);

        $this->patch(route('admin.users.toggle', $managed))
            ->assertSessionHas('status');
        $this->assertFalse($managed->fresh()->is_active);

        $paper = Paper::create([
            'user_id' => $managed->id,
            'paper_name' => 'Retained Paper',
            'file_path' => 'papers/retained.pdf',
            'original_name' => 'retained.pdf',
            'mime_type' => 'application/pdf',
            'file_size' => 10,
            'status' => 'approved',
        ]);

        $this->delete(route('admin.users.destroy', $managed))
            ->assertSessionHas('status');

        $this->assertDatabaseMissing('users', ['id' => $managed->id]);
        $this->assertSame($admin->id, $paper->fresh()->user_id);
    }

    public function test_admin_has_full_master_subject_crud(): void
    {
        $admin = $this->admin();
        $this->actingAs($admin);

        $this->post('/admin/subjects', [
            'branch' => 'CS',
            'semester' => 'III',
            'paper_code' => '9991',
            'subject_code' => 'QA1',
            'paper_name' => 'QUALITY ASSURANCE',
            'subject_name' => 'QUALITY ASSURANCE',
        ])->assertRedirect(route('admin.subjects.index'));

        $subject = SubjectMaster::where('subject_code', 'QA1')->firstOrFail();

        $this->put(route('admin.subjects.update', $subject), [
            'branch' => 'CS',
            'semester' => 'III',
            'paper_code' => '9991',
            'subject_code' => 'QA1',
            'paper_name' => 'QUALITY ASSURANCE UPDATED',
            'subject_name' => 'QUALITY ASSURANCE UPDATED',
        ])->assertRedirect(route('admin.subjects.index'));

        $this->assertSame('QUALITY ASSURANCE UPDATED', $subject->fresh()->subject_name);

        $this->delete(route('admin.subjects.destroy', $subject))
            ->assertSessionHas('status');
        $this->assertDatabaseMissing('subject_masters', ['id' => $subject->id]);
    }

    public function test_admin_can_create_edit_and_delete_papers_notes_and_gallery(): void
    {
        Storage::fake('public');

        $admin = $this->admin();
        $this->actingAs($admin);

        $this->post('/admin/content/papers', [
            'file' => UploadedFile::fake()->image('admin-paper.jpg', 320, 240),
            'paper_code' => 'P100',
            'subject_code' => 'S100',
            'paper_name' => 'Admin Paper',
            'subject_name' => 'Admin Subject',
            'branch' => 'CS',
            'semester' => 'I',
            'year' => 2026,
            'session' => 'F',
            'status' => 'approved',
        ])->assertRedirect(route('admin.content.index', 'papers'));

        $paper = Paper::where('paper_code', 'P100')->firstOrFail();
        Storage::disk('public')->assertExists($paper->file_path);

        $this->get('/')->assertViewHas('paperCount', 1);

        $this->put(route('admin.content.update', ['papers', $paper->id]), [
            'paper_code' => 'P100',
            'subject_code' => 'S100',
            'paper_name' => 'Admin Paper Updated',
            'subject_name' => 'Admin Subject',
            'branch' => 'CS',
            'semester' => 'I',
            'year' => 2026,
            'session' => 'F',
            'status' => 'approved',
        ])->assertRedirect(route('admin.content.index', 'papers'));

        $this->assertSame('Admin Paper Updated', $paper->fresh()->paper_name);

        $this->post('/admin/content/notes', [
            'branch' => 'CS',
            'semester' => 'I',
            'year' => 2026,
            'subject_name' => 'Admin Notes Subject',
            'subject_code' => 'N100',
            'title' => 'Admin Notes',
            'description' => 'Created by Admin.',
            'status' => 'approved',
        ])->assertRedirect(route('admin.content.index', 'notes'));

        $note = Note::where('subject_code', 'N100')->firstOrFail();

        $this->put(route('admin.content.update', ['notes', $note->id]), [
            'branch' => 'CS',
            'semester' => 'I',
            'year' => 2026,
            'subject_name' => 'Admin Notes Subject',
            'subject_code' => 'N100',
            'title' => 'Admin Notes Updated',
            'description' => 'Updated by Admin.',
            'status' => 'approved',
        ])->assertRedirect(route('admin.content.index', 'notes'));

        $this->assertSame('Admin Notes Updated', $note->fresh()->title);

        $this->post('/admin/content/gallery', [
            'image' => UploadedFile::fake()->image('admin-campus.jpg', 640, 480),
            'category' => 'Campus & Infrastructure',
            'caption' => 'Admin Campus',
            'status' => 'approved',
        ])->assertRedirect(route('admin.content.index', 'gallery'));

        $image = GalleryImage::where('caption', 'Admin Campus')->firstOrFail();
        Storage::disk('public')->assertExists($image->file_path);

        $this->put(route('admin.content.update', ['gallery', $image->id]), [
            'category' => 'Campus & Infrastructure',
            'caption' => 'Admin Campus Updated',
            'status' => 'approved',
        ])->assertRedirect(route('admin.content.index', 'gallery'));

        $this->assertSame('Admin Campus Updated', $image->fresh()->caption);

        $paperPath = $paper->file_path;
        $galleryPath = $image->file_path;

        $this->delete(route('admin.content.destroy', ['papers', $paper->id]))->assertSessionHas('status');
        $this->delete(route('admin.content.destroy', ['notes', $note->id]))->assertSessionHas('status');
        $this->delete(route('admin.content.destroy', ['gallery', $image->id]))->assertSessionHas('status');

        Storage::disk('public')->assertMissing($paperPath);
        Storage::disk('public')->assertMissing($galleryPath);
    }

    public function test_admin_idle_timeout_logs_admin_out_and_digital_board_controls_are_absent(): void
    {
        $admin = $this->admin();
        $this->actingAs($admin)
            ->withSession(['admin_last_activity' => now()->subMinutes(31)->timestamp])
            ->get('/admin')
            ->assertRedirect('/#login');

        $this->assertGuest();
        $this->assertFalse(Route::has('admin.notifications.index'));

        $layout = (string) file_get_contents(resource_path('views/admin/layout.blade.php'));
        $this->assertStringNotContainsString('Notifications', $layout);
        $this->assertStringNotContainsString('Digital Board', $layout);
    }

    private function admin(): User
    {
        return User::create($this->userAttributes([
            'name' => 'Admin',
            'surname' => 'User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'admin_identifier' => 'qa-admin',
            'password' => 'password123',
        ]));
    }

    private function userAttributes(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Portal',
            'surname' => 'User',
            'email' => 'portal@example.com',
            'password' => 'password123',
            'role' => 'student',
            'gender' => 'Male',
            'college_name' => 'Government Polytechnic College Shivpuri',
            'college_year' => '1st Year',
            'branch' => 'CS',
            'semester' => 'I',
            'address' => 'Shivpuri',
            'is_active' => true,
        ], $overrides);
    }

    private function settingsPayload(array $overrides = []): array
    {
        return array_merge([
            'paper_max_mb' => 100,
            'notes_max_mb' => 200,
            'gallery_max_mb' => 20,
            'branches' => 'CS, ME, EE, ET',
            'login_wall_enabled' => 1,
            'student_url' => 'https://www.rgpvdiploma.in/StudentLife/StudentLogin.aspx',
            'syllabus_url' => 'https://www.rgpvdiploma.in/Academics/AICTEBased.aspx',
            'previous_url' => 'https://www.polygwalior.ac.in/diploma_papers.php',
            'main_result_url' => 'https://result.rgpv.ac.in/Result/Diplomarslt.aspx',
            'all_result_url' => 'https://result.rgpv.ac.in/Result/ProgramSelect.aspx',
        ], $overrides);
    }
}
