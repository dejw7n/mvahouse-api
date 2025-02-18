<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group(['middleware' => 'auth', 'prefix' => 'api'], function ($router) {
    $router->get('me', 'AuthController@me');

    $router->group(['prefix' => 'apartment'], function () use ($router) {
        $router->get('', ['uses' => 'ApartmentController@showAllApartments']);

        $router->get('/{id}', ['uses' => 'ApartmentController@showOneApartment']);

        $router->post('', ['uses' => 'ApartmentController@create']);

        $router->delete('/{id}', ['uses' => 'ApartmentController@delete']);

        $router->put('/{id}', ['uses' => 'ApartmentController@update']);
    });
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
});
