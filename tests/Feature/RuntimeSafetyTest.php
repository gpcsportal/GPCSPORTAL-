<?php

namespace Tests\Feature;

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
}
