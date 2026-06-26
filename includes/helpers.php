<?php

function e(string $string): string
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function redirect(string $url): void
{
    header('Location: ' . APP_URL . $url);
    exit;
}

function redirectBack(): void
{
    $referer = $_SERVER['HTTP_REFERER'] ?? APP_URL;
    header('Location: ' . $referer);
    exit;
}

function url(string $path = ''): string
{
    return APP_URL . '/' . ltrim($path, '/');
}

function asset(string $path): string
{
    return ASSETS_URL . '/' . ltrim($path, '/');
}

function view(string $name, array $data = []): void
{
    extract($data);
    $viewPath = VIEWS_PATH . str_replace('.', '/', $name) . '.php';

    if (file_exists($viewPath)) {
        require $viewPath;
    } else {
        throw new Exception('Vue non trouvee : ' . $name);
    }
}

function formatDate(string $date, string $format = 'd/m/Y'): string
{
    $dateTime = new DateTime($date);
    return $dateTime->format($format);
}

function timeAgo(string $datetime): string
{
    $time = strtotime($datetime);
    $diff = time() - $time;

    if ($diff < 60) {
        return "A l'instant";
    } elseif ($diff < 3600) {
        $mins = floor($diff / 60);
        return "Il y a {$mins} minute" . ($mins > 1 ? 's' : '');
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return "Il y a {$hours} heure" . ($hours > 1 ? 's' : '');
    } elseif ($diff < 604800) {
        $days = floor($diff / 86400);
        return "Il y a {$days} jour" . ($days > 1 ? 's' : '');
    }

    return formatDate($datetime);
}

function slugify(string $text): string
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

function truncate(string $text, int $length = 100, string $suffix = '...'): string
{
    if (mb_strlen($text) <= $length) {
        return $text;
    }

    return mb_substr($text, 0, $length) . $suffix;
}

function formatDuration(int $seconds): string
{
    if ($seconds < 60) {
        return $seconds . 's';
    } elseif ($seconds < 3600) {
        $mins = floor($seconds / 60);
        $secs = $seconds % 60;
        return $mins . 'min' . ($secs > 0 ? ' ' . $secs . 's' : '');
    }

    $hours = floor($seconds / 3600);
    $mins = floor(($seconds % 3600) / 60);
    return $hours . 'h' . ($mins > 0 ? ' ' . $mins . 'min' : '');
}

function isAjax(): bool
{
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

function jsonResponse(array $data, int $statusCode = 200): void
{
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function getMoodIcon(string $mood): string
{
    $icons = [
        'tres_heureux' => '😄',
        'heureux' => '🙂',
        'neutre' => '😐',
        'stresse' => '😟',
        'tres_stresse' => '😰'
    ];

    return $icons[$mood] ?? '😐';
}

function getMoodLabel(string $mood): string
{
    $labels = [
        'tres_heureux' => 'Très heureux',
        'heureux' => 'Heureux',
        'neutre' => 'Neutre',
        'stresse' => 'Stressé',
        'tres_stresse' => 'Très stressé'
    ];

    return $labels[$mood] ?? 'Inconnu';
}

function getMoodColor(string $mood): string
{
    $colors = [
        'tres_heureux' => '#4CAF50',
        'heureux' => '#8BC34A',
        'neutre' => '#FFC107',
        'stresse' => '#FF9800',
        'tres_stresse' => '#F44336'
    ];

    return $colors[$mood] ?? '#9E9E9E';
}

function getCategoryIcon(string $category): string
{
    $icons = [
        'temps' => 'fa-clock',
        'sommeil' => 'fa-moon',
        'alimentation' => 'fa-apple-alt',
        'physique' => 'fa-running',
        'relaxation' => 'fa-spa',
        'mental' => 'fa-brain'
    ];

    return $icons[$category] ?? 'fa-lightbulb';
}

function getCategoryLabel(string $category): string
{
    $labels = [
        'temps' => 'Gestion du temps',
        'sommeil' => 'Sommeil',
        'alimentation' => 'Alimentation',
        'physique' => 'Activite physique',
        'relaxation' => 'Relaxation',
        'mental' => 'Mental'
    ];

    return $labels[$category] ?? 'Autre';
}
