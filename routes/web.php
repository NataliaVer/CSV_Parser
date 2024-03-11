<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\FileController@home')->name('home');

Route::post('/upload', 'App\Http\Controllers\FileController@upload')->name('uploadFile');

Route::get('/export', 'App\Http\Controllers\FileController@export')->name('exportFile');

Route::patch('/edit', 'App\Http\Controllers\FileController@edit')->name('file.edit');
