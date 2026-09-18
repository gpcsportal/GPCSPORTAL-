<?php

namespace Tests\Feature;

use App\Support\SafePortalRedirect;
use Tests\TestCase;

class RuntimeSafetyTest extends TestCase
{
    public function test_unknown_api_route_returns_json_not_html(): void
    {
        $this->getJson('/api/route-that-does-not-exist')
            ->assertNotFound()
            ->assertHeader('content-type', 'application/json')
            ->assertJsonStructure(['message']);
    }

    public function test_legacy_chunk_upload_endpoint_returns_clear_json_tombstone(): void
    {
        $this->postJson('/chunk_upload.php')
            ->assertStatus(410)
            ->assertJson([
                'ok' => false,
            ])
            ->assertJsonStructure(['ok', 'error']);
    }

    public function test_unapproved_cross_origin_preflight_does_not_receive_cors_origin_header(): void
    {
        $this->withHeaders([
            'Origin' => 'https://untrusted.example',
            'Access-Control-Request-Method' => 'GET',
        ])->options('/api/papers')
            ->assertHeaderMissing('Access-Control-Allow-Origin');
    }

    public function test_public_responses_include_defense_in_depth_security_headers(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN')
            ->assertHeader('X-XSS-Protection', '0')
            ->assertHeader('Cross-Origin-Opener-Policy', 'same-origin')
            ->assertHeader('Cross-Origin-Resource-Policy', 'same-origin')
            ->assertHeader('X-Permitted-Cross-Domain-Policies', 'none')
            ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin')
            ->assertHeader('Content-Security-Policy');
    }

    public function test_admin_dashboard_is_not_accessible_to_guests(): void
    {
        $this->get('/admin')
            ->assertRedirect(SafePortalRedirect::loginUrl('/admin'));
    }

    public function test_admin_and_auth_status_responses_are_not_cacheable(): void
    {
        $this->getJson('/auth/status')
            ->assertOk()
            ->assertHeader('Cache-Control', 'no-store, private');
    }
}
