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

        // Always return the same response so this endpoint cannot be used to
        // discover whether an email address is registered in the portal.
        try {
            Password::sendResetLink([
                'email' => $validated['email'],
            ]);
        } catch (Throwable $exception) {
            report($exception);

            return response()->json([
                'message' => 'Password reset email is temporarily unavailable. Please try again later or contact the Admin.',
            ], 503);
        }

        return response()->json([
            'message' => 'If an account exists for that email, a password reset link has been sent.',
        ]);
    }
}
