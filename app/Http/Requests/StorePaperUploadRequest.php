<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StorePaperUploadRequest extends FormRequest {
 public function authorize(): bool {return auth()->check();}
 public function rules(): array {$max=config('gpcs_uploads.paper_max_mb',100)*1024; return ['file'=>['required','file','max:'.$max,'mimes:pdf,jpg,jpeg,png,doc,docx'],'paper_code'=>['nullable','string','max:30'],'subject_code'=>['nullable','string','max:30'],'paper_name'=>['nullable','string','max:255'],'subject_name'=>['nullable','string','max:255'],'branch'=>['nullable','in:CS,ME,EE,ET'],'semester'=>['nullable','regex:/^(?:Semester )?(?:I|II|III|IV|V|VI)$/'],'year'=>['nullable','integer','between:2000,2100'],'session'=>['nullable','string','max:30']];}
}
