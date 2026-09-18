@extends('admin.layout')
@section('title',ucfirst($type))
@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap">
<h1>{{ ucfirst($type) }} {{ $type==='messages' ? '' : 'Management' }}</h1>
@if($type!=='messages')<a class="btn" href="{{ route('admin.content.create',$type) }}">Add {{ $type==='gallery' ? 'Image' : ucfirst(rtrim($type,'s')) }}</a>@endif
</div>
<div class="card"><div class="table-wrap"><table><tr><th>ID</th><th>Details</th><th>Status</th><th>Moderation</th><th>Actions</th></tr>
@forelse($items as $item)<tr><td>{{ $item->id }}</td><td>
@if($type==='papers'){{ $item->paper_name ?: $item->original_name }} — {{ $item->branch }} {{ $item->semester }}
@elseif($type==='notes'){{ $item->title ?: $item->subject_name }} — {{ $item->branch }} {{ $item->semester }}
@elseif($type==='gallery'){{ $item->category }} — {{ $item->original_name }}
@else{{ $item->name }} — {{ $item->contact }}<br>{{ $item->message }}
@endif
</td><td>{{ $item->status }}</td><td>
@if($type!=='messages')<form method="POST" action="{{ route('admin.content.status',[$type,$item->id]) }}">@csrf @method('PATCH')<select name="status"><option @selected($item->status==='pending')>pending</option><option @selected($item->status==='approved')>approved</option><option @selected($item->status==='rejected')>rejected</option></select><label>Reason<textarea name="rejection_reason">{{ $item->rejection_reason }}</textarea></label><button type="submit">Save Status</button></form>@endif
</td><td>
@if($type!=='messages')<a class="btn" href="{{ route('admin.content.edit',[$type,$item->id]) }}">Edit</a>@endif
<form style="display:inline" method="POST" action="{{ route('admin.content.destroy',[$type,$item->id]) }}" onsubmit="return confirm('Delete this record?')">@csrf @method('DELETE')<button class="danger" type="submit">Delete</button></form>
</td></tr>
@empty<tr><td colspan="5">No records.</td></tr>@endforelse
</table></div>{{ $items->links() }}</div>
@endsection
