<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreNoteUploadRequest extends FormRequest {
 public function authorize(): bool {return auth()->check();}
 public function rules(): array {$max=config('gpcs_uploads.notes_max_mb',200)*1024; return ['branch'=>['required','in:CS,ME,EE,ET'],'semester'=>['required','regex:/^(?:Semester )?(?:I|II|III|IV|V|VI)$/'],'year'=>['required','integer','between:2000,2100'],'subject_name'=>['required','string','max:255'],'subject_code'=>['required','string','max:30'],'title'=>['nullable','string','max:255'],'description'=>['nullable','string','max:5000'],'attachment'=>['nullable','file','max:'.$max,'mimes:pdf,jpg,jpeg,png']];}
}
