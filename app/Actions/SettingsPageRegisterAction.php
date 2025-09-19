<?php

namespace Wecm\AgeGate\Actions;

use Wecm\AgeGate\Bootstrap\Config;
use Wecm\Core\Exceptions\DebugException;
use Wecm\Core\Providers\SettingsPageProvider;

/**
 * Settings Page Register Action
 *
 * @author Christian Maul <hello@christianmaul.de>
 * @copyright 2025 Christian Maul
 */
class SettingsPageRegisterAction
{
    /**
     * Handle
     */
    public static function handle(): void
    {
        try {
            SettingsPageProvider::init(
                settingsPageSlug: Config::get('pluginKey'),
                pageTitle: __('Age Gate Settings', 'wecmagegate'),
                menuTitle: __('Age Gate', 'wecmagegate'),
            )
                ->addTextField(
                    name: 'exclude_page_ids',
                    label: __('Exclude Page Ids', 'wecmagegate'),
                )
                ->addTextField(
                    name: 'legal_page_id',
                    label: __('Legal Page Id', 'wecmagegate'),
                )
                ->addTextField(
                    name: 'privacy_page_id',
                    label: __('Privacy Page Id', 'wecmagegate'),
                )
                ->register();
        } catch (DebugException $e) {
            $e->getAdminNotice();
        } 
    }
}