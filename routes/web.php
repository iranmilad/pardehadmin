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

Route::get('/', function () {
    return view('index');
})->name("index");

Route::get('/posts', function () {
    return view('posts');
})->name("posts");

// this route is used to create a new post or edit an existing one
Route::get('/post', function () {
    return view('post');
})->name("post");

Route::get('/login', function () {
    return view('auth.login');
})->name("login");

Route::get('/signup', function () {
    return view('auth.signup');
})->name("signup");

Route::get('/forgetpass', function () {
    return view('auth.forgetpass');
})->name("forgetpass");

Route::get('/changepass', function () {
    return view('auth.changepass');
})->name("changepass");