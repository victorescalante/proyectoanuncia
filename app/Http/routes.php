<?php


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