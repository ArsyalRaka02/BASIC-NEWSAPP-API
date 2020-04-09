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
use Illuminate\Http\Request;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//Generate App key
$router->get('/key', 'AuthController@generateRandomString');

//berita
$router->get('/berita', 'BeritaController@view');
$router->get('/berita/{id}', 'BeritaController@viewId');
$router->get('/berita/show/{id}', "BeritaController@getKategory");
$router->post('/berita', 'BeritaController@create');
$router->put('/berita/{id}', 'BeritaController@update');
$router->delete('/berita/{id}', 'BeritaController@destroy');

//kategori
$router->get('/kategori', 'KategoriController@view');
$router->get('/kategori/{id}', 'KategoriController@viewId');
$router->post('/kategori', 'KategoriController@create');
$router->put('/kategori/{id}', 'KategoriController@update');
$router->delete('/kategori/{id}', 'KategoriController@destroy');

//user
$router->get('/user', 'AuthController@view');
$router->get('/user/{id}', 'AuthController@viewId');
$router->post('/user/register', 'AuthController@register');
$router->post('/user/login', 'AuthController@login');
$router->delete('/user/{id}', 'AuthController@destroy');