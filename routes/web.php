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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', function () {
//     return view('layouts/master');
// });


Route::get('/index', function () {
    return view('users/index');
})->name('homepage');

Route::get('/category', function () {
    return view('users/category');
});

Route::get('/register', function () {
    return view('users/register');
})->name('register');


Route::get('/login', function () {
    return view('users/login');
})->name('login');
