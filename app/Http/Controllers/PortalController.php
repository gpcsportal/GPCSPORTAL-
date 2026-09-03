<?php
namespace App\Http\Controllers;
use App\Models\Paper; use App\Models\Note; use App\Models\GalleryImage; use App\Models\SubjectMaster;
class PortalController extends Controller {public function index(){return view('portal',['paperCount'=>Paper::where('status','approved')->count(),'noteCount'=>Note::where('status','approved')->count(),'galleryCount'=>GalleryImage::where('status','approved')->count(),'subjectCount'=>SubjectMaster::count()]);}}
