<?php

use Wecm\AgeGate\Enums\DataTransferEnum;
use Wecm\Core\Providers\ActionProvider;
use Wecm\Core\Providers\FilterProvider;
use Wecm\Core\Providers\ShortcodeProvider;

/**
 * Actions
 */
ActionProvider::init(
    hookName: 'wp_enqueue_scripts',
    callback: Wecm\AgeGate\Actions\AssetsFrontendAction::class
)->add();

ActionProvider::init(
    hookName: 'plugins_loaded',
    callback: Wecm\AgeGate\Actions\TextdomainAction::class
)->add();

ActionProvider::init(
    hookName: 'plugins_loaded',
    callback: Wecm\AgeGate\Actions\AgeGateInitAction::class
)->add();

ActionProvider::initBulk(
    hookNames: [
        'admin_post_' . DataTransferEnum::AGE_GATE_SUBMIT->value,
        'admin_post_nopriv_' . DataTransferEnum::AGE_GATE_SUBMIT->value,
    ],
    callback: Wecm\AgeGate\Actions\AgeGateFormSubmitAction::class
)->add();

/**
 * Filters
 */

/**
 * Shortcodes
 */
