<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_terms_and_privacy_pages_are_public(): void
    {
        $this->get('/terms')
            ->assertOk()
            ->assertSee('GPCS Portal Terms of Use');

        $this->get('/privacy')
            ->assertOk()
            ->assertSee('GPCS Portal Privacy Notice');
    }

    public function test_registration_requires_explicit_terms_acceptance(): void
    {
        $this->postJson('/register', [
            'role' => 'student',
            'name' => 'Policy',
            'surname' => 'Tester',
            'gender' => 'Male',
            'college_name' => 'Government Polytechnic College Shivpuri',
            'email' => 'policy@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'address' => 'Shivpuri',
            'college_year' => 'First Year',
            'branch' => 'CS',
            'semester' => 'I',
        ])->assertUnprocessable()
            ->assertJsonValidationErrors(['terms_accepted']);
    }

    public function test_faculty_registration_requires_login_credentials_even_when_mobile_and_pin_are_optional(): void
    {
        $this->postJson('/register', [
            'role' => 'faculty',
            'name' => 'Faculty',
            'surname' => 'Tester',
            'gender' => 'Female',
            'college_name' => 'Government Polytechnic College Shivpuri',
            'address' => 'Shivpuri',
            'subject_department' => 'Computer Science',
            'terms_accepted' => '1',
        ])->assertUnprocessable()
            ->assertJsonValidationErrors(['email', 'password']);
    }
}
