<?php

namespace Tests\Feature;

use Tests\TestCase;

class DeploymentConfigTest extends TestCase
{
    public function test_railway_config_uses_railpack_auto_start_and_public_healthcheck(): void
    {
        $config = json_decode(
            (string) file_get_contents(base_path('railway.json')),
            true,
            flags: JSON_THROW_ON_ERROR
        );

        $this->assertSame('RAILPACK', $config['build']['builder'] ?? null);
        $this->assertArrayHasKey('startCommand', $config['deploy']);
        $this->assertNull($config['deploy']['startCommand']);
        $this->assertSame('/up', $config['deploy']['healthcheckPath'] ?? null);
        $this->assertSame('ON_FAILURE', $config['deploy']['restartPolicyType'] ?? null);
    }

    public function test_healthcheck_is_not_behind_the_login_wall(): void
    {
        $this->get('/up')
            ->assertOk()
            ->assertHeaderMissing('Location');
    }
}
