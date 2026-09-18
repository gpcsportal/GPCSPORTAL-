<?php

namespace Tests\Unit;

use Tests\TestCase;

class FrontendContractTest extends TestCase
{
    public function test_portal_no_longer_contains_retired_client_endpoints(): void
    {
        $portal = (string) file_get_contents(resource_path('views/portal.blade.php'));

        $this->assertStringNotContainsString('papers_api.php', $portal);
        $this->assertStringNotContainsString('download.php?type=paper', $portal);
        $this->assertStringNotContainsString('data-chunk-upload', $portal);
        $this->assertStringNotContainsString('galleryUploadPanel', $portal);
    }

    public function test_active_forms_have_backend_bridge_handlers(): void
    {
        $bridge = (string) file_get_contents(public_path('assets/gpcs-backend-bridge.js'));

        foreach ([
            'previewStudentPassword',
            'previewFacultyPassword',
            'previewDynamicRegister',
            'previewUploadForm',
            'previewNoteForm',
            'previewContactForm',
            'previewResetForm',
        ] as $formId) {
            $this->assertStringContainsString($formId, $bridge);
        }

        $this->assertStringContainsString('previewGalleryInput', $bridge);
        $this->assertStringContainsString('uploadLimits.paperMb', $bridge);
        $this->assertStringContainsString('uploadLimits.notesMb', $bridge);
        $this->assertStringContainsString('uploadLimits.galleryMb', $bridge);
    }

    public function test_portal_exposes_real_logout_and_gallery_category_actions(): void
    {
        $portal = (string) file_get_contents(resource_path('views/portal.blade.php'));

        $this->assertStringContainsString('gpcs-logout-btn', $portal);
        $this->assertStringContainsString('data-gallery-upload-category="Campus & Infrastructure"', $portal);
        $this->assertStringContainsString('data-gallery-upload-category="Other College Related"', $portal);
        $this->assertStringContainsString("galleryMaxMb: @json(config('gpcs_uploads.gallery_max_mb', 20))", $portal);
    }

    public function test_digital_board_has_loading_empty_and_error_states(): void
    {
        $bridge = (string) file_get_contents(public_path('assets/gpcs-backend-bridge.js'));

        $this->assertStringContainsString('Loading notices…', $bridge);
        $this->assertStringContainsString('No notices are available right now.', $bridge);
        $this->assertStringContainsString('Notices are temporarily unavailable. Please try again later.', $bridge);
        $this->assertStringContainsString('aria-busy', $bridge);
    }
}
