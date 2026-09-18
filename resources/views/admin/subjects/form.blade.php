@extends('admin.layout')
@section('title',$subject->exists?'Edit Subject':'Add Subject')
@section('content')
<h1>{{ $subject->exists ? 'Edit Master Subject' : 'Add Master Subject' }}</h1>
<div class="card">
@if($errors->any())<div class="flash" style="background:#fff1f2;color:#9f1239"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<form method="POST" action="{{ $subject->exists ? route('admin.subjects.update',$subject) : route('admin.subjects.store') }}">
@csrf @if($subject->exists) @method('PUT') @endif
<div class="grid">
<label>Branch<select name="branch" required>@foreach($branches as $branch)<option value="{{ $branch }}" @selected(old('branch',$subject->branch)===$branch)>{{ $branch }}</option>@endforeach</select></label>
<label>Semester<select name="semester" required>@foreach(['I','II','III','IV','V','VI'] as $semester)<option @selected(old('semester',$subject->semester)===$semester)>{{ $semester }}</option>@endforeach</select></label>
<label>Paper Code<input name="paper_code" value="{{ old('paper_code',$subject->paper_code) }}" required></label>
<label>Subject Code<input name="subject_code" value="{{ old('subject_code',$subject->subject_code) }}" required></label>
<label>Paper Name<input name="paper_name" value="{{ old('paper_name',$subject->paper_name) }}" required></label>
<label>Subject Name<input name="subject_name" value="{{ old('subject_name',$subject->subject_name) }}" required></label>
</div><button type="submit">{{ $subject->exists ? 'Save Subject' : 'Add Subject' }}</button>
</form></div>
@endsection
