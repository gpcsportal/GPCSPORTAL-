<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SubjectMaster extends Model {protected $fillable=['paper_code','subject_code','paper_name','subject_name','semester','branch']; public $timestamps=false;}
