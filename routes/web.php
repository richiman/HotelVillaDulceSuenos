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
//-----------------------------Pages
Route::group(['middleware'=>'counter'],function (){
    Route::get('/',function (){
        return view("index");
    });
});

Route::get('/login', [
    'uses' => 'WebController@login',
    'as' => 'login'
]);
Route::group(['middleware' => 'session'], function () {
    Route::get('/adminreserva',[
        'uses' => 'WebController@adminReservaPage',
        'as' => 'adminReservaciones'
    ]);

    Route::get('/menu', [
        'uses' => 'WebController@getmenu',
        'as' => 'menu',
    ]);

    Route::get('/reservacion',[
        'uses' => 'WebController@reservacionesPage',
        'as' => 'reservacion'
    ]);

    Route::get('/status/{fecha}', [
        'uses' => 'WebController@statusPageP',
        'as' => 'status'
    ]);

    Route::get('/status', [
        'uses' => 'WebController@statusPage',
        'as' => 'status'
    ]);

    Route::get('/roominfo',[
        'uses' => 'WebController@rommInfoPage',
        'as' => 'roominfo'
    ]);

    Route::get('/sabanareservas',[
        'uses' => 'WebController@sabanaReservaDevelux',
        'as' => 'sabana.reserva'
    ]);

    Route::get('/cleaning',[
        'uses' => 'WebController@cleaningPage',
        'as' => 'cleaning'
    ]);

    Route::get('/usuarios',[
        'uses' => 'WebController@usuariosPage',
        'as' => 'usuarios'
    ]);

    Route::get('/editusr/{id}', [
        'uses' => 'WebController@editUsuarioPage',
        'as' => 'editUSR'
    ]);

    Route::get('/editcli/{id}', [
        'uses' => 'WebController@editClientePage',
        'as' => 'editCLI'
    ]);


    Route::get('/Habitaciones',[
        'uses' => 'WebController@habitacionesPage',
        'as' => 'habitaciones'
    ]);

    Route::get('/clientes',[
        'uses' => 'WebController@clientesPage',
        'as' => 'clientes'
    ]);


    Route::get('/editreserva/{id}',[
        'uses' => 'WebController@editReserva',
        'as' => 'editR'
    ]);
});

Route::get('/noactivo',[
   'uses' => function(){
    return view('noactivo');
   },
   'as' => 'noActivo'
]);


//-------------------------------DATA

Route::get('/pruebaEmail',[
    'uses' => 'WebController@testCorreo'
]);

Route::get('/busqueda', [
    'uses' => 'WebController@busqueda'
]);

Route::get('/getclientes', [
    'uses' => 'WebController@getClientes'
]);

Route::get('/nextmonth',[
    'uses' => 'WebController@nextMonth',
    'as' => 'next'
]);

Route::get('/previusmonth',[
    'uses' => 'WebController@previusMonth',
    'as' => 'next'
]);

Route::get('/gethabitacionesdisponibles',[
    'uses' => 'WebController@getHabitacionesDisponibles',
]);

Route::get('/getaño',[
    'uses' => 'WebController@getThisYearRes',
]);

Route::get('/getcostos',[
    'uses' => 'WebController@getCostos',
]);

Route::get("/getcli",[
   'uses' => "WebController@getCli"
]);

Route::get('/getrep',[
    'uses' => 'WebController@getRep',
]);

Route::get('/repeys',[
   'uses' => "WebController@getEntradasSalidas"
]);
//-------------------------------POST

Route::post('/newcosto', [
    'uses' => 'WebController@newCosto'
]);

Route::post('costodelete/{id}', [
    'uses' => 'WebController@deletePrice'
]);

Route::post('/newcliente',[
   'uses' => 'WebController@addCliente'
]);
Route::post('/deletecliente/{id}',[
   'uses' => 'WebController@deleteClient'
]);

Route::post('/reservar',[
    'uses' => 'WebController@Reservar'
]);

Route::post('/confirmar/{id}',[
    'uses' => 'WebController@Confirmar'
]);


Route::post('/dologin',[
    'uses' => 'WebController@doLogin'
]);

Route::delete('/deletereserva/{id}', [
    'uses' => 'WebController@DeleteReserva'
]);


Route::post('/registrar/{cuarto}',[
    'uses' => 'WebController@Registrar'
]);

Route::post('editarusuario/{id}', [
    'uses' => 'WebController@editarUsuario'
]);
Route::post('editarcliente/{id}', [
    'uses' => 'WebController@editarCliente'
]);

Route::post('/addusuario', [
    'uses' => 'WebController@addUsuario'
]);

Route::post('/deleteusr/{id}',[
    'uses' => 'WebController@deleteUSR'
]);

Route::post('/hospedar/{id}',[
    'uses' => 'WebController@hospedar'
]);

Route::post('/newhabitacion',[
    'uses' => 'WebController@newHabitacion'
]);

Route::post('deleteroom/{id}', [
    'uses' => 'WebController@deleteRoom'
]);

Route::post('edithabitacion/{id}', [
    'uses' => 'WebController@editHabitacion'
]);

Route::post('senEdit/{id}', [
    'uses' => 'WebController@senEdit'
]);

Route::get('/logout',[
    'uses' => 'WebController@logout',
    'as' => 'logout'
]);
