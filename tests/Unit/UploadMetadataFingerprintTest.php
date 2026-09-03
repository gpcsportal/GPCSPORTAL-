<?php
namespace Tests\Unit;
use App\Services\UploadMetadataService; use PHPUnit\Framework\TestCase;
class UploadMetadataFingerprintTest extends TestCase {public function test_note_fingerprint_is_stable(): void {$s=new UploadMetadataService();$a=['branch'=>'CS','semester'=>'IV','year'=>2026,'subject_name'=>'COMPUTER NETWORKS','subject_code'=>'403'];$this->assertSame($s->fingerprintNote($a),$s->fingerprintNote($a));}}
