<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AdminActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function login(Request $request, AdminActivityService $log)
    {
        $validated = $request->validate([
            'admin_login' => 'required|string|max:190',
            'password' => 'required|string|max:255',
        ]);

        $user = User::where('role', 'admin')
            ->where('is_active', true)
            ->where(fn ($query) => $query
                ->where('email', $validated['admin_login'])
                ->orWhere('admin_identifier', $validated['admin_login']))
            ->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return back()->withErrors([
                'admin_login' => 'Invalid Admin credentials.',
            ]);
        }

        if (Hash::needsRehash($user->password)) {
            $user->forceFill([
                'password' => Hash::make($validated['password']),
            ])->save();
        }

        Auth::login($user);
        $request->session()->regenerate();
        $request->session()->put('admin_last_activity', now()->timestamp);
        $user->forceFill(['last_login_at' => now()])->save();

        $log->log('admin_login', 'user', $user->id);

        return redirect()->route('admin.dashboard');
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
}
