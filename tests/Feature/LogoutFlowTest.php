<?php

namespace Tests\Feature;

use App\Models\User;
use App\Support\SafePortalRedirect;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_student_sees_logout_and_logout_invalidates_session(): void
    {
        $user = User::create($this->attributes([
            'email' => 'student-logout@example.com',
            'role' => 'student',
        ]));

        $this->actingAs($user)
            ->get('/')
            ->assertOk()
            ->assertSee('class="gpcs-logout-btn"', false)
            ->assertDontSee('class="gpcs-signin-btn reference-signin"', false)
            ->assertHeader('Cache-Control', 'no-store, private')
            ->assertHeader('Pragma', 'no-cache');

        $this->actingAs($user)
            ->post('/logout')
            ->assertRedirect('/?logged_out=1#home')
            ->assertHeader('Cache-Control', 'no-store, private');

        $this->assertGuest();

        $this->getJson('/api/papers')->assertUnauthorized();
        $this->get('/go/syllabus')
            ->assertRedirect(SafePortalRedirect::loginUrl('/go/syllabus'));
    }

    public function test_authenticated_faculty_can_logout_and_loses_protected_api_access(): void
    {
        $user = User::create($this->attributes([
            'email' => 'faculty-logout@example.com',
            'role' => 'faculty',
        ]));

        $this->actingAs($user)
            ->get('/')
            ->assertOk()
            ->assertSee('Logout');

        $this->actingAs($user)
            ->post('/logout')
            ->assertRedirect('/?logged_out=1#home');

        $this->assertGuest();
        $this->getJson('/api/notes')->assertUnauthorized();
    }

    public function test_admin_logout_invalidates_session_and_admin_route_is_protected_afterwards(): void
    {
        $admin = User::create($this->attributes([
            'email' => 'admin-logout@example.com',
            'role' => 'admin',
            'admin_identifier' => 'admin-logout',
        ]));

        $this->actingAs($admin)
            ->get('/admin')
            ->assertOk()
            ->assertSee('Logout');

        $this->actingAs($admin)
            ->post('/admin/logout')
            ->assertRedirect('/?logged_out=1#home')
            ->assertHeader('Cache-Control', 'no-store, private');

        $this->assertGuest();
        $this->get('/admin')
            ->assertRedirect(SafePortalRedirect::loginUrl('/admin'));
    }

    public function test_guest_header_keeps_sign_in_instead_of_logout(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('GPCS Sign In')
            ->assertDontSee('class="gpcs-logout-btn"', false);
    }

    private function attributes(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Portal',
            'surname' => 'User',
            'email' => 'portal-logout@example.com',
            'password' => 'password123',
            'role' => 'student',
            'gender' => 'Male',
            'college_name' => 'Government Polytechnic College Shivpuri',
            'address' => 'Shivpuri',
            'is_active' => true,
        ], $overrides);
    }
}
