<?php

use App\Models\PostCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCategoriesController;

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

Route::group(['prefix' => 'post'], function () {

    Route::get('/', [PostController::class, 'index'])->name("post.list");

    Route::get('/create', [PostController::class, 'create'])->name("post.create");
    Route::post('/store', [PostController::class, 'store'])->name("post.store");

    Route::get('/edit/{id}', [PostController::class, 'edit'])->name("post.edit");
    Route::put('/update/{id}', [PostController::class, 'update'])->name("post.update");

    Route::post('/delete', [PostController::class, 'delete'])->name("post.delete");


});

Route::group(['prefix' => 'postCategories'], function () {

    Route::get('/', [PostCategoriesController::class, 'index'])->name("postCategories.list");

    Route::get('/create', [PostCategoriesController::class, 'create'])->name("postCategories.create");
    Route::post('/store', [PostCategoriesController::class, 'store'])->name("postCategories.store");

    Route::get('/edit/{id}', [PostCategoriesController::class, 'edit'])->name("postCategories.edit");
    Route::put('/update/{id}', [PostCategoriesController::class, 'update'])->name("postCategories.update");

    Route::post('/delete', [PostCategoriesController::class, 'delete'])->name("postCategories.delete");

});



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
    })->name("users.list");

    Route::get('/create', function () {
        return view('user-create');
    })->name("user.create");

    Route::get('/profile/{id}', function ($id) {
        return view('user-profile',['id' => $id]);
    })->name("user.profile");

    // User sessions for user login history like IP, browser, device, etc.
    Route::get('/profile/sessions/{id}', function () {
        return view('user-sessions');
    })->name("user.sessions.show");

    Route::delete('/profile/sessions/{id}', function () {})->name("user.sessions.save");

    Route::get('/edit/{id}', function ($id) {
        return view('user-detail',['id' => $id]);
    })->name("user.edit.show");

    Route::post('/edit/{id}', function ($id) {})->name("user.edit.save");

    Route::post('/delete', function ($id) {
        return view('user',['id' => $id]);
    })->name("user.delete");
});
