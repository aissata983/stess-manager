<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = parse_url(APP_URL, PHP_URL_PATH);
$path = '/' . trim(str_replace($basePath, '', $uri), '/');

if ($path === '//' || $path === '') {
    $path = '/';
}

$method = $_SERVER['REQUEST_METHOD'];

$authController = new AuthController();
$dashboardController = new DashboardController();
$emotionController = new EmotionController();
$exerciceController = new ExerciceController();
$meditationController = new MeditationController();
$conseilController = new ConseilController();
$statistiqueController = new StatistiqueController();
$profilController = new ProfilController();
$adminController = new AdminController();

switch (true) {
    case $path === '/':
        if (isLoggedIn()) {
            redirect('/dashboard');
        }
        redirect('/login');
        break;

    case $path === '/login' && $method === 'GET':
        $authController->showLogin();
        break;

    case $path === '/login' && $method === 'POST':
        $authController->login();
        break;

    case $path === '/register' && $method === 'GET':
        $authController->showRegister();
        break;

    case $path === '/register' && $method === 'POST':
        $authController->register();
        break;

    case $path === '/logout' && $method === 'GET':
        $authController->logout();
        break;

    case $path === '/dashboard' && $method === 'GET':
        $dashboardController->index();
        break;

    case $path === '/emotions' && $method === 'GET':
        $emotionController->index();
        break;

    case $path === '/emotions/create' && $method === 'GET':
        $emotionController->create();
        break;

    case $path === '/emotions/store' && $method === 'POST':
        $emotionController->store();
        break;

    case $path === '/emotions/history' && $method === 'GET':
        $emotionController->history();
        break;

    case $path === '/exercices' && $method === 'GET':
        $exerciceController->index();
        break;

    case preg_match('#^/exercices/([^/]+)$#', $path, $matches) && $method === 'GET':
        $exerciceController->show($matches[1]);
        break;

    case $path === '/exercices/complete' && $method === 'POST':
        $exerciceController->complete();
        break;

    case $path === '/meditation' && $method === 'GET':
        $meditationController->index();
        break;

    case $path === '/meditation/complete' && $method === 'POST':
        $meditationController->complete();
        break;

    case preg_match('#^/meditation/([^/]+)$#', $path, $matches) && $method === 'GET':
        $meditationController->show($matches[1]);
        break;

    case $path === '/conseils' && $method === 'GET':
        $conseilController->index();
        break;

    case preg_match('#^/conseils/([^/]+)$#', $path, $matches) && $method === 'GET':
        $conseilController->show($matches[1]);
        break;

    case $path === '/statistiques' && $method === 'GET':
        $statistiqueController->index();
        break;

    case $path === '/profil' && $method === 'GET':
        $profilController->index();
        break;

    case $path === '/profil/update' && $method === 'POST':
        $profilController->update();
        break;

    case $path === '/profil/password' && $method === 'POST':
        $profilController->updatePassword();
        break;

    case $path === '/admin' && $method === 'GET':
        $adminController->index();
        break;

    case $path === '/admin/users' && $method === 'GET':
        $adminController->users();
        break;

    case $path === '/admin/users/delete' && $method === 'POST':
        $adminController->deleteUser();
        break;

    case $path === '/admin/statistiques' && $method === 'GET':
        $adminController->statistiques();
        break;

    default:
        http_response_code(404);
        view('errors.404', [
            'pageTitle' => 'Page introuvable'
        ]);
        break;
}
