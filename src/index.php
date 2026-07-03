<?php
declare(strict_types=1);
require_once __DIR__ . '/SessionHelper.php';
require_once __DIR__ . '/Router.php';
require_once __DIR__ . '/Controllers/AuthController.php';
require_once __DIR__ . '/Controllers/MateriaController.php';

SessionHelper::startSecureSession();

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router = new Router();
$authController = new AuthController();
$materiaController = new MateriaController();

// Rutas públicas
$router->addRoute('GET', '/login', [$authController, 'showLogin']);
$router->addRoute('POST', '/login', [$authController, 'login']);
$router->addRoute('POST', '/logout', [$authController, 'logout']);

// Rutas protegidas (Requieren sesión)
$router->addRoute('GET', '/', function() {
    header("Location: /materias");
    exit;
});
$router->addRoute('GET', '/materias', [$materiaController, 'index']);
$router->addRoute('GET', '/materias/nueva', [$materiaController, 'create']);
$router->addRoute('POST', '/materias', [$materiaController, 'store']);
$router->addRoute('GET', '/materias/([0-9]+)/editar', [$materiaController, 'edit']);
$router->addRoute('POST', '/materias/([0-9]+)', [$materiaController, 'update']);
$router->addRoute('POST', '/materias/([0-9]+)/eliminar', [$materiaController, 'delete']);

// Manejar la petición
try {
    $router->dispatch($method, $requestUri);
} catch (Exception $e) {
    if ($e->getMessage() === 'Unauthorized') {
        header("Location: /login", true, 302);
        exit;
    }
    http_response_code(404);
    echo "404 Not Found";
}
