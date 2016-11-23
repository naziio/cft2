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

/* RUTA PARA DATATABLE


 * Route::get('api/registros', function(){
    $datos = Becas\Registro::select('id', DB::raw('CONCAT(nombre," ", paterno," ", materno) as nombre'), 'rut', DB::raw('IF (sede = "Serena", "La Serena", sede) as sede'), 'movil', 'mail')->get();
    return Datatables::of($datos)
        ->addColumn('detalle', function($datos){
            return '<a href="'.route("registro.edit", $datos->id).'" class="btn btn-success btn-xs">Detalle</a>';
        })
        ->make(true);
});

EL HTML
$('#table').DataTable({
		"processing" : true,
		"serverSide" : true,
		"ajax" : "/api/registros",
		"columns" : []


*/
//Route::group(['prefix'=>'admin','namespace'=>'Admin', 'middleware' => 'role:user'], function(){
Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/admin', 'HomeController@index');

    Auth::routes();

    Route::get('obra/comparar/index1/{facturas}','DetalleFacturaController@index1')->middleware('role:admin');

    Route::get('/home', 'HomeController@index');

    Route::get('panel/index', 'HomeController@admin')->middleware('role:admin,user,editor');

    Route::resource('proveedor','ProveedorController');

    Route::resource('obra/obra','ObraController');

    Route::resource('personal', 'PersonalController');

    Route::get('personal/ver/{obras}', 'PersonalController@ver');//->middleware('role:admin');

    Route::get('obra/factura/index/{obras}', 'FacturaController@index')->middleware('tiempo'); //en desarrollo

    Route::post('obra/factura/index/{obras}','FacturaController@store');//->middleware('role:admin,user,editor');

   // Route::resource('obra/factura', 'FacturaController');



    //Route::resource('obra/preciounitario', 'PrecioUnitarioController');

    Route::get('obra/preciounitario/index/{nombrepus}', 'PrecioUnitarioController@index')->middleware('role:admin');
    Route::get('cargar/{nombrepus}', ['as' => 'cargar','uses' => 'PrecioUnitarioController@cargar'] )->middleware('role:admin');

    Route::post('cargar/cargar_datos', 'PrecioUnitarioController@cargar_datos' )->middleware('role:admin');

    Route::post('obra/nombrepu/index/cargar_datos2', ['as' => 'nombrepu/cargar_datos2', 'uses'=>'NombrePUController@cargar_datos2'] )->middleware('role:admin');

    Route::get('obra/nombrepu/index/cargar_datos2', ['as' => 'nombrepu/cargar_datos2', 'uses'=>'NombrePUController@cargar_datos2'] )->middleware('role:admin');


    Route::resource('presupuesto','PresupuestoController');//->middleware('role:admin');

//Route::resource('obra/nombrepu','NombrePUController');

    Route::get('obra/nombrepu/index/{presupuestos}',['as' => 'nombrepu', 'uses' => 'NombrePUController@index'])->middleware('role:admin');

  //  Route::get('obra/factura/detalle/show/{facturas}', 'DetalleFacturaController@index');





    Route::get('obra/factura/detalle/index/{facturas}',  ['as' => 'detalle/index', 'uses' =>'DetalleFacturaController@index']);

    Route::get('obra/factura/detalle/create/{factura}', 'DetalleFacturaController@create');

    Route::post('obra/factura/detalle/create', ['as'=> 'detalle/store', 'uses' => 'DetalleFacturaController@store']);

    //Route::post('obra/factura/detalle/index','DetalleFacturaController@store' );

    Route::get('obra/comparar/index/{facturas}', ['as' => 'comparar/index', 'uses'=> 'DetalleFacturaController@index1'])->middleware('role:admin');

    Route::get('obra/index', function()
    {
        return view('obra.index');
    });




});

