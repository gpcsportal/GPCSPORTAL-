@extends('admin.layout')
@section('title','Portal Settings')
@section('content')
<h1>Portal Settings</h1>
<div class="card">
<p class="muted">Changes below are stored in the database and apply on the next request without a code redeploy. Safe upload ceilings remain Paper 100 MB, Notes 200 MB and Gallery 20 MB.</p>
@if($errors->any())<div class="flash" style="background:#fff1f2;color:#9f1239"><strong>Please fix:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<form method="POST" action="{{ route('admin.settings.update') }}">
@csrf @method('PUT')
<div class="grid">
<div><label>Paper max upload (MB)<input type="number" min="1" max="100" name="paper_max_mb" value="{{ old('paper_max_mb',$paperMaxMb) }}" required></label></div>
<div><label>Notes max upload (MB)<input type="number" min="1" max="200" name="notes_max_mb" value="{{ old('notes_max_mb',$notesMaxMb) }}" required></label></div>
<div><label>Gallery max upload (MB)<input type="number" min="1" max="20" name="gallery_max_mb" value="{{ old('gallery_max_mb',$galleryMaxMb) }}" required></label></div>
</div>
<label>Active Branch Codes<input name="branches" value="{{ old('branches',implode(', ', $branches)) }}" required><span class="muted">Comma or space separated. Existing branches that are already in use cannot be removed until their data is migrated.</span></label>
<input type="hidden" name="login_wall_enabled" value="0">
<label style="display:flex;align-items:center;gap:10px"><input style="width:auto" type="checkbox" name="login_wall_enabled" value="1" @checked(old('login_wall_enabled',$loginWallEnabled))> Require sign-in to browse Papers, Notes, Gallery and official academic links</label>
<h2>Official Academic Links</h2>
<label>Student Login URL<input type="url" name="student_url" value="{{ old('student_url',$officialLinks['student']) }}" required></label>
<label>Syllabus URL<input type="url" name="syllabus_url" value="{{ old('syllabus_url',$officialLinks['syllabus']) }}" required></label>
<label>Previous Papers URL<input type="url" name="previous_url" value="{{ old('previous_url',$officialLinks['previous']) }}" required></label>
<label>Main Result URL<input type="url" name="main_result_url" value="{{ old('main_result_url',$officialLinks['main-result']) }}" required></label>
<label>All Result URL<input type="url" name="all_result_url" value="{{ old('all_result_url',$officialLinks['all-result']) }}" required></label>
<button type="submit">Save Portal Settings</button>
</form>
</div>
@endsection
