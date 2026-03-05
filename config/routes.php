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

// --- Trajets (statiques en premier) ---
$router->get('/trajets/create', function(Request $req, Response $res) {
    (new \Benjamin\Klaxon\Controllers\TrajetController())->create();
});
$router->post('/trajets/create', function(Request $req, Response $res) {
    (new \Benjamin\Klaxon\Controllers\TrajetController())->store();
});
$router->get('/trajets/:id/edit', function(Request $req, Response $res, int $id) {
    (new \Benjamin\Klaxon\Controllers\TrajetController())->edit($id);
});
$router->post('/trajets/:id/edit', function(Request $req, Response $res, int $id) {
    (new \Benjamin\Klaxon\Controllers\TrajetController())->update($id);
});
$router->post('/trajets/:id/delete', function(Request $req, Response $res, int $id) {
    (new \Benjamin\Klaxon\Controllers\TrajetController())->destroy($id);
});

// --- Admin ---
$router->get('/admin', function(Request $req, Response $res) {
    echo "Admin OK";
});

$router->run();