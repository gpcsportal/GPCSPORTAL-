<?php

namespace Tests\Feature;

use App\Models\GalleryImage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LaunchReadinessAuditTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_runtime_keeps_reference_layout_and_has_no_digital_board_artifacts(): void
    {
        $template = (string) file_get_contents(resource_path('views/portal.blade.php'));
        $bridge = (string) file_get_contents(public_path('assets/gpcs-backend-bridge.js'));

        $this->assertStringContainsString('reference-home-hero', $template);
        $this->assertStringContainsString('reference-stat-strip', $template);
        $this->assertStringContainsString('reference-dashboard-grid', $template);
        $this->assertStringContainsString('reference-footer', $template);
        $this->assertStringContainsString('/assets/gpcs-embedded-81b2403e96e1.png?v=20260918-campus-restore', $template);

        foreach ([
            'Latest college notices',
            'gpcs-digital-board',
            'loadDigitalBoard',
            'remove-digital-board',
            '100 MB chunk upload',
        ] as $retiredText) {
            $this->assertStringNotContainsString($retiredText, $template);
            $this->assertStringNotContainsString($retiredText, $bridge);
        }

        $this->assertFalse(Route::has('portal.notifications'));
        $this->assertFalse(Route::has('admin.notifications.index'));
        $this->assertFalse(Schema::hasTable('portal_notifications'));

        $this->get('/')->assertOk();
        $this->get('/api/notifications')->assertNotFound();
        $this->get('/admin/notifications')->assertNotFound();
    }

    public function test_responsive_styles_cover_mobile_tablet_and_desktop_ranges(): void
    {
        $responsive = (string) file_get_contents(public_path('assets/gpcs-responsive.css'));
        $template = (string) file_get_contents(resource_path('views/portal.blade.php'));

        $this->assertStringContainsString('@media (max-width:599px)', $responsive);
        $this->assertStringContainsString('@media (min-width:600px) and (max-width:1024px)', $responsive);
        $this->assertStringContainsString('@media (min-width:1280px)', $responsive);
        $this->assertStringContainsString('body{overflow-x:clip}', $responsive);
        $this->assertStringContainsString('@media(max-width:680px)', $template);
        $this->assertStringContainsString('reference-hero-shell', $template);
    }

    public function test_suspended_account_gets_clean_json_auth_failure_and_is_logged_out(): void
    {
        $user = User::create($this->userAttributes([
            'email' => 'suspended@example.com',
            'is_active' => false,
        ]));

        $this->actingAs($user)
            ->getJson('/api/papers')
            ->assertUnauthorized()
            ->assertJson([
                'message' => 'This account is not active. Please contact the Admin.',
            ]);

        $this->assertGuest();
    }

    public function test_gallery_upload_approval_and_protected_delivery_flow(): void
    {
        Storage::fake('public');

        $user = User::create($this->userAttributes([
            'email' => 'gallery-audit@example.com',
        ]));

        $upload = $this->actingAs($user)
            ->postJson('/gallery', [
                'image' => UploadedFile::fake()->image('campus.jpg', 320, 240),
                'category' => 'Campus & Infrastructure',
                'caption' => 'Campus audit image',
            ])
            ->assertCreated()
            ->assertJsonStructure(['message', 'id']);

        $image = GalleryImage::findOrFail((int) $upload->json('id'));
        $this->assertSame('pending', $image->status);
        Storage::disk('public')->assertExists($image->file_path);

        $this->actingAs($user)
            ->get(route('gallery.show', $image, false))
            ->assertNotFound();

        $image->update(['status' => 'approved']);

        $this->actingAs($user)
            ->get(route('gallery.show', $image, false))
            ->assertOk();
    }

    public function test_contact_and_upload_limit_configuration_match_launch_requirements(): void
    {
        $user = User::create($this->userAttributes([
            'email' => 'contact-audit@example.com',
        ]));

        $this->actingAs($user)
            ->postJson('/contact', [
                'name' => 'Launch Tester',
                'contact' => 'launch@example.com',
                'message' => 'Final launch readiness contact test.',
            ])
            ->assertCreated();

        $this->assertDatabaseHas('contact_messages', [
            'contact' => 'launch@example.com',
            'status' => 'new',
        ]);

        $this->assertSame(100, (int) config('gpcs_uploads.paper_max_mb'));
        $this->assertSame(200, (int) config('gpcs_uploads.notes_max_mb'));
        $this->assertSame(20, (int) config('gpcs_uploads.gallery_max_mb'));
        $this->assertSame([], config('filesystems.links'));

        $phpIni = (string) file_get_contents(base_path('php.ini'));
        $this->assertStringContainsString('upload_max_filesize=205M', $phpIni);
        $this->assertStringContainsString('post_max_size=220M', $phpIni);
    }

    public function test_https_response_includes_hsts_and_core_security_headers(): void
    {
        $this->withServerVariables(['HTTPS' => 'on'])
            ->get('/')
            ->assertOk()
            ->assertHeader('Strict-Transport-Security', 'max-age=31536000')
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN')
            ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin')
            ->assertHeader('Content-Security-Policy');
    }

    private function userAttributes(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Launch',
            'surname' => 'Tester',
            'email' => 'launch@example.com',
            'password' => 'password123',
            'role' => 'student',
            'gender' => 'Male',
            'college_name' => 'Government Polytechnic College Shivpuri',
            'address' => 'Shivpuri',
            'is_active' => true,
        ], $overrides);
    }
}
