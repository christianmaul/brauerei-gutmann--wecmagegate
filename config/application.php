<?php
use \Wecm\AgeGate\Bootstrap\Config;

Config::set('errorPageId', 64);
Config::set('cookieName', 'age_verified');
Config::set('cookieExpireTimestamp', strtotime('+ 4 weeks'));

/**
 * Overwrite default configuration
 */
$envConfig = __DIR__
    . DIRECTORY_SEPARATOR . 'environments'
    . DIRECTORY_SEPARATOR . WP_ENV . '.php';

if (file_exists($envConfig)) {
    require_once $envConfig;
}
