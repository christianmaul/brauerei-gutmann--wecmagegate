<?php

namespace Wecm\AgeGate\Actions;

use Wecm\AgeGate\Bootstrap\Config;
use Wecm\Core\Exceptions\DebugException;
use Wecm\Core\Providers\EnqueueProvider;

/**
 * Assets Admin Action
 *
 * @author Christian Maul <hello@christianmaul.de>
 * @copyright 2025 Christian Maul
 */
class AssetsAdminAction
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
        self::$handle = Config::get('pluginKey') . '-admin';
        self::enqueueAdminCss();
        self::enqueueAdminJs(); 
    }

    /**
     * Enqueue CSS
     */
    private static function enqueueAdminCss(): void
    {
         try {
            $dependencies = self::getStylesheetDependencies();
            $cssAdminPath = Config::get('publicRootPath')
                . DIRECTORY_SEPARATOR . 'css'
                . DIRECTORY_SEPARATOR . 'admin.css';

            EnqueueProvider::init(self::$handle)
                ->setDependencies($dependencies)
                ->setPath($cssAdminPath)
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
            'wecmcore-admin'
        ];

        $currentTheme = wp_get_theme();

        if ($currentTheme->Name === 'Avada') {
            $handles[] = 'avada-wp-admin-css';
        }

        return $handles;
    }

    /**
     * Enqueue Admin script
     */
    private static function enqueueAdminJs(): void
    {
        try {
            $jsAdminPath = Config::get('publicRootPath')
                . DIRECTORY_SEPARATOR . 'js'
                . DIRECTORY_SEPARATOR . 'admin.js';

            EnqueueProvider::init(self::$handle)
                ->setPath($jsAdminPath)
                ->enqueue();
        } catch (DebugException $e) {
            $e->getAdminNotice();
        }
    }
}
