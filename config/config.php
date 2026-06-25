<?php
define('DEBUG_MODE', true);

define('APP_NAME', 'Stress Manager');
define('APP_VERSION', '1.0.0');
define('APP_URL', '[localhost](http://localhost:8080/stress-manager)');

define('ROOT_PATH', dirname(__DIR__) . '/');
define('CONFIG_PATH', ROOT_PATH . 'config/');
define('CONTROLLERS_PATH', ROOT_PATH . 'controllers/');
define('MODELS_PATH', ROOT_PATH . 'models/');
define('VIEWS_PATH', ROOT_PATH . 'views/');
define('INCLUDES_PATH', ROOT_PATH . 'includes/');
define('ASSETS_PATH', ROOT_PATH . 'assets/');

define('ASSETS_URL', APP_URL . '/assets');
define('CSS_URL', ASSETS_URL . '/css');
define('JS_URL', ASSETS_URL . '/js');
define('IMAGES_URL', ASSETS_URL . '/images');

define('SESSION_NAME', 'stress_manager_session');
define('SESSION_LIFETIME', 7200);

define('COOKIE_PATH', '/');
define('COOKIE_SECURE', false);
define('COOKIE_HTTPONLY', true);

define('CSRF_TOKEN_NAME', 'csrf_token');
define('PASSWORD_MIN_LENGTH', 8);

date_default_timezone_set('Europe/Paris');

if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

mb_internal_encoding('UTF-8');
