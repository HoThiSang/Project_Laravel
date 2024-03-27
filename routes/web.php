<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductsController;
use App\Models\Categories;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});
// Auth::routes();

Route::get('/homepage', [HomeController::class, 'index'])->name('homepage');
Route::get('/search', [HomeController::class, 'search'])->name('search');


Route::get('/category', function () {
    return view('users/category');
})->name('category');



Route::get('/contact', function(){
    return view('users/contact');
})->name('contatc');

Route::get('/login', [CustomAuthController::class, 'login'])->name('login')->middleware('alreadyLoggedIn');
Route::get('/registration', [CustomAuthController::class, 'registration'])->name('registration')->middleware('alreadyLoggedIn');
Route::post('/register-user', [CustomAuthController::class, 'registerUser'])->name('register-user');
Route::post('/login-user', [CustomAuthController::class, 'loginUser'])->name('login-user');
Route::get('/dashboard', [CustomAuthController::class, 'dashboard'])->middleware('isLoggedIn');
Route::get('/logout', [CustomAuthController::class, 'logout']);

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

Route::get('/filter', [ProductsController::class, 'filterByCategory'])->name('filterByCategory');

Route::get('/checkout', function(){
    return view('users/checkout');
})->name('checkout');

Route::get('admin/dashboard', [AdminController::class, 'admin'])->name('admin')->middleware('isAdmin');
