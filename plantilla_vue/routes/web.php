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
/*
Route::get('/', function () {
    $nombreApi='usuarios';
    return view('welcome')->with('nombreApi',$nombreApi);
});*/
/*Route::get('/','PruebaController@index' );


Route::get('/template', function(){
    return view ('templates.main');
} );
*/
// INCIÈNCIA

    //login
Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@login')->name('login');
Route::get('/logout', 'LoginController@logout')->name('logout');
    //register
Route::get('/register','LoginController@showRegister');
    //cosas raras @marti
Route::group(['middleware' => ['auth']], function () {
    //taula
    Route::get('/recurscard', 'PruebaController@landingpagerecurs' );
    Route::get('/taula_incidencia', 'IncidenciaController@mostrarTaula' );
    Route::get('/taula_incidencia_recursmovil', 'IncidenciaController@mostrarTaulaIncidenciaxRecurs' );

    //form
    Route::get('/form_incidencia', 'IncidenciaController@mostrarForm');
    Route::get('/landingpage','PruebaController@landingpage' );
    Route::get('/Recursos','PruebaController@index' );
    Route::get('/alertant','PruebaController@moostrarvip' );
    Route::get('/formacio','PruebaController@formacio' );

});
