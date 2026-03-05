<?php

declare(strict_types=1);

use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$router = new Router;

// --- Page d'accueil ---
$router->get('/', function(Request $req, Response $res) {
    (new \Benjamin\Klaxon\Controllers\HomeController())->index();
});

// --- Authentification ---
$router->get('/login', function(Request $req, Response $res) {
    (new \Benjamin\Klaxon\Controllers\AuthController())->showLogin();
});
$router->post('/login', function(Request $req, Response $res) {
    (new \Benjamin\Klaxon\Controllers\AuthController())->login();
});
$router->get('/logout', function(Request $req, Response $res) {
    (new \Benjamin\Klaxon\Controllers\AuthController())->logout();
});

$router->run();