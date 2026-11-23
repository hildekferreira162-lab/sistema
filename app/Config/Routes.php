<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');
$routes->get('/home', 'ConteudoController::index');
$routes->get('/contatos', 'ConteudoController::contatos');

// Registra as rotas padrão do CodeIgniter Shield (/login, /register, /logout, etc.)
service('auth')->routes($routes);

// Rotas que exigem autenticação por sessão
$routes->group('', ['filter' => 'session'], static function ($routes) {
    $routes->get('conteudos', 'ConteudoController::listar');
    $routes->get('conteudos/editar/(:num)', 'ConteudoController::editar/$1');
    $routes->post('conteudos/atualizar/(:num)', 'ConteudoController::atualizar/$1');
});

// Painel: exige login e grupo admin (sem duplicação)
$routes->get('admin', 'Admin\Painel::index', [
    'filter' => ['session', 'group:admin'],
]);

// Logout: aceita apenas usuários autenticados
// Dica: mude para 'get' se for usar um link <a> simples, ou mantenha 'post' se usar um <form>
$routes->post('admin/sair', 'Admin\Painel::logout', [
    'filter' => 'session',
]);