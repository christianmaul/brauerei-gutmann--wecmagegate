<?php

namespace Wecm\AgeGate\Filters;

/**
 * Avada Post Template Filter
 *
 * @author Christian Maul <hello@christianmaul.de>
 * @copyright 2025 Christian Maul
 */
class AvadaPostTemplateFilter
{
    /**
     * Handle
     *
     * @param array $templates Existing Post templates
     * @return array Modified Post template array
     */
    public static function handle($templates): array
    {
        unset($templates['default']);
        unset($templates['blank.php']);
        unset($templates['contact.php']);
        unset($templates['side-navigation.php']);

        return $templates;
    }
}
