<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FileCompressionService;
use App\Services\UploadStorageService;
use App\Services\PortalSettingsService;
use App\Support\SafePortalRedirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use RuntimeException;
use Throwable;

class PortalAuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'role' => ['required', Rule::in(['student', 'faculty'])],
            'remember' => ['sometimes', 'boolean'],
            'redirect' => ['nullable', 'string', 'max:2048'],
        ]);

        $remember = (bool) ($validated['remember'] ?? false);

        if (! Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
            'is_active' => true,
        ], $remember)) {
            return response()->json([
                'message' => 'Invalid credentials, role, or account is not active.',
            ], 422);
        }

        $request->session()->regenerate();
        $request->user()->forceFill(['last_login_at' => now()])->save();

        $fallback = $this->redirectForRole($request->user()->role);
        $intended = $validated['redirect'] ?? $request->session()->pull('url.intended');
        $redirect = SafePortalRedirect::sanitize($intended, $fallback);
        $request->session()->forget('url.intended');

        return response()->json([
            'message' => 'Signed in successfully.',
            'role' => $request->user()->role,
            'redirect' => $redirect,
        ]);
    }

    public function register(
        Request $request,
        FileCompressionService $images,
        UploadStorageService $storageCapacity
    )
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
            'redirect' => ['nullable', 'string', 'max:2048'],
            'terms_accepted' => ['required', 'accepted'],
        ];

        if ($role === 'student') {
            $rules += [
                'college_year' => 'required|string|max:30',
                'branch' => ['required', Rule::in(app(PortalSettingsService::class)->branches())],
                'semester' => 'required|in:I,II,III,IV,V,VI',
            ];
        } else {
            $rules += [
                'subject_department' => 'required|string|max:255',
                'employee_id' => 'nullable|string|max:100',
            ];
        }

        $validated = $request->validate($rules);
        $requestedRedirect = $validated['redirect'] ?? null;
        unset($validated['redirect'], $validated['terms_accepted']);

        $photo = null;
        $profileFile = $request->file('profile_photo');

        if ($profileFile && ! $profileFile->isValid()) {
            return response()->json([
                'message' => 'The profile photo could not be read. Please choose it again.',
            ], 422);
        }

        if ($profileFile && ! $storageCapacity->hasCapacityFor((int) $profileFile->getSize())) {
            return response()->json([
                'message' => 'Upload storage is nearly full. Please create the account without a profile photo or contact the Admin.',
            ], 507);
        }

        try {
            if ($profileFile) {
                $storedPhoto = $profileFile->store('profiles', 'public');

                if (! is_string($storedPhoto) || $storedPhoto === '') {
                    throw new RuntimeException('Profile photo storage returned an empty path.');
                }

                $photo = $storedPhoto;
                $disk = Storage::disk('public');

                if (! $disk->exists($photo)) {
                    throw new RuntimeException('Stored profile photo is missing from the public disk.');
                }

                $absolutePhotoPath = $disk->path($photo);
                if (! is_file($absolutePhotoPath) || ! is_readable($absolutePhotoPath)) {
                    throw new RuntimeException('Stored profile photo is not readable.');
                }

                $images->compressImageInPlace($absolutePhotoPath);

                clearstatcache(true, $absolutePhotoPath);
                $finalPhotoSize = filesize($absolutePhotoPath);
                if ($finalPhotoSize === false || $finalPhotoSize <= 0) {
                    throw new RuntimeException('Stored profile photo is empty after processing.');
                }
            }

            // A completed Student or Faculty sign-up is immediately usable. Admin
            // can still suspend an account later, but there is no post-sign-up role
            // approval gate between account creation and portal access.
            $user = User::create(array_merge($validated, [
                'profile_photo_path' => $photo,
                'is_active' => true,
            ]));
        } catch (Throwable $exception) {
            if ($photo) {
                Storage::disk('public')->delete($photo);
            }

            report($exception);

            return response()->json([
                'message' => 'Account could not be created right now. Please try again.',
            ], 500);
        }

        Auth::login($user);
        $request->session()->regenerate();

        $fallback = $this->redirectForRole($user->role);
        $intended = $requestedRedirect ?? $request->session()->pull('url.intended');
        $redirect = SafePortalRedirect::sanitize($intended, $fallback);
        $request->session()->forget('url.intended');

        return response()->json([
            'message' => 'Account created successfully.',
            'role' => $user->role,
            'redirect' => $redirect,
        ], 201);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/?logged_out=1#home')
            ->withHeaders([
                'Cache-Control' => 'no-store, private',
                'Pragma' => 'no-cache',
            ]);
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
