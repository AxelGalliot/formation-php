<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/fonctions.php';

$uri = $_SERVER['PATH_INFO'] ?? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');
$uri = $uri === '' ? '/' : $uri;

$routes = [
    '/' => 'home',
    '/lecture-csv' => 'lecture-csv',
    '/carnet-contacts' => 'carnet-contacts',
];

$pageKey = $routes[$uri] ?? null;

if ($pageKey === null) {
    http_response_code(404);
    $title = 'Page non trouvée';
    require_once __DIR__ . '/../includes/header.php';
    echo "<h1>404 - Page non trouvée</h1>";
    require_once __DIR__ . '/../includes/footer.php';
    exit;
}
$title = match ($pageKey) {
    'home' => 'Accueil',
    'lecture-csv' => 'Lecture CSV',
    'carnet-contacts' => 'Carnet de contacts',
    default => 'Mon site PHP',
};

require_once __DIR__ . '/../includes/header.php';
require __DIR__ . "/../pages/{$pageKey}.php";
require_once __DIR__ . '/../includes/footer.php'; 