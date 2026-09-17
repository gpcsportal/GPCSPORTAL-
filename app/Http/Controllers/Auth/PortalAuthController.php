<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FileCompressionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PortalAuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'role' => ['required', Rule::in(['student', 'faculty'])],
            'remember' => ['sometimes', 'boolean'],
        ]);

        $remember = (bool) ($validated['remember'] ?? false);

        if (! Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
            'is_active' => true,
        ], $remember)) {
            return response()->json([
                'message' => 'Invalid credentials, role, or account is awaiting approval.',
            ], 422);
        }

        $request->session()->regenerate();
        $request->user()->forceFill(['last_login_at' => now()])->save();

        return response()->json([
            'message' => 'Signed in successfully.',
            'role' => $request->user()->role,
            'redirect' => $this->redirectForRole($request->user()->role),
        ]);
    }

    public function register(Request $request, FileCompressionService $images)
    {
        $role = $request->input('role');

        $rules = [
            'role' => ['required', Rule::in(['student', 'faculty'])],
            'name' => 'required|string|max:120',
            'surname' => 'required|string|max:120',
            'gender' => 'required|in:Male,Female,Other',
            'college_name' => 'required|string|max:180',
            'email' => 'required|email|max:190|unique:users,email',
            'mobile' => 'nullable|digits:10|unique:users,mobile',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:1000',
            'pin_code' => 'nullable|digits:6',
            'profile_photo' => 'nullable|image|max:5120',
        ];

        if ($role === 'student') {
            $rules += [
                'college_year' => 'required|string|max:30',
                'branch' => 'required|in:CS,ME,EE,ET',
                'semester' => 'required|in:I,II,III,IV,V,VI',
            ];
        } else {
            $rules += [
                'subject_department' => 'required|string|max:255',
                'employee_id' => 'nullable|string|max:100',
            ];
        }

        $validated = $request->validate($rules);
        $photo = null;

        if ($request->hasFile('profile_photo')) {
            $photo = $request->file('profile_photo')->store('profiles', 'public');
            $images->compressImageInPlace(storage_path('app/public/'.$photo));
        }

        $isFaculty = $role === 'faculty';

        $user = User::create(array_merge($validated, [
            'profile_photo_path' => $photo,
            'is_active' => ! $isFaculty,
        ]));

        if ($isFaculty) {
            return response()->json([
                'message' => 'Faculty registration submitted. An Admin must approve the account before sign-in.',
                'role' => 'faculty',
                'pending_approval' => true,
                'redirect' => route('portal.home', absolute: false).'#login',
            ], 201);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            'message' => 'Account created successfully.',
            'role' => 'student',
            'redirect' => $this->redirectForRole('student'),
        ], 201);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function redirectForRole(string $role): string
    {
        return match ($role) {
            'student' => route('portal.home', absolute: false).'#student-dashboard',
            'faculty' => route('portal.home', absolute: false).'#faculty-dashboard',
            default => route('portal.home', absolute: false),
        };
    }
}
