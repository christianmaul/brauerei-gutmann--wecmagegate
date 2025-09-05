<?php

namespace Wecm\AgeGate\Services;

use Wecm\AgeGate\Bootstrap\Config;

/**
 * Cookie Service
 *
 * @author Christian Maul <hello@christianmaul.de>
 * @copyright 2025 Christian Maul
 */
class CookieService
{
    /**
     * Set cookie
     *
     * @param string $confirmStatus Submitted age gate status
     * @return bool Success status
     */
    public static function set(string $confirmStatus): bool
    {
        return setcookie(
            expires_or_options: Config::get('cookieExpireTimestamp'),
            name: Config::get('cookieName'),
            value: $confirmStatus,
            path: '/',
        );
    }

    /**
     * Check if cookie is set
     */
    public static function isSet(string $cookieName): bool
    {
        return isset($_COOKIE[$cookieName]);
    }
}