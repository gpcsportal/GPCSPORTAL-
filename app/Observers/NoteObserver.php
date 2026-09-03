<?php
namespace App\Observers;
use App\Models\Note; use App\Services\UploadMetadataService;
class NoteObserver {public function saving(Note $note): void {$s=app(UploadMetadataService::class);$note->semester=$s->normalizeSemester($note->semester);if(!$note->fingerprint&&$note->branch&&$note->semester&&$note->year&&$note->subject_name&&$note->subject_code)$note->fingerprint=$s->fingerprintNote($note->toArray());}}
