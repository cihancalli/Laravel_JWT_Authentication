<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\Front\Homepage@index')->name('homepage');
Route::get('/s', 'App\Http\Controllers\Front\Homepage@index');
Route::get('/iletisim', 'App\Http\Controllers\Front\Homepage@contact')->name('contact');
Route::post('/iletisim', 'App\Http\Controllers\Front\Homepage@contactpost')->name('contact.post');
Route::get('/kategori/{category}', 'App\Http\Controllers\Front\Homepage@category')->name('category');
Route::get('/blog/{category}/{slug}', 'App\Http\Controllers\Front\Homepage@single')->name('single');
Route::get('/{page}', 'App\Http\Controllers\Front\Homepage@page')->name('page');

