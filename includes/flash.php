<?php

function setFlash(string $type, string $message): void
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}

function getFlash(): ?array
{
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }

    return null;
}

function hasFlash(): bool
{
    return isset($_SESSION['flash']);
}

function displayFlash(): string
{
    $flash = getFlash();

    if (!$flash) {
        return '';
    }

    $icons = [
        'success' => 'fa-check-circle',
        'error' => 'fa-exclamation-circle',
        'warning' => 'fa-exclamation-triangle',
        'info' => 'fa-info-circle'
    ];

    $icon = $icons[$flash['type']] ?? 'fa-info-circle';

    return sprintf(
        '<div class="alert alert-%s" role="alert">
            <i class="fas %s"></i>
            <span>%s</span>
            <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>',
        e($flash['type']),
        $icon,
        e($flash['message'])
    )
}
