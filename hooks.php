<?php

use Wecm\Core\Providers\ActionProvider;
use Wecm\Core\Providers\FilterProvider;
use Wecm\Core\Providers\ShortcodeProvider;

/**
 * Actions
 */
ActionProvider::init(
    hookName: 'admin_enqueue_scripts',
    callback: Wecm\AgeGate\Actions\AssetsAdminAction::class
)->add();

ActionProvider::init(
    hookName: 'wp_enqueue_scripts',
    callback: Wecm\AgeGate\Actions\AssetsFrontendAction::class
)->add();

ActionProvider::init(
    hookName: 'plugins_loaded',
    callback: Wecm\AgeGate\Actions\TextdomainAction::class
)->add();

/**
 * Filters
 */

/**
 * Shortcodes
 */
