<?php

namespace Wecm\AgeGate\Actions;

use Wecm\AgeGate\Bootstrap\Config;
use Wecm\AgeGate\Services\CookieService;
use Wecm\Core\Providers\FilterProvider;

/**
 * Age Gate Initialization Action
 *
 * @author Christian Maul <hello@christianmaul.de>
 * @copyright 2025 Christian Maul
 */
class AgeGateInitAction
{
    /**
     * Handle
     */
    public static function handle(): void
    {
        $cookieName = Config::get('cookieName');
        
        if (!CookieService::isSet($cookieName)) {
            FilterProvider::init(
                hookName: 'avada_before_body_content',
                callback: \Wecm\AgeGate\Filters\AgeGateFormRenderFilter::class
            )->add();
        }

    }
}