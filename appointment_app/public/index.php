<?php

require_once '../vendor/autoload.php';

use app\controllers\HomeController;

declare(strict_types=1);

session_start();
require_once __DIR__ . '/../config/config.php';

// Autoloader pour charger automatiquement les classes
spl_autoload_register(function (string $class_name) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class_name) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$request = $_SERVER['REQUEST_URI'];
$controller = 'HomeController';
$action = 'index';

if ($request !== '/') {
    $params = explode('/', trim($request, '/'));
    $controller = ucfirst($params[0]) . 'Controller';
    $action = $params[1] ?? 'index';
}

$controllerClass = 'app\\controllers\\' . $controller;
$controllerInstance = new $controllerClass();
$controllerInstance->$action();
?>
