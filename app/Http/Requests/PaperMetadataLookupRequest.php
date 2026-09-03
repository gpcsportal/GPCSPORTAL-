<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class PaperMetadataLookupRequest extends FormRequest {public function authorize(): bool{return true;} public function rules(): array{return ['paper_code'=>'nullable|string|max:30','subject_code'=>'nullable|string|max:30','paper_name'=>'nullable|string|max:255','subject_name'=>'nullable|string|max:255','branch'=>'nullable|in:CS,ME,EE,ET','semester'=>'nullable|string|max:20'];}}
