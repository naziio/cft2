<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/admin', 'HomeController@index');

    Route::get('obra/comparar/index1/{facturas}','DetalleFacturaController@index1');

    Route::get('/home', 'HomeController@index');

    Route::get('panel/index', 'HomeController@admin');

    Route::resource('proveedor','ProveedorController');

    Route::resource('obra/obra','ObraController');

    Route::resource('personal', 'PersonalController');

    Route::get('obra/factura/index/{obras}', 'FacturaController@index'); //en desarrollo

    Route::post('obra/factura/index/{obras}','FacturaController@store');

   // Route::resource('obra/factura', 'FacturaController');



    //Route::resource('obra/preciounitario', 'PrecioUnitarioController');

    Route::get('obra/preciounitario/index/{nombrepus}', 'PrecioUnitarioController@index');
    Route::get('cargar/{nombrepus}', ['as' => 'cargar','uses' => 'PrecioUnitarioController@cargar'] );

    Route::post('cargar/cargar_datos', 'PrecioUnitarioController@cargar_datos' );

    Route::post('obra/nombrepu/index/cargar_datos2', ['as' => 'nombrepu/cargar_datos2', 'uses'=>'NombrePUController@cargar_datos2'] );

    Route::get('obra/nombrepu/index/cargar_datos2', ['as' => 'nombrepu/cargar_datos2', 'uses'=>'NombrePUController@cargar_datos2'] );


    Route::resource('presupuesto','PresupuestoController');

//Route::resource('obra/nombrepu','NombrePUController');

    Route::get('obra/nombrepu/index/{presupuestos}',['as' => 'nombrepu', 'uses' => 'NombrePUController@index']);

  //  Route::get('obra/factura/detalle/show/{facturas}', 'DetalleFacturaController@index');





    Route::get('obra/factura/detalle/index/{facturas}',  ['as' => 'detalle/index', 'uses' =>'DetalleFacturaController@index']);

    Route::get('obra/factura/detalle/create/{factura}', 'DetalleFacturaController@create');

    Route::post('obra/factura/detalle/create', ['as'=> 'detalle/store', 'uses' => 'DetalleFacturaController@store']);

    //Route::post('obra/factura/detalle/index','DetalleFacturaController@store' );

    Route::get('obra/comparar/index/{facturas}', ['as' => 'comparar/index', 'uses'=> 'DetalleFacturaController@Comparar']);

    Route::get('obra/index', function()
    {
        return view('obra.index');
    });


    Auth::routes();

});

