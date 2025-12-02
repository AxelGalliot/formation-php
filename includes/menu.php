<?php
$items = [
    '/' => 'Accueil',
    '/lecture-csv' => 'Lecture CSV',
    '/carnet-contacts' => 'Carnet de contacts',
];

$currentPath = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$currentPath = $currentPath === '' ? '/' : $currentPath;

function route_url(string $path): string {
    return $path;
}
?>
<nav class="site-nav">
    <?php foreach ($items as $path => $label): ?>
        <a href="<?= htmlspecialchars(route_url($path), ENT_QUOTES); ?>"
            class="<?= $currentPath === rtrim($path, '/') ? 'active' : ''; ?>">
            <?= htmlspecialchars($label, ENT_QUOTES); ?>
        </a>
    <?php endforeach; ?>
</nav>