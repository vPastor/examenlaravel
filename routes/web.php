<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//NO MODIFICAR ESTAS RUTASl. SON LAS QUE TENEIS QUE UTILIZAR EN LA APLICACION
Route::get('/', 'ProductController@all');
//Seleccionar categoria para mostrar (no debe aparecer el banner)
Route::get('/category/{id?}', 'ProductController@category');
//Busca producto por palabra y categoria (no debe aparecer el banner)
Route::post('/search', 'ProductController@search');
Route::get('/compra', 'CompraController@main');
Route::get('/compra/resumen', 'CompraController@resumen');
//Muestra el formulario
Route::get('/compra/envio', 'CompraController@envio');
//Envia el formulario
Route::post('/compra/envio', 'CompraController@verificarEnvio');
Route::get('/compra/confirmar', 'CompraController@confirmar');
//Comprueba stock
Route::post('stock', 'CompraController@checkStock');
Route::post('addToCart', 'CompraController@addToCart');
Route::get('clearCart', 'CompraController@clearCart');

