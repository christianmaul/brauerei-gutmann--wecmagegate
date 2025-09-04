<?php

namespace Wecm\AgeGate\Actions;

use Wecm\AgeGate\Bootstrap\Config;
use Wecm\Core\Exceptions\DebugException;
use Wecm\Core\Providers\TranslationProvider;

/**
 * Add Plugin Textdomain
 *
 * @author Christian Maul <hello@christianmaul.de>
 * @copyright 2025 Christian Maul
 */
class TextdomainAction
{
    /**
     * Handle
     */
    public static function handle(): void
    {
        try {
            $textdomain = Config::get('pluginKey');
            TranslationProvider::init($textdomain)->load();
        } catch (DebugException $e) {
            $e->getAdminNotice();
        }
    }
}
