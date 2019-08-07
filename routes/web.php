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
Route::get('/home/{vue_capture?}', function () {
    return view('home');
})->where('vue_capture', '[\/\w\.-]*');

Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('index');
});

Route::get('/roles', function () {
    return view('role');
});

Route::get('/permissions', function () {
    return view('permission');
});

