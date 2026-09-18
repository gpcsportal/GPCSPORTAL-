<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthGateReturnTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_stays_public_while_feature_apis_require_authentication(): void
    {
        $this->get('/')->assertOk();
        $this->getJson('/auth/status')->assertOk()->assertJson([
            'authenticated' => false,
            'role' => null,
        ]);

        foreach (['/api/papers', '/api/notes', '/api/gallery', '/metadata/papers'] as $url) {
            $this->getJson($url)->assertUnauthorized();
        }
    }

    public function test_guest_browser_route_keeps_safe_intended_path_in_login_redirect(): void
    {
        $response = $this->get('/go/syllabus');

        $response->assertStatus(302);
        $location = (string) $response->headers->get('Location');
        $this->assertStringContainsString('auth_required=1', $location);
        $this->assertStringContainsString('redirect=%2Fgo%2Fsyllabus', $location);
        $this->assertStringEndsWith('#login', $location);
    }

    public function test_login_returns_to_internal_intended_destination(): void
    {
        User::create($this->userAttributes([
            'email' => 'student@example.com',
            'role' => 'student',
        ]));

        $this->postJson('/login', [
            'email' => 'student@example.com',
            'password' => 'password123',
            'role' => 'student',
            'redirect' => '/#notes',
        ])->assertOk()->assertJson([
            'redirect' => '/#notes',
            'role' => 'student',
        ]);

        $this->assertAuthenticated();
    }

    public function test_external_login_redirect_is_rejected(): void
    {
        User::create($this->userAttributes([
            'email' => 'student2@example.com',
            'role' => 'student',
        ]));

        $this->postJson('/login', [
            'email' => 'student2@example.com',
            'password' => 'password123',
            'role' => 'student',
            'redirect' => 'https://evil.example/steal',
        ])->assertOk()->assertJson([
            'redirect' => '/#student-dashboard',
        ]);
    }

    public function test_student_signup_logs_in_and_returns_to_intended_page(): void
    {
        $response = $this->postJson('/register', [
            'role' => 'student',
            'name' => 'Test',
            'surname' => 'Student',
            'gender' => 'Male',
            'college_name' => 'Government Polytechnic College Shivpuri',
            'email' => 'newstudent@example.com',
            'mobile' => '9876500001',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'address' => 'Shivpuri',
            'college_year' => 'First Year',
            'branch' => 'CS',
            'semester' => 'I',
            'redirect' => '/#papers',
            'terms_accepted' => '1',
        ]);

        $response->assertCreated()->assertJson([
            'role' => 'student',
            'redirect' => '/#papers',
        ]);
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'newstudent@example.com',
            'is_active' => 1,
        ]);
    }

    public function test_faculty_signup_is_immediately_active_and_returns_to_intended_page(): void
    {
        $response = $this->postJson('/register', [
            'role' => 'faculty',
            'name' => 'Test',
            'surname' => 'Faculty',
            'gender' => 'Female',
            'college_name' => 'Government Polytechnic College Shivpuri',
            'email' => 'newfaculty@example.com',
            'mobile' => '9876500002',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'address' => 'Shivpuri',
            'subject_department' => 'Computer Science',
            'employee_id' => 'FAC-001',
            'redirect' => '/#gallery',
            'terms_accepted' => '1',
        ]);

        $response->assertCreated()->assertJson([
            'role' => 'faculty',
            'redirect' => '/#gallery',
        ]);
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'newfaculty@example.com',
            'is_active' => 1,
        ]);
    }

    public function test_authenticated_user_can_use_allowlisted_official_outbound_route(): void
    {
        $user = User::create($this->userAttributes([
            'email' => 'active@example.com',
            'role' => 'student',
        ]));

        $this->actingAs($user)
            ->get('/go/syllabus')
            ->assertRedirect('https://www.rgpvdiploma.in/Academics/AICTEBased.aspx');
    }

    private function userAttributes(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Portal',
            'surname' => 'User',
            'email' => 'portal@example.com',
            'password' => 'password123',
            'role' => 'student',
            'gender' => 'Male',
            'college_name' => 'Government Polytechnic College Shivpuri',
            'address' => 'Shivpuri',
            'is_active' => true,
        ], $overrides);
    }
}
