<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PerfilController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
    return view('home');
})->name('home');

Route::post('/logout',  [LoginController::class, 'logout'])->name('logout');
Route::get('/login',  [LoginController::class, 'index'])->name('login');
Route::post('/login',  [LoginController::class, 'login'])->name('login');
Route::get('/registro',  [RegisterController::class, 'index'])->name('register');
Route::post('/registro',  [RegisterController::class, 'register'])->name('register');

Route::middleware(['auth:web'])->group(function () {
    Route::prefix('perfil')->group(function () {
        Route::get('/conta', [PerfilController::class, 'conta'])->name('perfil.conta');
    });
    // Route::get('/perfil', function () {
    //     return view('index2');
    // });
});
