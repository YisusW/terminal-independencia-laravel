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

$controllers =  (object) array(
	/*--------------------------------------------------------------
	| - Controladores de la gestion de TasaSalida
	---------------------------------------------------------------*/
	'tasa_c_one' => 'TasaSalida\TasaSalidaController', 
	'tasa_c_two' => 'TasaSalida\TasaSalidaUserController', 
	'tasa_c_tre' => 'TasaSalida\TasaSalidaCountController',
	/*--------------------------------------------------------------
	| - Controladores de la gestion de ListinTipo
	---------------------------------------------------------------*/
	'tine_one' => 'ListinTipo\TipoListinController', 
	'tine_two' => 'ListinTipo\TipoListinPriceController',
	'tine_tre' => 'ListinTipo\TipoListinJornadaController',
	'tine_fou' => 'ListinTipo\ListinCountController'
);

//  SOLO EL ADMINISTRADOR ACCEDE ...
Route::get( 'tasa-salida-config' , $controllers->tasa_c_one.'@config' );

Route::post( 'save-price-tasa'   , $controllers->tasa_c_one.'@store' );

// ABRIR JORNADA DE TASA DE SALIDA

Route::get( 'open-jornada-tasa'                          , $controllers->tasa_c_one.'@index' );

Route::post( 'open_jornada_user'                    , $controllers->tasa_c_two.'@store' );

Route::get( 'cierre-jornada/{id}/{jornada_abierta}' , $controllers->tasa_c_two.'@cerrar_jornada' );

// VENTER TASA SALIDA  ( VENTAS Ticket y REPORTES DE CIERRE JORNADA )


Route::get( 'let-it-go' , $controllers->tasa_c_two.'@preparar_datos_vender' );

Route::post('tasa-salida-report' , $controllers->tasa_c_tre.'@store' );

Route::post( 'informe-cierre-jornada' , $controllers->tasa_c_tre.'@informe_cierre_pdf' );

Route::post( 'informe-cierre-jornada-from-admin' , $controllers->tasa_c_tre.'@admin_informe_cierre_pdf' );

// ADMIN VER JORNADAS CUENTAS ETC BLA BLA

Route::get( 'jornada-opened' , $controllers->tasa_c_tre.'@index' );

Route::get( 'jornada-closed' , $controllers->tasa_c_tre.'@endindex' );


//---------------------------------------------------------------------
//  -  GESTION DE RUTAS PARA LA ORGANIZACION DE LOS TIPOS DE LISTINES |
//---------------------------------------------------------------------

#	-TipoListinController

Route::get( 'tipo-listine'       , $controllers->tine_one.'@index' );

Route::get( 'tipo-listin/edit/{descripcion}' , $controllers->tine_one.'@show' );

Route::post( 'save-tipo-listin'  , $controllers->tine_one.'@store' );

Route::put('update-tipo-listin/{id}' , $controllers->tine_one.'@update');

Route::get( 'tipo-listine-price' , $controllers->tine_one.'@config_price' );

// SE TRATA DE OTRA PARTE DE LISTIN PERO DE ASIGNACION DE PRECIOS ETC

#	-TipoListinPriceController

Route::post( 'save-tipo-price'   , $controllers->tine_two.'@store' );

Route::get( 'open-jornada-listine' , $controllers->tine_two.'@vista_jornada_open' );

// GUARDAR LA PETICION DE GUARDAR LAS JORNADAS ES DECIR ABRIR JORNADAS DE Listins

#	-TipoListinJornadaController

Route::post( 'open-jornada-listine' , $controllers->tine_tre.'@store' );

Route::get( 'vender-jornada-listine' , $controllers->tine_tre.'@index' );

Route::post('cierre-jornada-listine' , $controllers->tine_tre.'@cerrar_jornada' );

// GUARDAR LA PETICION DE GUAdar CUANDO SE QUIERE VENDER UN LISTINE

#	-ListinCountController

Route::post('contar-listine' , $controllers->tine_fou.'@store' );

Route::post( 'informe-cierre-jornada-listin' , $controllers->tine_fou.'@reporte_informe_cierre' );


Route::get( 'jornada-opened-listin' , $controllers->tine_fou.'@index' );

Route::get( 'jornada-closed-listin' , $controllers->tine_fou.'@endindex' );

Route::post( 'informe-cierre-jornada-listine-from-admin' , $controllers->tine_fou.'@admin_reporte_informe_cierre' );
