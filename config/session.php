<?php

if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.use_strict_mode', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', COOKIE_SECURE ? 1 : 0);
    ini_set('session.cookie_samesite', 'Lax');
    ini_set('session.gc_maxlifetime', SESSION_LIFETIME);

    session_name(SESSION_NAME);

    session_set_cookie_params([
        'lifetime' => SESSION_LIFETIME,
        'path' => COOKIE_PATH,
        'domain' => '',
        'secure' => COOKIE_SECURE,
        'httponly' => COOKIE_HTTPONLY,
        'samesite' => 'Lax'
    ]);

    session_start();

    if (!isset($_SESSION['session_created'])) {
        $_SESSION['session_created'] = time();
    } elseif (time() - $_SESSION['session_created'] > 1800) {
        session_regenerate_id(true);
        $_SESSION['session_created'] = time();
    }
}

function destroySession(): void
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }

    session_destroy();
}
