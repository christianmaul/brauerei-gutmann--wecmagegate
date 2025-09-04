<?php

/**
 * Overwrite default configuration
 */
$envConfig = __DIR__
    . DIRECTORY_SEPARATOR . 'environments'
    . DIRECTORY_SEPARATOR . WP_ENV . '.php';

if (file_exists($envConfig)) {
    require_once $envConfig;
}
