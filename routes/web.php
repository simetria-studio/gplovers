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

// Route::get('/idade', function () {
//     return view('idade');
// });
Route::get('/', function () {
    return view('index1');
});
Route::get('/perfil', function () {
    return view('index2');
});
