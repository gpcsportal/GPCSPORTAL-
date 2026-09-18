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

class OutsiderAuditHardeningTest extends TestCase
{
    use RefreshDatabase;

    public function test_terms_and_privacy_pages_are_public_and_registration_links_to_them(): void
    {
        $this->get('/terms')
            ->assertOk()
            ->assertSee('Terms &amp; Conditions', false);

        $this->get('/privacy')
            ->assertOk()
            ->assertSee('Privacy Policy');

        $this->get('/')
            ->assertOk()
            ->assertSee(route('portal.terms', absolute: false), false)
            ->assertSee(route('portal.privacy', absolute: false), false)
            ->assertSee('data-gpcs-public-link', false);
    }

    public function test_registration_requires_terms_consent_server_side(): void
    {
        $payload = [
            'role' => 'student',
            'name' => 'Consent',
            'surname' => 'Tester',
            'gender' => 'Male',
            'college_name' => 'Government Polytechnic College Shivpuri',
            'email' => 'consent@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'address' => 'Shivpuri',
            'college_year' => 'First Year',
            'branch' => 'CS',
            'semester' => 'I',
        ];

        $this->postJson('/register', $payload)
            ->assertUnprocessable()
            ->assertJsonValidationErrors('terms_accepted');

        $this->postJson('/register', $payload + ['terms_accepted' => '1'])
            ->assertCreated()
            ->assertJson(['role' => 'student']);
    }

    public function test_password_reset_request_sends_reset_notification_without_revealing_account_existence(): void
    {
        Notification::fake();

        $user = User::create($this->userAttributes([
            'email' => 'reset-user@example.com',
        ]));

        $this->postJson('/forgot-password', [
            'email' => $user->email,
        ])->assertOk()->assertJson([
            'message' => 'If an account exists for that email, a password reset link has been sent.',
        ]);

        Notification::assertSentTo(
            $user,
            ResetPassword::class,
            static fn (ResetPassword $notification): bool => is_string($notification->token)
                && $notification->token !== ''
        );

        $this->postJson('/forgot-password', [
            'email' => 'not-registered@example.com',
        ])->assertOk()->assertJson([
            'message' => 'If an account exists for that email, a password reset link has been sent.',
        ]);
    }

    public function test_password_reset_mail_failure_returns_a_safe_service_error(): void
    {
        Password::shouldReceive('sendResetLink')
            ->once()
            ->andThrow(new RuntimeException('SMTP unavailable'));

        $this->postJson('/forgot-password', [
            'email' => 'mail-failure@example.com',
        ])->assertStatus(503)->assertJson([
            'message' => 'Password reset email is temporarily unavailable. Please try again later or contact the Admin.',
        ]);
    }

    public function test_password_reset_broker_throttle_does_not_claim_an_email_was_sent(): void
    {
        Password::shouldReceive('sendResetLink')
            ->once()
            ->andReturn(Password::RESET_THROTTLED);

        $this->postJson('/forgot-password', [
            'email' => 'throttled@example.com',
        ])->assertStatus(503)->assertJson([
            'message' => 'Password reset email is temporarily unavailable. Please try again later or contact the Admin.',
        ]);
    }

    public function test_protected_upload_directory_is_not_configured_for_public_symlinking(): void
    {
        $this->assertSame([], config('filesystems.links'));

        $response = $this->get('/storage/private-paper.pdf');

        $this->assertContains(
            $response->getStatusCode(),
            [403, 404],
            'Protected upload paths must never be served successfully from /storage.'
        );
    }

    public function test_password_reset_token_changes_the_password(): void
    {
        $user = User::create($this->userAttributes([
            'email' => 'reset-token-user@example.com',
        ]));

        $token = Password::broker()->createToken($user);

        $this->post('/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new-secure-password',
            'password_confirmation' => 'new-secure-password',
        ])->assertRedirect('/#login');

        $user->refresh();

        $this->assertTrue(Hash::check('new-secure-password', $user->password));
    }

    public function test_admin_notification_rejects_protocol_relative_or_backslash_links(): void
    {
        $admin = User::create($this->userAttributes([
            'email' => 'notification-admin@example.com',
            'role' => 'admin',
            'admin_identifier' => 'notification-admin',
        ]));

        $this->actingAs($admin)
            ->postJson('/admin/notifications', [
                'audience' => 'all',
                'title' => 'Unsafe notice',
                'message' => 'Do not allow protocol-relative links.',
                'link' => '//evil.example/phish',
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('link');

        $this->actingAs($admin)
            ->postJson('/admin/notifications', [
                'audience' => 'all',
                'title' => 'Unsafe notice',
                'message' => 'Do not allow backslash paths.',
                'link' => '/\\evil.example',
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('link');

        $this->actingAs($admin)
            ->postJson('/admin/notifications', [
                'audience' => 'all',
                'title' => 'Unsafe notice',
                'message' => 'Credential-bearing links are not allowed.',
                'link' => 'https://user:pass@example.com/path',
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('link');

        $this->actingAs($admin)
            ->post('/admin/notifications', [
                'audience' => 'all',
                'title' => 'Safe notice',
                'message' => 'Internal portal links are allowed.',
                'link' => '/#notes',
            ])
            ->assertRedirect();
    }

    public function test_removed_otp_and_chunk_preview_code_do_not_return(): void
    {
        $template = (string) file_get_contents(resource_path('views/portal.blade.php'));

        $this->assertStringNotContainsString('previewStudentOtp', $template);
        $this->assertStringNotContainsString('previewFacultyOtp', $template);
        $this->assertStringNotContainsString('otpTimer', $template);
        $this->assertStringNotContainsString('MAX_UPLOAD_BYTES', $template);
        $this->assertStringNotContainsString('/* Chunk uploader */', $template);
    }

    public function test_repeated_failed_logins_are_rate_limited(): void
    {
        $payload = [
            'email' => 'missing-account@example.com',
            'password' => 'definitely-wrong',
            'role' => 'student',
        ];

        for ($attempt = 1; $attempt <= 10; $attempt++) {
            $this->withServerVariables(['REMOTE_ADDR' => '198.51.100.77'])
                ->postJson('/login', $payload)
                ->assertUnprocessable();
        }

        $this->withServerVariables(['REMOTE_ADDR' => '198.51.100.77'])
            ->postJson('/login', $payload)
            ->assertTooManyRequests();
    }

    private function userAttributes(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Portal',
            'surname' => 'User',
            'email' => 'outsider-audit@example.com',
            'password' => 'password123',
            'role' => 'student',
            'gender' => 'Male',
            'college_name' => 'Government Polytechnic College Shivpuri',
            'address' => 'Shivpuri',
            'is_active' => true,
        ], $overrides);
    }
}
