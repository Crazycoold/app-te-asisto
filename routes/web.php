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

Route::get('/', 'nursesController@index');
Route::post('save', 'nursesController@save');
Route::post('get-nurses', 'nursesController@getNurses');
Route::post('delete', 'nursesController@delete');
