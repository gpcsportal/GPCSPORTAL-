<?php

namespace App\Support;

final class SafePortalRedirect
{
    public static function sanitize(?string $target, string $fallback = '/'): string
    {
        if (! is_string($target)) {
            return $fallback;
        }

        $target = trim($target);
        if ($target === '' || strlen($target) > 2048) {
            return $fallback;
        }

        // Reject control characters, backslashes, protocol-relative URLs and
        // encoded variants that browsers can normalize into an external URL.
        $decoded = rawurldecode($target);
        if (
            preg_match('/[\x00-\x1F\x7F]/', $target) === 1
            || preg_match('/[\x00-\x1F\x7F]/', $decoded) === 1
            || str_contains($target, '\\')
            || str_contains($decoded, '\\')
            || str_starts_with($target, '//')
            || str_starts_with($decoded, '//')
        ) {
            return $fallback;
        }

        $parts = parse_url($target);
        if ($parts === false) {
            return $fallback;
        }

        if (isset($parts['scheme']) || isset($parts['host']) || isset($parts['user']) || isset($parts['pass'])) {
            return $fallback;
        }

        $path = $parts['path'] ?? '/';
        if (! str_starts_with($path, '/') || str_starts_with($path, '//')) {
            return $fallback;
        }

        // Never send an authenticated user back into an authentication action,
        // logout action, or password-recovery endpoint.
        $blockedPaths = [
            '/login',
            '/register',
            '/logout',
            '/forgot-password',
            '/reset-password',
        ];

        if (in_array(rtrim($path, '/') ?: '/', $blockedPaths, true)) {
            return $fallback;
        }

        $safe = $path;
        if (isset($parts['query']) && $parts['query'] !== '') {
            $safe .= '?'.$parts['query'];
        }
        if (isset($parts['fragment']) && $parts['fragment'] !== '') {
            $safe .= '#'.$parts['fragment'];
        }

        return $safe;
    }

    public static function loginUrl(string $intended): string
    {
        $safe = self::sanitize($intended, '/');

        return '/?auth_required=1&redirect='.rawurlencode($safe).'#login';
    }
}
