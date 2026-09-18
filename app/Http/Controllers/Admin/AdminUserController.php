<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Models\Note;
use App\Models\Paper;
use App\Models\User;
use App\Services\AdminActivityService;
use App\Services\PortalSettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::where('role', '!=', 'admin')->latest()->paginate(30),
        ]);
    }

    public function create(PortalSettingsService $settings)
    {
        return view('admin.users.form', [
            'managedUser' => new User(['role' => 'student', 'is_active' => true]),
            'branches' => $settings->branches(),
        ]);
    }

    public function store(
        Request $request,
        PortalSettingsService $settings,
        AdminActivityService $log
    ) {
        $validated = $this->validated($request, $settings);
        $validated['is_active'] = $request->boolean('is_active');
        $validated = $this->normalizeRoleFields($validated);

        $user = User::create($validated);
        $log->log('user_created', 'user', $user->id, [
            'role' => $user->role,
            'is_active' => $user->is_active,
        ]);

        return redirect()->route('admin.users.index')
            ->with('status', 'User account created.');
    }

    public function edit(User $user, PortalSettingsService $settings)
    {
        abort_if($user->isAdmin(), 404);

        return view('admin.users.form', [
            'managedUser' => $user,
            'branches' => $settings->branches(),
        ]);
    }

    public function update(
        Request $request,
        User $user,
        PortalSettingsService $settings,
        AdminActivityService $log
    ) {
        abort_if($user->isAdmin(), 422);

        $validated = $this->validated($request, $settings, $user);
        $validated['is_active'] = $request->boolean('is_active');
        $validated = $this->normalizeRoleFields($validated);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $wasActive = (bool) $user->is_active;
        $user->update($validated);

        if ($wasActive && ! $user->is_active) {
            DB::table('sessions')->where('user_id', $user->id)->delete();
        }

        $log->log('user_updated', 'user', $user->id, [
            'role' => $user->role,
            'is_active' => $user->is_active,
        ]);

        return redirect()->route('admin.users.index')
            ->with('status', 'User account updated.');
    }

    public function toggle(User $user, AdminActivityService $log)
    {
        abort_if($user->isAdmin(), 422);

        $new = ! $user->is_active;
        $user->update([
            'is_active' => $new,
            'suspended_at' => $new ? null : now(),
        ]);

        if (! $new) {
            DB::table('sessions')->where('user_id', $user->id)->delete();
        }

        $log->log('user_status_changed', 'user', $user->id, [
            'is_active' => $new,
        ]);

        return back()->with('status', 'User status updated.');
    }

    public function destroy(
        User $user,
        Request $request,
        AdminActivityService $log
    ) {
        abort_if($user->isAdmin(), 422);

        $targetId = $user->id;
        $profilePath = $user->profile_photo_path;
        $adminId = $request->user()->id;

        DB::transaction(function () use ($targetId, $adminId, $user): void {
            Paper::where('user_id', $targetId)->update(['user_id' => $adminId]);
            Note::where('user_id', $targetId)->update(['user_id' => $adminId]);
            GalleryImage::where('user_id', $targetId)->update(['user_id' => $adminId]);
            DB::table('sessions')->where('user_id', $targetId)->delete();
            $user->delete();
        });

        if ($profilePath) {
            Storage::disk('public')->delete($profilePath);
        }

        $log->log('user_deleted', 'user', $targetId, [
            'content_reassigned_to_admin' => $adminId,
        ]);

        return back()->with('status', 'User deleted. Academic uploads were retained under the Admin account.');
    }

    private function validated(
        Request $request,
        PortalSettingsService $settings,
        ?User $user = null
    ): array {
        $userId = $user?->id;

        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'surname' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190', Rule::unique('users', 'email')->ignore($userId)],
            'mobile' => ['nullable', 'digits:10', Rule::unique('users', 'mobile')->ignore($userId)],
            'password' => [$user ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['student', 'faculty'])],
            'gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
            'college_name' => ['required', 'string', 'max:255'],
            'college_year' => ['nullable', 'string', 'max:30'],
            'branch' => ['nullable', Rule::in($settings->branches())],
            'semester' => ['nullable', Rule::in(['I', 'II', 'III', 'IV', 'V', 'VI'])],
            'subject_department' => ['nullable', 'string', 'max:255'],
            'employee_id' => ['nullable', 'string', 'max:100'],
            'pin_code' => ['nullable', 'digits:6'],
            'address' => ['required', 'string', 'max:2000'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    private function normalizeRoleFields(array $data): array
    {
        if ($data['role'] === 'student') {
            validator($data, [
                'college_year' => ['required'],
                'branch' => ['required'],
                'semester' => ['required'],
            ])->validate();

            $data['subject_department'] = null;
            $data['employee_id'] = null;
        } else {
            validator($data, [
                'subject_department' => ['required'],
            ])->validate();

            $data['college_year'] = null;
            $data['branch'] = null;
            $data['semester'] = null;
        }

        return $data;
    }
}
