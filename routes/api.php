<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Categories;
use App\Http\Controllers\CategoriesController;
use App\Models\Products;
use App\Http\Controllers\ProductsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Rotas das categorias
Route::get('/categories', [CategoriesController::class, 'index'])->name('index');
Route::post('/categories/insert', [CategoriesController::class, 'create'])->name('insert');

//Rota dos Produtos
Route::get('/products', [ProductsController::class, 'index'])->name('index');
Route::post('/products/insert', [ProductsController::class, 'create'])->name('create');
Route::get('/products/read/{id}', [ProductsController::class, 'read'])->name('read');

/* Rota de Teste , remover assim que possível */
Route::get('/teste', function(){
	return \Response::json('eu sou lindão ...');
});