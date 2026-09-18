@extends('admin.layout')
@section('title','Dashboard')
@section('content')
<h1>Admin Dashboard</h1>
<div class="grid">
<div class="card metric"><strong>{{ $users }}</strong><div>Student / Faculty accounts</div></div>
<div class="card metric"><strong>{{ $pendingPapers }}</strong><div>Pending papers</div><span class="muted">{{ $approvedPapers }} approved</span></div>
<div class="card metric"><strong>{{ $pendingNotes }}</strong><div>Pending notes</div><span class="muted">{{ $approvedNotes }} approved</span></div>
<div class="card metric"><strong>{{ $pendingGallery }}</strong><div>Pending gallery</div><span class="muted">{{ $approvedGallery }} approved</span></div>
<div class="card metric"><strong>{{ $subjects }}</strong><div>Master subjects</div></div>
<div class="card metric"><strong>{{ $messages }}</strong><div>New messages</div></div>
<div class="card metric"><strong>{{ $paperMaxMb }} / {{ $notesMaxMb }} MB</strong><div>Paper / Notes limits</div></div>
<div class="card metric"><strong>{{ $loginWallEnabled ? 'ON' : 'OFF' }}</strong><div>Login-Wall</div></div>
</div>
<div class="card"><h2>Recent Admin activity</h2><div class="table-wrap"><table><tr><th>Time</th><th>Action</th><th>Target</th></tr>@forelse($logs as $log)<tr><td>{{ $log->created_at }}</td><td>{{ $log->action }}</td><td>{{ $log->target_type }} #{{ $log->target_id }}</td></tr>@empty<tr><td colspan="3">No activity recorded yet.</td></tr>@endforelse</table></div></div>
@endsection
