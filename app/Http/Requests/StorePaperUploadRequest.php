<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaperUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $maxMb = (int) config('gpcs_uploads.paper_max_mb', 100);
        $maxKb = $maxMb * 1024;

        return [
            'file' => [
                'bail',
                'required',
                'file',
                'max:'.$maxKb,
                'mimes:pdf,jpg,jpeg,png,doc,docx',
                'extensions:pdf,jpg,jpeg,png,doc,docx',
            ],
            'paper_code' => ['nullable', 'string', 'max:30'],
            'subject_code' => ['nullable', 'string', 'max:30'],
            'paper_name' => ['nullable', 'string', 'max:255'],
            'subject_name' => ['nullable', 'string', 'max:255'],
            'branch' => ['nullable', 'in:CS,ME,EE,ET'],
            'semester' => ['nullable', 'regex:/^(?:Semester )?(?:I|II|III|IV|V|VI)$/'],
            'year' => ['nullable', 'integer', 'between:2000,2100'],
            'session' => ['nullable', 'string', 'max:30'],
        ];
    }

    public function messages(): array
    {
        $maxMb = (int) config('gpcs_uploads.paper_max_mb', 100);

        return [
            'file.required' => 'Choose a Paper file to upload.',
            'file.file' => 'The selected Paper upload is invalid.',
            'file.max' => "Paper file must be {$maxMb} MB or smaller.",
            'file.mimes' => 'Paper file must be PDF, JPG, PNG, DOC or DOCX.',
            'file.extensions' => 'Paper file extension must be PDF, JPG, PNG, DOC or DOCX.',
        ];
    }
}
