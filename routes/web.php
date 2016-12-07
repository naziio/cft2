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

Route::get('/', 'HomeController@index');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index');


Route::group(['middleware' => 'auth'], function () {

         Route::group(['middleware' => 'role:editor,user,admin'], function () {

          Route::get('obra/factura/{obras}', 'FacturaController@index');

          Route::post('obra/factura/{obras}','FacturaController@store');

          Route::get('obra/factura/{obras}/edit',['as' => 'obra/factura', 'uses' =>'FacturaController@edit']);

          Route::put('obra/factura/{obras}', ['as' => 'obra/factura', 'uses' =>'FacturaController@update']);

          Route::delete('obra/factura/{obras}','FacturaController@destroy');



           // Route::post('obra/factura', ['as' => 'obra/factura/index', 'uses' =>'FacturaController@index']);

           // Route::resource('obra/factura', ['as' => 'obra/factura', 'uses' =>'FacturaController']);

         //   Route::get('obra/factura', ['as' => 'obra/factura', 'uses' =>'FacturaController@edit']);

           // Route::delete('obra/factura',['as' => 'obra/factura', 'uses' =>'FacturaController@destroy']);

          //  Route::

             Route::get('obra/api/factura/{id}',[
                'as'=>'getFactura',
                'uses'=>'FacturaController@findFactura'
             ]);

             Route::get('obra/factura/detalle/{facturas}',  ['as' => 'detalle', 'uses' =>'DetalleFacturaController@index']);

             //Route::get('obra/factura/detalle/create/{factura}', 'DetalleFacturaController@create');

             Route::post('obra/factura/detalle/{facturas}', ['as'=> 'detalle', 'uses' => 'DetalleFacturaController@store']);

             Route::get('obra/factura/detalle/{facturas}/edit',['as' => 'detalle', 'uses' =>'DetalleFacturaController@edit']);

             Route::put('obra/factura/detalle/{facturas}', ['as' => 'detalle', 'uses' =>'DetalleFacturaController@update']);

             Route::delete('obra/factura/detalle/{facturas}','DetalleFacturaController@destroy');




         });
    Route::resource('proveedor','ProveedorController');

    Route::group(['middleware' => 'role:admin'], function () {

    Route::get('obra/comparar/index1/{facturas}','DetalleFacturaController@index1');
    Route::resource('obra/obra','ObraController');

    Route::resource('personal', 'PersonalController');


     Route::get('obra/preciounitario/index/{nombrepus}', 'PrecioUnitarioController@index');
     Route::get('cargar/{nombrepus}', ['as' => 'cargar','uses' => 'PrecioUnitarioController@cargar'] );

     Route::post('cargar/cargar_datos', 'PrecioUnitarioController@cargar_datos' );

     Route::post('obra/nombrepu/index/cargar_datos2', ['as' => 'nombrepu/cargar_datos2', 'uses'=>'NombrePUController@cargar_datos2'] );


    Route::get('obra/nombrepu/index/cargar_datos2', ['as' => 'nombrepu/cargar_datos2', 'uses'=>'NombrePUController@cargar_datos2'] );


    Route::resource('presupuesto','PresupuestoController');

        Route::get('obra/nombrepu/index/{presupuestos}',['as' => 'nombrepu', 'uses' => 'NombrePUController@index']);
        Route::get('obra/comparar/index/{facturas}', ['as' => 'comparar/index', 'uses'=> 'DetalleFacturaController@index1']);

    });

    Route::get('personal/ver/{obras}', 'PersonalController@ver')->middleware('role:admin,user');

    //Route::post('obra/factura/detalle/index','DetalleFacturaController@store' );


    Route::get('obra/index', function()
    {
        return view('obra.index');
    });

    });

Auth::routes();