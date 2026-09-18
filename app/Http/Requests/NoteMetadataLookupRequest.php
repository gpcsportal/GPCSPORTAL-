<?php
namespace App\Http\Requests;
use App\Services\PortalSettingsService; use Illuminate\Foundation\Http\FormRequest; use Illuminate\Validation\Rule;
class NoteMetadataLookupRequest extends FormRequest {public function authorize(): bool{return true;} public function rules(): array{return ['subject_code'=>'nullable|string|max:30','subject_name'=>'nullable|string|max:255','branch'=>['nullable',Rule::in(app(PortalSettingsService::class)->branches())],'semester'=>'nullable|string|max:20'];}}
