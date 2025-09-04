<?php

namespace Wecm\AgeGate\Bootstrap;

/**
 * Plugin
 *
 * @author Christian Maul <hello@christianmaul.de>
 * @copyright 2025 Christian Maul
 */
class Plugin
{
    /**
     * Init Plugin
     */
    public static function init(): void
    {
        Config::init('wecmagegate');
        View::init(Config::class);

        self::requireHookFile();
        self::requireCommandFile();
        self::requireApplicationConfig();
        self::registerActivationHook();
        self::registerDeactivationHook();
    }

    /**
     * Require Hooks
     */
    protected static function requireHookFile(): void
    {
        require_once WP_PLUGIN_DIR
            . DIRECTORY_SEPARATOR . Config::get('pluginKey')
            . DIRECTORY_SEPARATOR . 'hooks.php';
    }

    /**
     * Require Commands
     */
    protected static function requireCommandFile(): void
    {
        require_once WP_PLUGIN_DIR
            . DIRECTORY_SEPARATOR . Config::get('pluginKey')
            . DIRECTORY_SEPARATOR . 'commands.php' ;
    }

    /**
     * Require Application Config
     */
    protected static function requireApplicationConfig(): void
    {
        require_once WP_PLUGIN_DIR
            . DIRECTORY_SEPARATOR . Config::get('pluginKey')
            . DIRECTORY_SEPARATOR . 'config'
            . DIRECTORY_SEPARATOR . 'application.php';
    }

    /**
     * Register Activation Hook
     */
    protected static function registerActivationHook(): void
    {
        if (!class_exists(\Wecm\AgeGate\Services\ActivationDeactivationService::class)) {
            return;
        }

        register_activation_hook(
            file: Config::get('pluginBaseName'),
            callback: [\Wecm\AgeGate\Services\ActivationDeactivationService::class, 'activate']
        );
    }

    /**
     * Register Deactivation Hook
     */
    protected static function registerDeactivationHook(): void
    {
        if (!class_exists(\Wecm\AgeGate\Services\ActivationDeactivationService::class)) {
            return;
        }
        
        register_deactivation_hook(
            file: Config::get('pluginBaseName'),
            callback: [\Wecm\AgeGate\Services\ActivationDeactivationService::class, 'deactivate']
        );
    }
}
