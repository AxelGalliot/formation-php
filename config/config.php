<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', 1); // Dev : 1  | Prod : 0
ini_set('log_errors', 1);
ini_set('error_log', dirname(__DIR__) . '/logs/php_errors.log');

// Constantes de chemin utiles
define('BASE_PATH', dirname(__DIR__));
define('PUBLIC_PATH', BASE_PATH . '/public');
define('INCLUDES_PATH', BASE_PATH . '/includes');
define('DATA_PATH', BASE_PATH . '/data');

class LoggedException extends RuntimeException {}

$logDir = __DIR__ . '/../logs';
if (!is_dir($logDir)) {
	mkdir($logDir, 0775, true);
}

function gestionnaireException(Throwable $e): void {
    $ctx = [
        'class' => get_class($e),
        'code' => $e->getCode(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString(),
        'url'  => $_SERVER['REQUEST_URI'] ?? 'CLI',
        'method' => $_SERVER['REQUEST_METHOD'] ?? 'CLI',
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'CLI',
    ];
    $line = sprintf("[%s] %s | %s\n",
        date('Y-m-d H:i:s'),
        $e->getMessage(),
        json_encode($ctx, JSON_UNESCAPED_SLASHES)
    );

    file_put_contents($GLOBALS['logDir'] . '/exceptions.log', $line, FILE_APPEND);
}

set_error_handler(function($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

set_exception_handler(function(Throwable $e) {
    if (!($e instanceof LoggedException)) {
        gestionnaireException($e);
    }
    
    http_response_code(500);
    
    if (ini_get('display_errors')) {
        echo "<h1>Erreur fatale</h1>";
        echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
        echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    } else {
        echo "<h1>Une erreur est survenue</h1>";
        echo "<p>Veuillez réessayer plus tard.</p>";
    }
    exit;
});