<?php
$pageTitle = $pageTitle ?? APP_NAME;
$currentUser = getUser();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> - <?= e(APP_NAME) ?></title>
    <meta name="description" content="Application de gestion du stress et de bien-etre numerique">
    <link rel="stylesheet" href="<?= asset('css/variables.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/main.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/auth.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/dashboard.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/exercices.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/meditation.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/admin.css') ?>">
    <link rel="preconnect" href="[fonts.googleapis.com](https://fonts.googleapis.com)">
    <link rel="preconnect" href="[fonts.gstatic.com](https://fonts.gstatic.com)" crossorigin>
    <link href="[fonts.googleapis.com](https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap)" rel="stylesheet">
    <link rel="stylesheet" href="[cdnjs.cloudflare.com](https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css)">
    <script src="[cdn.jsdelivr.net](https://cdn.jsdelivr.net/npm/chart.js)"></script>
</head>
<body>
<div class="app-shell">
