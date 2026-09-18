<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Throwable;

class ForgotPasswordController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            $status = Password::sendResetLink([
                'email' => $validated['email'],
            ]);
        } catch (Throwable $exception) {
            report($exception);

            return response()->json([
                'message' => 'Password reset email is temporarily unavailable. Please try again later.',
            ], 503);
        }

        // Keep registered and unknown addresses indistinguishable to prevent
        // account enumeration. Transport failures are reported separately
        // above so the UI never falsely claims that an email was sent.
        if (in_array($status, [Password::RESET_LINK_SENT, Password::INVALID_USER], true)) {
            return response()->json([
                'message' => 'If an account exists for that email, a password reset link has been sent.',
            ]);
        }

        return response()->json([
            'message' => 'Password reset email is temporarily unavailable. Please try again later.',
        ], 503);
    }
}
