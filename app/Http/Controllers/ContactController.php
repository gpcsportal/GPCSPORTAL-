<?php
namespace App\Http\Controllers;
use App\Models\ContactMessage; use Illuminate\Http\Request;
class ContactController extends Controller {public function store(Request $r){$v=$r->validate(['name'=>'required|string|max:120','contact'=>'required|string|max:190','message'=>'required|string|max:3000']);ContactMessage::create($v+['status'=>'new']);return response()->json(['message'=>'Message sent successfully.'],201);}}
