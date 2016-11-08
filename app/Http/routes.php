<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get ('/github', 'PdfController@github');

Route::get('/', function () {
    return view('auth.login');
});

Route::get('registro', function () {
    return view('auth.register');
});

Route::get('login', function () {
    return view('auth.login');
});


Route::get('proveedores', ['as' => 'proveedores', 'middleware'=>'roles', 'roles'=>['Proveedor'], function () {
    return view('pages.soloProv');
}]);
Route::get('rolesAdmin', [
    'as' => 'roles', 'uses' => 'RoleController@index'
]);
Route::post('rolesAdmin', [
    'as' => 'roles', 'uses' => 'RoleController@update'
]);

Route::get('recordar', function () {
    return view('auth.reset'); // falta atrapar el error cuando no existe el token
});

Route::get('password/email', 'Auth\PasswordController@getEmail');


Route::group(['middleware' => 'auth'], function () {
    Route::get('home', 'PagesController@home');
    Route::resource('areas', 'AreaController');
    Route::resource('sectores', 'SectorController');
    Route::resource('usuarios', 'UserController');
    Route::resource('equipos', 'AssetController');
    Route::resource('movimientos', 'MoveController');
//    Route::get('papelera/', 'TrashController@index');
    Route::get('/pdf/guia', 'PdfController@getUsers');
});

Route::group(['middleware' => 'api'], function () {
    Route::get('api/getSectors/', ['as' => 'getSectors', 'uses' => 'ApiController@getSectors']);
    Route::get('api/getAssets/{id}', ['as' => 'getAssets', 'uses' => 'ApiController@getAssets']);
    Route::get('api/getNextSerial/{type_id}', ['as' => 'getNextSerial', 'uses' => 'ApiController@getNextSerial']);
    Route::get('api/getUserDetails/{user_id}', ['as' => 'getUserDetails', 'uses' => 'ApiController@getUserDetails']);
    Route::post('api/postUserDetails', ['as' => 'postUserDetails', 'uses' => 'ApiController@postUserDetails']);
//    Route::post('papelera/{modelo}/{id}', 'TrashController@restaurar');
});
