<?php

//Routes of the page

Route::get('/', [
    'uses' => 'PageController@home',
    'as'   => 'home_show_path',
]);

Route::get('contacto', [
    'uses' => 'PageController@contact',
    'as'   => 'contact_show_path',
]);

Route::get('catalogo', [
    'uses' => 'PageController@catalog',
    'as'   => 'catalog_show_path',
]);

//Routes Login

Route::get('auth/login', [
    'uses' => 'AuthController@index',
    'as'   => 'auth_show_path',
]);
Route::post('auth/login', [
    'uses' => 'AuthController@store',
    'as'   => 'auth_store_path',
]);
Route::get('auth/logout', [
    'uses' => 'AuthController@destroy',
    'as'   => 'auth_destroy_path',
]);

//Routes of the system

Route::group(['middleware' => 'auth'], function () {

    Route::get('sistema', [
        'uses' => 'SystemController@index',
        'as'   => 'system_home_path',
    ]);

    Route::get('sistema/puentes', [
        'uses' => 'FootbridgeController@index',
        'as'   => 'footbridge_home_path',
    ]);

});