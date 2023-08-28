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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=>'api/service/bengkels'], function() use($router){

    $router->get('/', 'BengkelController@index');
    $router->get('/approvedbengkel', 'BengkelController@approvedbengkel');
    $router->post('/', 'BengkelController@create');
    $router->get('/{id_bengkel}', 'BengkelController@show');
    $router->put('/{id_bengkel}', 'BengkelController@update');
    $router->put('/{id_bengkel}/approve', 'BengkelController@approved');
    $router->put('/{id_bengkel}/reject', 'BengkelController@rejected');
});
$router->group(['prefix'=>'api/service/services'], function() use($router){

    $router->get('/', 'ServiceController@index');
    $router->post('/', 'ServiceController@create');
    $router->get('/{id_service}', 'ServiceController@show');
    $router->put('/{id_service}', 'ServiceController@update');
    $router->put('/{id_service}/approve', 'ServiceController@approved');
    $router->put('/{id_service}/reject', 'ServiceController@rejected');
});