<?php

namespace Wecm\AgeGate\Filters;

/**
 * Revision Limit Filter
 *
 * @author Christian Maul <hello@christianmaul.de>
 * @copyright 2025 Christian Maul
 */
class RevisionsLimitFilter
{
    /**
     * Handle
     *
     * @return int Number of available revisions
     */
    public static function handle(): int
    {
        return 5;
    }
}
