<?php
namespace App\Http\Requests;
use App\Services\PortalSettingsService; use Illuminate\Foundation\Http\FormRequest; use Illuminate\Validation\Rule;
class PaperMetadataLookupRequest extends FormRequest {public function authorize(): bool{return true;} public function rules(): array{return ['paper_code'=>'nullable|string|max:30','subject_code'=>'nullable|string|max:30','paper_name'=>'nullable|string|max:255','subject_name'=>'nullable|string|max:255','branch'=>['nullable',Rule::in(app(PortalSettingsService::class)->branches())],'semester'=>'nullable|string|max:20'];}}
