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

// table of posts
Route::get('/posts', function () {
    return view('posts');
})->name("posts");

// Single for edit or create a new post
Route::get('/post', function () {
    return view('post');
})->name("post");

// table of categories
Route::get('/post-categories', function () {
    return view('post-categories');
})->name("post-categories");

// Single for edit or create a new category for post
Route::get('/post-category', function () {
    return view('post-category');
})->name("post-category");

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

Route::get('/slides', function () {
    return view('slides');
})->name("slides");

Route::group(['prefix' => 'block'], function () {
    Route::get('/', function () {
        return view('blocks');
    })->name("block.list");

    Route::get('/create', function () {
        return view('block');
    })->name("block.create");

    Route::get('/edit/{id}', function ($id) {
        return view('block',['id' => $id]);
    })->name("block.edit");
});

Route::group(['prefix' => 'page'], function () {
    Route::get('/', function () {
        return view('pages');
    })->name("page.list");

    Route::get('/create', function () {
        return view('page');
    })->name("page.create");

    Route::get('/edit/{id}', function ($id) {
        return view('page',['id' => $id]);
    })->name("page.edit");

    Route::post('/delete', function ($id) {
        return view('page',['id' => $id]);
    })->name("page.delete");
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/', function () {
        return view('users');
    })->name("user.list");

    Route::get('/create', function () {
        return view('user');
    })->name("user.create");

    Route::get('/edit/{id}', function ($id) {
        return view('user',['id' => $id]);
    })->name("user.edit");

    Route::post('/delete', function ($id) {
        return view('user',['id' => $id]);
    })->name("user.delete");
});