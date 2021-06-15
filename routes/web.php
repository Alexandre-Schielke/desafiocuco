<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use App\Http\Controllers\ClientesController;

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


//rotas para lista, inserir, atualizar e deletetar registro de usuário
$router->group(['prefix' => 'clientes'],  function () use($router){
//    $router->get('/list', [ClientesController::class, 'index']);
    $router->get('/list', 'ClientesController@index');
    $router->post('/list', 'ClientesController@index');
    $router->post('/store', 'ClientesController@store');
//    $router->get('/show/id/{id}', 'Api\UsersController@show');
//    $router->get('/show/nome/{nome}', 'Api\UsersController@showNome');
    $router->delete('/destroy/{id}', 'ClientesController@destroy');
//    $router->put('/update/{id}', 'Api\UsersController@update');
});
