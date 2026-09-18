<?php

namespace Tests\Feature;

use App\Models\PortalNotification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotificationSafetyTest extends TestCase
{
    use RefreshDatabase;

    public function test_protocol_relative_notice_link_is_rejected(): void
    {
        $admin = User::create($this->adminAttributes());

        $this->actingAs($admin)
            ->withSession(['admin_last_activity' => now()->timestamp])
            ->from('/admin/notifications')
            ->post('/admin/notifications', [
                'audience' => 'all',
                'title' => 'Unsafe notice',
                'message' => 'Unsafe link should not be saved.',
                'link' => '//evil.example/phishing',
            ])
            ->assertRedirect('/admin/notifications')
            ->assertSessionHasErrors(['link']);

        $this->assertDatabaseMissing('portal_notifications', [
            'title' => 'Unsafe notice',
        ]);
    }

    public function test_safe_internal_notice_link_is_saved(): void
    {
        $admin = User::create($this->adminAttributes([
            'email' => 'notice2.admin@example.com',
            'admin_identifier' => 'notice-admin-2',
        ]));

        $this->actingAs($admin)
            ->withSession(['admin_last_activity' => now()->timestamp])
            ->from('/admin/notifications')
            ->post('/admin/notifications', [
                'audience' => 'students',
                'title' => 'Notes notice',
                'message' => 'New notes are available.',
                'link' => '/#notes',
            ])
            ->assertRedirect('/admin/notifications')
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('portal_notifications', [
            'title' => 'Notes notice',
            'link' => '/#notes',
        ]);

        $this->assertSame(1, PortalNotification::count());
    }

    private function adminAttributes(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Notice',
            'surname' => 'Admin',
            'email' => 'notice.admin@example.com',
            'password' => 'password123',
            'role' => 'admin',
            'admin_identifier' => 'notice-admin',
            'gender' => 'Other',
            'college_name' => 'Government Polytechnic College Shivpuri',
            'address' => 'Shivpuri',
            'is_active' => true,
        ], $overrides);
    }
}
