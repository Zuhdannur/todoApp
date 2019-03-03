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

/**
 * Routes for resource todo
 */
$router->get('todo', 'TodosController@all');
$router->get('todo/{id}', 'TodosController@get');
$router->post('todo', 'TodosController@add');
$router->post('todo/{id}', 'TodosController@put');
$router->delete('todo/{id}', 'TodosController@remove');

/**
 * Routes for resource Todo
 */
