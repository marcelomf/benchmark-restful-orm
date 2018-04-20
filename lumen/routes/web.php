<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/*$app->get('/', function () use ($app) {
    return $app->version();
});*/

$app->get('/', function ()  {
    return view('home');
});

$app->get('/admin/usuarios', function ()  {
    return view('usuarios');
});

$app->get('usuarios/count', 'UsuarioController@count');
$app->get('usuarios/show/{id}', 'UsuarioController@show');
$app->get('usuarios/query', 'UsuarioController@query');
$app->post('usuarios', 'UsuarioController@create');
$app->put('usuarios/{id}', 'UsuarioController@update');
$app->delete('usuarios/{id}', 'UsuarioController@destroy');
