<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use RuntimeException;
use Tests\TestCase;

class AccountRecoveryTest extends TestCase
{
    use RefreshDatabase;

    public function test_forgot_password_keeps_account_existence_private_and_sends_real_reset_notification(): void
    {
        Notification::fake();

        $user = User::create($this->attributes([
            'email' => 'recover@example.com',
        ]));

        $generic = 'If an account exists for that email, a password reset link has been sent.';

        $this->postJson('/forgot-password', [
            'email' => $user->email,
        ])->assertOk()->assertJson(['message' => $generic]);

        Notification::assertSentTo(
            $user,
            ResetPassword::class,
            static fn (ResetPassword $notification): bool => $notification->token !== ''
        );

        $this->postJson('/forgot-password', [
            'email' => 'unknown@example.com',
        ])->assertOk()->assertJson(['message' => $generic]);
    }

    public function test_mail_transport_failure_returns_service_unavailable_without_exposing_account_state(): void
    {
        Password::shouldReceive('sendResetLink')
            ->once()
            ->andThrow(new RuntimeException('SMTP unavailable'));

        $this->postJson('/forgot-password', [
            'email' => 'recover@example.com',
        ])->assertStatus(503)->assertJson([
            'message' => 'Password reset email is temporarily unavailable. Please try again later.',
        ]);
    }

    public function test_valid_reset_token_changes_password_and_returns_to_sign_in(): void
    {
        $user = User::create($this->attributes([
            'email' => 'reset@example.com',
        ]));

        $token = Password::broker()->createToken($user);

        $this->post('/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new-password-123',
            'password_confirmation' => 'new-password-123',
        ])->assertRedirect('/#login');

        $user->refresh();

        $this->assertTrue(Hash::check('new-password-123', $user->password));
        $this->assertFalse(Hash::check('password123', $user->password));
    }

    public function test_repeated_failed_login_attempts_are_rate_limited(): void
    {
        User::create($this->attributes([
            'email' => 'limited@example.com',
        ]));

        $client = $this->withServerVariables([
            'REMOTE_ADDR' => '198.51.100.40',
        ]);

        for ($attempt = 1; $attempt <= 10; $attempt++) {
            $client->postJson('/login', [
                'email' => 'limited@example.com',
                'password' => 'wrong-password',
                'role' => 'student',
            ])->assertUnprocessable();
        }

        $client->postJson('/login', [
            'email' => 'limited@example.com',
            'password' => 'wrong-password',
            'role' => 'student',
        ])->assertTooManyRequests();
    }

    private function attributes(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Recovery',
            'surname' => 'Tester',
            'email' => 'recovery@example.com',
            'password' => 'password123',
            'role' => 'student',
            'gender' => 'Male',
            'college_name' => 'Government Polytechnic College Shivpuri',
            'address' => 'Shivpuri',
            'is_active' => true,
        ], $overrides);
    }
}
