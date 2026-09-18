@extends('admin.layout')
@section('title',$item->exists?'Edit '.ucfirst($type):'Add '.ucfirst($type))
@section('content')
<h1>{{ $item->exists ? 'Edit '.ucfirst($type) : 'Add '.ucfirst($type) }}</h1>
<div class="card">
@if($errors->any())<div class="flash" style="background:#fff1f2;color:#9f1239"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<form method="POST" enctype="multipart/form-data" action="{{ $item->exists ? route('admin.content.update',[$type,$item->id]) : route('admin.content.store',$type) }}">
@csrf @if($item->exists) @method('PUT') @endif

@if($type==='papers')
@if(!$item->exists)<label>Paper File (max {{ $paperMaxMb }} MB)<input type="file" name="file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required></label>@endif
<div class="grid">
<label>Paper Code<input name="paper_code" value="{{ old('paper_code',$item->paper_code) }}"></label>
<label>Subject Code<input name="subject_code" value="{{ old('subject_code',$item->subject_code) }}"></label>
<label>Paper Name<input name="paper_name" value="{{ old('paper_name',$item->paper_name) }}"></label>
<label>Subject Name<input name="subject_name" value="{{ old('subject_name',$item->subject_name) }}"></label>
<label>Branch<select name="branch"><option value="">Auto / unknown</option>@foreach($branches as $branch)<option value="{{ $branch }}" @selected(old('branch',$item->branch)===$branch)>{{ $branch }}</option>@endforeach</select></label>
<label>Semester<select name="semester"><option value="">Auto / unknown</option>@foreach(['I','II','III','IV','V','VI'] as $semester)<option value="{{ $semester }}" @selected(old('semester',$item->semester)===$semester)>{{ $semester }}</option>@endforeach</select></label>
<label>Year<input type="number" min="2000" max="2100" name="year" value="{{ old('year',$item->year) }}"></label>
<label>Session<input name="session" value="{{ old('session',$item->session) }}"></label>
</div>
@elseif($type==='notes')
@if(!$item->exists)<label>Attachment (optional, max {{ $notesMaxMb }} MB)<input type="file" name="attachment" accept=".pdf,.jpg,.jpeg,.png"></label>@endif
<div class="grid">
<label>Branch<select name="branch" required>@foreach($branches as $branch)<option value="{{ $branch }}" @selected(old('branch',$item->branch)===$branch)>{{ $branch }}</option>@endforeach</select></label>
<label>Semester<select name="semester" required>@foreach(['I','II','III','IV','V','VI'] as $semester)<option value="{{ $semester }}" @selected(old('semester',$item->semester)===$semester)>{{ $semester }}</option>@endforeach</select></label>
<label>Year<input type="number" min="2000" max="2100" name="year" value="{{ old('year',$item->year) }}" required></label>
<label>Subject Name<input name="subject_name" value="{{ old('subject_name',$item->subject_name) }}" required></label>
<label>Subject Code<input name="subject_code" value="{{ old('subject_code',$item->subject_code) }}" required></label>
<label>Title<input name="title" value="{{ old('title',$item->title) }}"></label>
</div>
<label>Description<textarea name="description">{{ old('description',$item->description) }}</textarea></label>
@elseif($type==='gallery')
@if(!$item->exists)<label>Image (max {{ $galleryMaxMb }} MB)<input type="file" name="image" accept="image/*" required></label>@endif
<label>Category<input name="category" value="{{ old('category',$item->category) }}" required></label>
<label>Caption<input name="caption" value="{{ old('caption',$item->caption) }}"></label>
@endif

<label>Status<select name="status" required>@foreach(['pending','approved','rejected'] as $status)<option value="{{ $status }}" @selected(old('status',$item->status ?: 'approved')===$status)>{{ ucfirst($status) }}</option>@endforeach</select></label>
<label>Rejection Reason<textarea name="rejection_reason">{{ old('rejection_reason',$item->rejection_reason) }}</textarea></label>
<button type="submit">{{ $item->exists ? 'Save Changes' : 'Create Content' }}</button>
</form>
</div>
@endsection
