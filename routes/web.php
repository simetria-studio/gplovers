<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PlanController;

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
// Bucsa dados tabelas
Route::post('/buscaAutocomplete', [HomeController::class, 'buscaAutocomplete']);
Route::post('/buscaAnuncios', [HomeController::class, 'buscaAnuncios']);
Route::post('/geraSlug', [HomeController::class, 'geraSlug']);

Route::get('/buscaEstado', [HomeController::class, 'buscaEstado']);
Route::get('/buscaCidade/{id}', [HomeController::class, 'buscaCidade']);
Route::get('/buscaBairro/{id}', [HomeController::class, 'buscaBairro']);

// Route::get('/idade', function () {
//     return view('idade');
// });
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/anuncio/{slug}', [HomeController::class, 'anuncio'])->name('perfil.anuncio');

Route::post('/logout',  [LoginController::class, 'logout'])->name('logout');
Route::get('/login',  [LoginController::class, 'index'])->name('login');
Route::post('/login',  [LoginController::class, 'login'])->name('login');
Route::get('/registro',  [RegisterController::class, 'index'])->name('register');
Route::post('/registro',  [RegisterController::class, 'register'])->name('register');

Route::middleware(['auth:web'])->group(function () {
    Route::prefix('perfil')->group(function () {
        Route::get('/conta', [PerfilController::class, 'conta'])->name('perfil.conta');
        Route::get('/dados', [PerfilController::class, 'dados'])->name('perfil.dados');

        Route::get('/conta/editar', [PerfilController::class, 'editarConta'])->name('perfil.conta.editar');
        Route::post('/conta/editar', [PerfilController::class, 'updateConta'])->name('perfil.conta.editar');

        Route::get('/dados/editar', [PerfilController::class, 'editarDados'])->name('perfil.dados.editar');
        Route::post('/dados/atualizar', [PerfilController::class, 'atualizarDados'])->name('perfil.dados.atualizar');

        Route::get('/planos', [PlanController::class, 'index'])->name('plan');
        Route::get('/checkout-pix/{id}', [PlanController::class, 'checkoutPix'])->name('checkout.pix');
        Route::get('/checkout-finalizado', [PlanController::class, 'checkoutFinalizado'])->name('checkout.finalizado');

        Route::get('/checkout/{id}', [CheckoutController::class, 'checkoutView'])->name('checkout');
        Route::post('/checkout-finalizar', [CheckoutController::class, 'checkout'])->name('checkout.finalizar');
    });
    // Route::get('/perfil', function () {
    //     return view('index2');
    // });
});
