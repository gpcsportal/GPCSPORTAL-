<?php

namespace Tests\Unit;

use App\Services\UploadStorageService;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadStorageServiceTest extends TestCase
{
    public function test_configured_volume_capacity_blocks_upload_when_reserved_space_would_be_exceeded(): void
    {
        Storage::fake('public');
        config()->set('filesystems.default', 'public');
        config()->set('gpcs_uploads.volume_capacity_mb', 1);

        Storage::disk('public')->put('existing.bin', str_repeat('x', 900 * 1024));

        $service = app(UploadStorageService::class);

        $this->assertFalse($service->hasCapacityFor(200 * 1024, 32));
    }

    public function test_configured_volume_capacity_allows_small_upload_when_space_and_reserve_are_available(): void
    {
        Storage::fake('public');
        config()->set('filesystems.default', 'public');
        config()->set('gpcs_uploads.volume_capacity_mb', 100);

        Storage::disk('public')->put('existing.bin', str_repeat('x', 1 * 1024 * 1024));

        $service = app(UploadStorageService::class);

        $this->assertTrue($service->hasCapacityFor(1 * 1024 * 1024, 32));
    }
}
