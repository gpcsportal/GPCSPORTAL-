<?php
namespace App\Services;
use App\Models\SubjectMaster;
use Illuminate\Database\Eloquent\Builder;
class UploadMetadataService {
 public function lookup(array $input): array {
  $query=SubjectMaster::query(); $used=false;
  foreach(['paper_code','subject_code','branch'] as $field){if(!empty($input[$field])){$query->where($field, trim((string)$input[$field]));$used=true;}}
  foreach(['paper_name','subject_name'] as $field){if(!empty($input[$field])){$query->whereRaw('LOWER('.$field.') = ?', [mb_strtolower(trim((string)$input[$field]))]);$used=true;}}
  if(!empty($input['semester'])){$query->where('semester',$this->normalizeSemester((string)$input['semester']));$used=true;}
  if(!$used)return ['matches'=>[],'unique'=>null];
  $matches=$query->limit(20)->get(['paper_code','subject_code','paper_name','subject_name','semester','branch'])->toArray();
  return ['matches'=>$matches,'unique'=>count($matches)===1?$matches[0]:null];
 }
 public function enrichPaper(array $input): array {$r=$this->lookup($input); if($r['unique']){foreach($r['unique'] as $k=>$v){if(empty($input[$k]))$input[$k]=$v;}} if(!empty($input['semester']))$input['semester']=$this->normalizeSemester($input['semester']); return $input;}
 public function normalizeSemester(string $semester): string {$semester=trim(str_ireplace('Semester','',$semester)); return strtoupper($semester);}
 public function fingerprintPaper(array $data): ?string {$keys=['paper_code','subject_code','paper_name','subject_name','branch','semester','year','session']; foreach($keys as $k){if(!isset($data[$k])||trim((string)$data[$k])==='')return null;} return hash('sha256',implode('|',array_map(fn($k)=>mb_strtolower(trim((string)$data[$k])),$keys)));}
 public function fingerprintNote(array $data): string {$keys=['branch','semester','year','subject_name','subject_code']; return hash('sha256',implode('|',array_map(fn($k)=>mb_strtolower(trim((string)$data[$k])),$keys)));}
}
