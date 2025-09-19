<?php

namespace Wecm\AgeGate\Filters;

use Wecm\AgeGate\Enums\DataTransferEnum;
use Wecm\Core\Providers\SettingsPageProvider;
use Wecm\AgeGate\Bootstrap\Config;
use Wecm\AgeGate\Bootstrap\View;

/**
 * Age Gate Form Render Filter
 *
 * @author Christian Maul <hello@christianmaul.de>
 * @copyright 2025 Christian Maul
 */
class AgeGateFormRenderFilter
{
    /**
     * Handle
     *
     * @return string Empty String
     */
    public static function handle(): void
    {
        $currentPageId = get_queried_object_id();
        $settingsKey = Config::get('pluginKey');
        $excludeIds = self::getExcludedIds($settingsKey);

        if (in_array($currentPageId, $excludeIds) || is_user_logged_in()) {
            return;
        } 

        echo View::render('templates.age-gate', [
            'actionUrl' => admin_url('admin-post.php'),
            'actionName' => DataTransferEnum::AGE_GATE_SUBMIT->value,
            'namePrefix' => Config::get('pluginKey'),
            'logo' => SettingsPageProvider::fetch('fusion_options', 'logo'),
            'legalId' => SettingsPageProvider::fetch($settingsKey, 'legal_page_id'),
            'privacyId' => SettingsPageProvider::fetch($settingsKey, 'privacy_page_id'),
            'pageId' => $currentPageId,
        ]);
    }

    /**
     * Get excluded Page Ids from settings
     * 
     * @return array Array ofq   Page Ids
     */
    private static function getExcludedIds(string $settingsKey): array
    {
        $settingsRaw = SettingsPageProvider::fetch(
            settingsKey: $settingsKey,
            arrayKey: 'exclude_page_ids'
        );

        $pageIds = explode(
            string: $settingsRaw,
            separator: ','
        );

        return array_filter(
            array: array_map('trim', $pageIds)
        );
    }
}
