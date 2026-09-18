@extends('admin.layout')
@section('title',$managedUser->exists?'Edit User':'Add User')
@section('content')
<h1>{{ $managedUser->exists ? 'Edit User' : 'Add Student / Faculty' }}</h1>
<div class="card">
@if($errors->any())<div class="flash" style="background:#fff1f2;color:#9f1239"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<form method="POST" action="{{ $managedUser->exists ? route('admin.users.update',$managedUser) : route('admin.users.store') }}">
@csrf
@if($managedUser->exists) @method('PUT') @endif
<div class="grid">
<label>Role<select name="role" required><option value="student" @selected(old('role',$managedUser->role)==='student')>Student</option><option value="faculty" @selected(old('role',$managedUser->role)==='faculty')>Faculty</option></select></label>
<label>Full Name<input name="name" value="{{ old('name',$managedUser->name) }}" required></label>
<label>Surname<input name="surname" value="{{ old('surname',$managedUser->surname) }}" required></label>
<label>Gender<select name="gender" required>@foreach(['Male','Female','Other'] as $gender)<option @selected(old('gender',$managedUser->gender)===$gender)>{{ $gender }}</option>@endforeach</select></label>
<label>Email<input type="email" name="email" value="{{ old('email',$managedUser->email) }}" required></label>
<label>Mobile<input inputmode="numeric" maxlength="10" name="mobile" value="{{ old('mobile',$managedUser->mobile) }}"></label>
<label>College Name<input name="college_name" value="{{ old('college_name',$managedUser->college_name ?: 'Government Polytechnic College Shivpuri') }}" required></label>
<label>College Year<input name="college_year" value="{{ old('college_year',$managedUser->college_year) }}" placeholder="Student only"></label>
<label>Branch<select name="branch"><option value="">Faculty / Not applicable</option>@foreach($branches as $branch)<option value="{{ $branch }}" @selected(old('branch',$managedUser->branch)===$branch)>{{ $branch }}</option>@endforeach</select></label>
<label>Semester<select name="semester"><option value="">Faculty / Not applicable</option>@foreach(['I','II','III','IV','V','VI'] as $semester)<option @selected(old('semester',$managedUser->semester)===$semester)>{{ $semester }}</option>@endforeach</select></label>
<label>Subject / Department<input name="subject_department" value="{{ old('subject_department',$managedUser->subject_department) }}" placeholder="Faculty required"></label>
<label>Employee ID<input name="employee_id" value="{{ old('employee_id',$managedUser->employee_id) }}"></label>
<label>Pin Code<input inputmode="numeric" maxlength="6" name="pin_code" value="{{ old('pin_code',$managedUser->pin_code) }}"></label>
</div>
<label>Address<textarea name="address" required>{{ old('address',$managedUser->address) }}</textarea></label>
<label>{{ $managedUser->exists ? 'New Password (leave blank to keep current)' : 'Password' }}<input type="password" name="password" minlength="8" @required(!$managedUser->exists)></label>
<label>Confirm Password<input type="password" name="password_confirmation" minlength="8" @required(!$managedUser->exists)></label>
<input type="hidden" name="is_active" value="0">
<label style="display:flex;align-items:center;gap:10px"><input style="width:auto" type="checkbox" name="is_active" value="1" @checked(old('is_active',$managedUser->is_active ?? true))> Active account</label>
<button type="submit">{{ $managedUser->exists ? 'Save User' : 'Create User' }}</button>
</form>
</div>
@endsection
