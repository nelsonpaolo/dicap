<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

App::missing(function($exception)
{
	return View::make('auth/login');
});

Route::controller('auth', 'AuthController');

Route::resource('users', 'UsersController');

Route::controller('validaciones', 'ValidacionesController');

Route::resource('marcas', 'MarcasController');

Route::resource('lugares', 'LugaresController');

Route::resource('categorias', 'CategoriasController');

Route::resource('productos', 'ProductosController');

Route::resource('clientes', 'ClientesController');

Route::resource('proveedores', 'ProveedoresController');

Route::resource('ingresos', 'IngresosController');

Route::resource('salidas', 'SalidasController');

Route::controller('reportes', 'ReportesController');

Route::get('ingresopdf/{id}','IngresosController@pdf');

Route::get('salidapdf/{id}','SalidasController@pdf');

Route::post('ingresoexcel','IngresosController@excel');

Route::post('salidaexcel','SalidasController@excel');

Route::post('lugarpdf','LugaresController@pdf');

Route::post('lugarexcel','LugaresController@excel');
