<?php

use Illuminate\Support\Facades\Route;
use App\Models\Categories;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;

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

Route::get('/user', function(){
	$auth_user = \Auth::user();
	return \Response::json($auth_user);
});
Route::get('/login', function(){
	return view('login');
});

//Routes to categories
Route::get('/categories', [CategoriesController::class, 'index'])->name('index')->middleware('auth');
Route::post('/categories/insert', [CategoriesController::class, 'insert'])->name('insert')->middleware('auth');
Route::put('/categories/update/{id}', [CategoriesController::class, 'update'])->name('update')->middleware('auth');
Route::delete('/categories/delete/{id}', [CategoriesController::class, 'delete'])->name('delete')->middleware('auth');
Route::get('/', function () {
    return view('welcome');
});

//Routes to products
Route::get('/products', [ProductsController::class, 'index'])->name('index')->middleware('auth');
Route::post('/products/insert', [ProductsController::class, 'create'])->name('create')->middleware('auth');
Route::post('/products/update/{id}', [ProductsController::class, 'update'])->name('update')->middleware('auth');
Route::delete('products/delete/{id}', [ProductsController::class, 'delete'])->name('delete')->middleware('auth');

Auth::routes();

//Rota home page admin 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/example',[App\Http\Controllers\HomeController::class, 'example'])->name('example');