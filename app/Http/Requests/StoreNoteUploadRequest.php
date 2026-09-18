<?php

namespace App\Http\Requests;

use App\Services\PortalSettingsService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNoteUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $settings = app(PortalSettingsService::class);
        $maxMb = $settings->notesMaxMb();
        $maxKb = $maxMb * 1024;

        return [
            'branch' => ['required', Rule::in($settings->branches())],
            'semester' => ['required', 'regex:/^(?:Semester )?(?:I|II|III|IV|V|VI)$/'],
            'year' => ['required', 'integer', 'between:2000,2100'],
            'subject_name' => ['required', 'string', 'max:255'],
            'subject_code' => ['required', 'string', 'max:30'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'attachment' => ['nullable', 'file', 'max:'.$maxKb, 'mimes:pdf,jpg,jpeg,png', 'extensions:pdf,jpg,jpeg,png'],
        ];
    }

    public function messages(): array
    {
        $maxMb = app(PortalSettingsService::class)->notesMaxMb();

        return [
            'attachment.file' => 'The selected Notes attachment is invalid.',
            'attachment.max' => "Notes attachment must be {$maxMb} MB or smaller.",
            'attachment.mimes' => 'Notes attachment must be PDF, JPG or PNG.',
            'attachment.extensions' => 'Notes attachment extension must be PDF, JPG or PNG.',
        ];
    }
}
