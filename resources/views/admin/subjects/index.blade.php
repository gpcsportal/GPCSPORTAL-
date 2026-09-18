@extends('admin.layout')
@section('title','Master Subjects')
@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap"><h1>Master Subjects</h1><a class="btn" href="{{ route('admin.subjects.create') }}">Add Subject</a></div>
<div class="card"><div class="table-wrap"><table><tr><th>Branch</th><th>Semester</th><th>Paper Code</th><th>Subject Code</th><th>Name</th><th>Actions</th></tr>
@forelse($subjects as $subject)<tr><td>{{ $subject->branch }}</td><td>{{ $subject->semester }}</td><td>{{ $subject->paper_code }}</td><td>{{ $subject->subject_code }}</td><td>{{ $subject->subject_name }}</td><td><a class="btn" href="{{ route('admin.subjects.edit',$subject) }}">Edit</a> <form style="display:inline" method="POST" action="{{ route('admin.subjects.destroy',$subject) }}" onsubmit="return confirm('Delete this Master Subject?')">@csrf @method('DELETE')<button class="danger" type="submit">Delete</button></form></td></tr>
@empty<tr><td colspan="6">No Master Subjects found.</td></tr>@endforelse
</table></div>{{ $subjects->links() }}</div>
@endsection
