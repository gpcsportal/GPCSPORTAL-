<?php

namespace Tests\Unit;

use App\Services\UploadMetadataService;
use PHPUnit\Framework\TestCase;

class UploadMetadataFingerprintTest extends TestCase
{
    public function test_note_fingerprint_is_stable(): void
    {
        $service = new UploadMetadataService();
        $data = [
            'branch' => 'CS',
            'semester' => 'IV',
            'year' => 2026,
            'subject_name' => 'COMPUTER NETWORKS',
            'subject_code' => '403',
            'title' => 'Unit 1',
            'description' => 'OSI model notes',
        ];

        $this->assertSame(
            $service->fingerprintNote($data),
            $service->fingerprintNote($data)
        );
    }

    public function test_different_note_titles_are_not_treated_as_exact_duplicates(): void
    {
        $service = new UploadMetadataService();
        $base = [
            'branch' => 'CS',
            'semester' => 'IV',
            'year' => 2026,
            'subject_name' => 'COMPUTER NETWORKS',
            'subject_code' => '403',
            'description' => 'Class notes',
        ];

        $this->assertNotSame(
            $service->fingerprintNote($base + ['title' => 'Unit 1']),
            $service->fingerprintNote($base + ['title' => 'Unit 2'])
        );
    }

    public function test_different_note_files_are_not_treated_as_exact_duplicates(): void
    {
        $service = new UploadMetadataService();
        $data = [
            'branch' => 'CS',
            'semester' => 'IV',
            'year' => 2026,
            'subject_name' => 'COMPUTER NETWORKS',
            'subject_code' => '403',
            'title' => 'Handwritten Notes',
            'description' => '',
        ];

        $this->assertNotSame(
            $service->fingerprintNote($data, str_repeat('a', 64)),
            $service->fingerprintNote($data, str_repeat('b', 64))
        );
    }
}
