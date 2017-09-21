<?php

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

Route::get('/', function () { return view('welcome'); });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/auth/users_equis' ,'HomeController@wait')->name('espera');

Route::get( 'users' , 'UsuarioController@index' );
Route::get( 'users/{id}' , 'UsuarioController@update' );

//---------------------------------------------------------------------
//  -  GESTION DE RUTAS PARA LA ORGANIZACION DE LA TASA DE SALIDAS  
//---------------------------------------------------------------------


//  SOLO EL ADMINISTRADOR ACCEDE ...
Route::get( 'tasa-salida-config' , 'TasaSalidaController@config' );

Route::post( 'save-price-tasa' , 'TasaSalidaController@store' );

// ABRIR JORNADA DE TASA DE SALIDA

Route::get( 'open-jornada' , 'TasaSalidaController@index' );

Route::post( 'open_jornada_user' , 'TasaSalidaUserController@store' );

Route::get( 'cierre-jornada/{id}/{jornada_abierta}' , 'TasaSalidaUserController@cerrar_jornada' );

// VENTER TASA SALIDA 


Route::get( 'let-it-go' , 'TasaSalidaUserController@preparar_datos_vender' );

Route::post('tasa-salida-report' , 'TasaSalidaCountController@store' );

Route::post( 'informe-cierre-jornada' , 'TasaSalidaCountController@informe_cierre_pdf' );

// ADMIN VER JORNADAS CUENTAS ETC BLA BLA

Route::get( 'jornada-opened' , 'TasaSalidaCountController@index' );

Route::get( 'jornada-closed' , 'TasaSalidaCountController@endindex' );

