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

        $this->assertStringContainsString("@include('college.hero')", $template);
        $this->assertStringContainsString('reference-stat-strip', $template);
        $this->assertStringContainsString('reference-dashboard-grid', $template);
        $this->assertStringContainsString('reference-footer', $template);
        $this->assertStringContainsString('/assets/gpcs-campus.webp', (string) file_get_contents(resource_path('views/college/hero.blade.php')));
        $this->assertFileExists(public_path('assets/gpcs-campus.webp'));

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
        $this->assertStringContainsString('@media(max-width:680px)', (string) file_get_contents(public_path('assets/gpcs-portal.css')));
        $this->assertStringContainsString('college-hero-grid', (string) file_get_contents(public_path('assets/gpcs-college.css')));
    }

    public function test_mobile_chrome_and_safari_user_agents_receive_the_portal_without_redirects(): void
    {
        $androidChrome = 'Mozilla/5.0 (Linux; Android 14; Pixel 8 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Mobile Safari/537.36';
        $iphoneSafari = 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1';

        foreach ([$androidChrome, $iphoneSafari] as $userAgent) {
            $response = $this->withHeader('User-Agent', $userAgent)
                ->get('/')
                ->assertOk();

            $cacheControl = (string) $response->headers->get('Cache-Control');
            $this->assertStringContainsString('no-cache', $cacheControl);
            $this->assertStringContainsString('must-revalidate', $cacheControl);

            $this->withHeader('User-Agent', $userAgent)
                ->getJson('/auth/status')
                ->assertOk()
                ->assertJsonStructure(['authenticated', 'role']);
        }
    }

    public function test_mobile_runtime_has_no_service_worker_or_user_agent_blocking_logic(): void
    {
        $template = (string) file_get_contents(resource_path('views/portal.blade.php'));
        $bridge = (string) file_get_contents(public_path('assets/gpcs-backend-bridge.js'));

        $this->assertStringContainsString('width=device-width, initial-scale=1, viewport-fit=cover', $template);
        $this->assertStringContainsString('/assets/gpcs-responsive.css?v=20260919-mobile-access', $bridge);

        foreach ([
            'navigator.serviceWorker',
            'serviceWorker.register',
            'beforeinstallprompt',
            'navigator.userAgent',
            'userAgent.includes',
            'iPhone',
            'Android',
        ] as $blockedPattern) {
            $this->assertStringNotContainsString($blockedPattern, $template);
            $this->assertStringNotContainsString($blockedPattern, $bridge);
        }
    }

    public function test_auth_bridge_recovers_stale_csrf_and_does_not_bind_login_to_role_toggle(): void
    {
        $bridge = (string) file_get_contents(public_path('assets/gpcs-backend-bridge.js'));
        $template = (string) file_get_contents(resource_path('views/portal.blade.php'));

        $this->assertStringContainsString('refreshCsrfToken', $bridge);
        $this->assertStringContainsString('__csrfRetried', $bridge);
        $this->assertStringContainsString('routes.csrf', $bridge);
        $this->assertStringNotContainsString("role:id.includes('Faculty')", $bridge);
        $this->assertStringContainsString('20260929-ui-polish', $template);
    }

    public function test_ui_polish_keeps_login_and_admin_structure_stable(): void
    {
        $template = (string) file_get_contents(resource_path('views/portal.blade.php'));
        $bridge = (string) file_get_contents(public_path('assets/gpcs-backend-bridge.js'));
        $adminLayout = (string) file_get_contents(resource_path('views/admin/layout.blade.php'));

        // UPDATED: browser credential hints improve reliability without changing login structure.
        $this->assertStringContainsString('id="previewStudentPassword"', $template);
        $this->assertStringContainsString('id="previewFacultyPassword"', $template);
        $this->assertStringContainsString('autocomplete="email"', $template);
        $this->assertStringContainsString('autocomplete="current-password"', $template);
        $this->assertStringContainsString('autocomplete="new-password"', $template);

        // UPDATED: existing submit lock is now exposed accessibly.
        $this->assertStringContainsString("form.setAttribute('aria-busy', 'true')", $bridge);
        $this->assertStringContainsString("submitter.setAttribute('aria-disabled', 'true')", $bridge);

        // UPDATED: Admin nav labels/order remain untouched while styling is centralized.
        $expectedOrder = ['Dashboard', 'Users', 'Papers', 'Notes', 'Gallery', 'Messages', 'Subjects', 'Settings', 'Reports', 'Logs', 'Account'];
        $cursor = -1;
        foreach ($expectedOrder as $label) {
            $position = strpos($adminLayout, '>'.$label.'</a>', $cursor + 1);
            $this->assertNotFalse($position, 'Missing or reordered Admin navigation item: '.$label);
            $this->assertGreaterThan($cursor, $position);
            $cursor = $position;
        }

        $this->assertStringContainsString('--admin-primary:#0a2558', $adminLayout);
        $this->assertStringContainsString('form.dataset.submitting', $adminLayout);
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
