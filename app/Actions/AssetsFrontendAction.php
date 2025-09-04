<?php

namespace Wecm\AgeGate\Actions;

use Wecm\AgeGate\Bootstrap\Config;
use Wecm\Core\Exceptions\DebugException;
use Wecm\Core\Providers\EnqueueProvider;

/**
 * Assets Frontend Action
 *
 * @author Christian Maul <hello@christianmaul.de>
 * @copyright 2025 Christian Maul
 */
class AssetsFrontendAction
{
    /**
     * Asset Enqueue Id
     */
    private static $handle;

    /**
     * Handle
     */
    public static function handle(): void
    {
        self::$handle = Config::get('pluginKey') . '-main';
        self::enqueueCSS();
        self::enqueueJS();
    }

    /**
     * Enqueue CSS
     */
    private static function enqueueCSS(): void
    {
        try {
            $dependencies = self::getStylesheetDependencies();
            $cssPath = Config::get('publicRootPath')
                . DIRECTORY_SEPARATOR . 'css'
                . DIRECTORY_SEPARATOR . 'main.css';

            EnqueueProvider::init(self::$handle)
                ->setDependencies($dependencies)
                ->setPath($cssPath)
                ->enqueue();
        } catch (DebugException $e) {
            $e->getAdminNotice();
        }
    }

    /**
     * Get Stylesheet Dependencies
     *
     * @return array Stylesheet dependencies
     */
    private static function getStylesheetDependencies(): array
    {
        $handles = [
            'wecmcore-global',
            'wecmcontent-main'
        ];

        $currentTheme = wp_get_theme();

        if ($currentTheme->Name === 'Avada' && !is_user_logged_in()) {
            $handles[] = 'fusion-dynamic-css';
        }

        return $handles;
    }

    /**
     * Enqueue JS
     */
    private static function enqueueJS(): void
    {
        try {
            $jsPath = Config::get('publicRootPath')
                . DIRECTORY_SEPARATOR . 'js'
                . DIRECTORY_SEPARATOR . 'main.js';

            EnqueueProvider::init(self::$handle)
                ->setPath($jsPath)
                ->isloadedInFooter()
                ->enqueue();
        } catch (DebugException $e) {
            $e->getAdminNotice();
        }
    }
}