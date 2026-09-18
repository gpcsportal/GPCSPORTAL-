@extends('admin.layout')
@section('title','Users')
@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap"><h1>Users</h1><a class="btn" href="{{ route('admin.users.create') }}">Add Student / Faculty</a></div>
<div class="card"><div class="table-wrap"><table><tr><th>Name</th><th>Login</th><th>Role</th><th>Status</th><th>Actions</th></tr>
@forelse($users as $u)<tr><td>{{ $u->name }} {{ $u->surname }}</td><td>{{ $u->email }}<br><span class="muted">{{ $u->mobile }}</span></td><td>{{ ucfirst($u->role) }}</td><td><span class="status">{{ $u->is_active?'Active':'Suspended' }}</span></td><td><a class="btn" href="{{ route('admin.users.edit',$u) }}">Edit</a> <form style="display:inline" method="POST" action="{{ route('admin.users.toggle',$u) }}">@csrf @method('PATCH')<button type="submit">{{ $u->is_active?'Suspend':'Activate' }}</button></form> <form style="display:inline" method="POST" action="{{ route('admin.users.destroy',$u) }}" onsubmit="return confirm('Delete this account? Academic uploads will be retained under the Admin account.')">@csrf @method('DELETE')<button class="danger" type="submit">Delete</button></form></td></tr>
@empty<tr><td colspan="5">No users yet.</td></tr>@endforelse
</table></div>{{ $users->links() }}</div>
@endsection
