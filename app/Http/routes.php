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
Route::post('catalogo/search', [
    'uses' => 'PageController@search',
    'as'   => 'catalog_search_path',
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

Route::get('puentes/{id}', [
    'uses' => 'FootbridgeController@show',
    'as'   => 'footbridge_show_path',
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

    Route::get('sistema/puentes/create', [
        'uses' => 'FootbridgeController@create',
        'as'   => 'footbridge_create_path',
    ]);

    Route::post('sistema/puentes/create', [
        'uses' => 'FootbridgeController@store',
        'as'   => 'footbridge_store_path',
    ]);

    Route::get('sistema/puentes/create/select/', [
        'uses' => 'FootbridgeController@select',
        'as'   => 'list_municipalities',
    ]);


    Route::get('sistema/puentes/{id}/edit', [
        'uses' => 'FootbridgeController@edit',
        'as'   => 'footbridge_edit_path',
    ]);

    Route::patch('sistema/puentes/{id}/edit', [
        'uses' => 'FootbridgeController@update',
        'as'   => 'footbridge_patch_path',
    ]);

    Route::get('sistema/puentes/{id}/delete', [
        'uses' => 'FootbridgeController@question_destroy',
        'as'   => 'footbridge_question_path',
    ]);

    Route::delete('sistema/puentes/{id}/delete', [
        'uses' => 'FootbridgeController@destroy',
        'as'   => 'footbridge_delete_path',
    ]);

    Route::post('sistema/images/store', [
        'uses' => 'PhotoController@store',
        'as'   => 'images_store_path',
    ]);

    Route::delete('sistema/images/destroy', [
        'uses' => 'PhotoController@destroy',
        'as'   => 'images_destroy_path',
    ]);

    Route::patch('sistema/images/update', [
        'uses' => 'PhotoController@update',
        'as'   => 'images_update_path',
    ]);
    




});