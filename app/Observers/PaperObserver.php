<?php
namespace App\Observers;
use App\Models\Paper; use App\Services\UploadMetadataService;
class PaperObserver {public function saving(Paper $paper): void {$s=app(UploadMetadataService::class);if($paper->semester)$paper->semester=$s->normalizeSemester($paper->semester);if(!$paper->fingerprint)$paper->fingerprint=$s->fingerprintPaper($paper->toArray());}}
