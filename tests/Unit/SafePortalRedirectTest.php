<?php

namespace Tests\Unit;

use App\Support\SafePortalRedirect;
use PHPUnit\Framework\TestCase;

class SafePortalRedirectTest extends TestCase
{
    public function test_internal_paths_are_preserved(): void
    {
        $this->assertSame('/#notes', SafePortalRedirect::sanitize('/#notes', '/fallback'));
        $this->assertSame('/notes/42/download?mode=view', SafePortalRedirect::sanitize('/notes/42/download?mode=view', '/fallback'));
        $this->assertSame('/go/syllabus', SafePortalRedirect::sanitize('/go/syllabus', '/fallback'));
    }

    public function test_external_and_protocol_relative_urls_are_rejected(): void
    {
        $this->assertSame('/fallback', SafePortalRedirect::sanitize('https://evil.example/path', '/fallback'));
        $this->assertSame('/fallback', SafePortalRedirect::sanitize('//evil.example/path', '/fallback'));
        $this->assertSame('/fallback', SafePortalRedirect::sanitize('/\\evil.example/path', '/fallback'));
        $this->assertSame('/fallback', SafePortalRedirect::sanitize('/%5C%5Cevil.example/path', '/fallback'));
    }

    public function test_auth_actions_are_not_valid_post_auth_destinations(): void
    {
        $this->assertSame('/fallback', SafePortalRedirect::sanitize('/login', '/fallback'));
        $this->assertSame('/fallback', SafePortalRedirect::sanitize('/logout', '/fallback'));
        $this->assertSame('/fallback', SafePortalRedirect::sanitize('/forgot-password', '/fallback'));
    }
}
