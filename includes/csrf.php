<?php

function generateCsrfToken(): string
{
    if (empty($_SESSION[CSRF_TOKEN_NAME])) {
        $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
    }

    return $_SESSION[CSRF_TOKEN_NAME];
}

function csrfField(): string
{
    return '<input type="hidden" name="' . CSRF_TOKEN_NAME . '" value="' . generateCsrfToken() . '">';
}

function verifyCsrfToken(?string $token = null): bool
{
    $token = $token ?? ($_POST[CSRF_TOKEN_NAME] ?? '');

    if (empty($_SESSION[CSRF_TOKEN_NAME]) || empty($token)) {
        return false;
    }

    return hash_equals($_SESSION[CSRF_TOKEN_NAME], $token);
}

function validateCsrf(): void
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!verifyCsrfToken()) {
            setFlash('error', 'Session expiree. Veuillez reessayer.');
            redirectBack();
        }
    }
}

function regenerateCsrfToken(): void
{
    $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
}
