<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title><?php echo $title ?? 'Mon site PHP'; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<header class="site-header">
  <h1><?php echo $title ?? 'Mon site PHP'; ?></h1>
  <?php include __DIR__ . '/menu.php'; ?>
</header>
<main class="container">