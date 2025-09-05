<?php

namespace Wecm\AgeGate\Actions;

use Wecm\AgeGate\Bootstrap\Config;
use Wecm\AgeGate\Services\CookieService;
use Wecm\Core\Exceptions\DebugException;
use Wecm\Core\Services\HttpRequestService;
use Wecm\Core\Services\RedirectService;

/**
 * AgeGateFormSubmitAction
 *
 * @author Christian Maul <hello@christianmaul.de>
 * @copyright 2025 Christian Maul
 */
class AgeGateFormSubmitAction
{
    /**
     * Handle
     */
    public static function handle(): void
    {
        $postDataKey = Config::get('pluginKey');
        $postData = HttpRequestService::init($postDataKey)
            ->hasPost()
            ->retrieve();

        try {
            $confirmStatus = $postData['POST']['status'] ?? 'decline';
            $currentPageId = (int) $postData['POST']['pageid'] ?? 0;
            self::confirmVisitorsAge($confirmStatus);
            self::redirectToCurrentPage($currentPageId);  
        } catch (DebugException $e) {
            $errorPageId = Config::get('errorPageId');
            RedirectService::init($errorPageId)
                ->isSafe()
                ->redirect();
        }    
    }

    /**
     * Confirm the visitor's age
     *
     * @param string $confirmStatus Submitted age gate status
     * @return void
     */
    private static function confirmVisitorsAge(string $confirmStatus): void
    {
        $isCookieSet = false;

        if ($confirmStatus === 'confirm') {
            $isCookieSet = CookieService::set($confirmStatus);
        }

        if ($isCookieSet) {
            return;
        }

        throw new DebugException(
            message: __('Cookie could not be set.', 'wecmagegate')
        );
    }

    /**
     * Redirect to the page, the visitor originally wanted to access
     * 
     * @param int $currentPageId Page id
     * @return void
     */
    private static function redirectToCurrentPage(int $currentPageId): void
    {
        if (get_post($currentPageId)) {
            RedirectService::init($currentPageId)
                ->isSafe()
                ->redirect();
            
            return;
        }

        throw new DebugException(
            message: __('Page ID is missing or invalid.', 'wecmagegate')
        );
    }
}