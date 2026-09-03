<?php
namespace App\Http\Controllers;
use App\Http\Requests\NoteMetadataLookupRequest; use App\Http\Requests\PaperMetadataLookupRequest; use App\Services\UploadMetadataService;
class UploadMetadataLookupController extends Controller {public function paper(PaperMetadataLookupRequest $r,UploadMetadataService $s){return response()->json($s->lookup($r->validated()));}public function note(NoteMetadataLookupRequest $r,UploadMetadataService $s){return response()->json($s->lookup($r->validated()));}}
