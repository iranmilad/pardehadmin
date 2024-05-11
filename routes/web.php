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

Route::post('/login', function () {
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
})->name("slides.show");

Route::post('/slides', function () {
})->name("slides.save");

Route::group(['prefix' => 'block'], function () {
    Route::get('/', function () {
        return view('blocks');
    })->name("block.list");

    Route::get('/create', function () {
        return view('block');
    })->name("block.create");

    Route::get('/edit/{id}', function ($id) {
        return view('block', ['id' => $id]);
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
        return view('page', ['id' => $id]);
    })->name("page.edit");

    Route::post('/delete', function ($id) {
        return view('page', ['id' => $id]);
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
        return view('user-profile', ['id' => $id]);
    })->name("user.profile");

    // User sessions for user login history like IP, browser, device, etc.
    Route::get('/profile/sessions/{id}', function () {
        return view('user-sessions');
    })->name("user.sessions.show");

    Route::delete('/profile/sessions/{id}', function () {
    })->name("user.sessions.save");

    Route::get('/edit/{id}', function ($id) {
        return view('user-detail', ['id' => $id]);
    })->name("user.edit.show");

    Route::post('/edit/{id}', function ($id) {
    })->name("user.edit.save");

    Route::post('/delete', function ($id) {
        return view('user', ['id' => $id]);
    })->name("user.delete");
});

// table of posts
Route::get('/settings', function () {
    return view('settings');
})->name("settings.show");

Route::post('/settings', function () {
})->name("settings.save");


Route::group(['prefix' => 'products'], function () {

    Route::get('/list/', function () {
        return view('products');
    })->name("products.list.show");

    Route::get('/create/', function () {
        return view('product');
    })->name("product.create.show");

    Route::get('/edit/{id}', function ($id) {
        return view('product');
    })->name("product.edit.show");

    Route::get('/categories/', function () {
        return view('product-categories');
    })->name("product.categories.show");

    Route::get('/category/{id}', function ($id) {
        return view('product-category');
    })->name("product.category.show");

    Route::get('/tags/', function () {
        return view('product-tags');
    })->name("product.tags.show");

    Route::get('/tags/edit/{id}', function ($id) {
        return view('product-tag');
    })->name("product.tag.show");

    Route::get('/comments/', function () {
        return view('product-comments');
    })->name("product.comments.show");

    Route::get('/comment/{id}', function ($id) {
        return view('product-comment');
    })->name("product.comment.show");

    Route::post('/category/{id}', function ($id) {
    })->name("product.category.save");



    Route::delete('/delete/{id}', function () {
    })->name("product.delete");

    Route::get('/attributes', function () {
        return view('attributes');
    })->name("attributes.list.show");

    Route::get('/attributes/create/', function ($id) {
        return view('attribute');
    })->name("attribute.create.show");

    Route::get('/attributes/edit/{id}', function ($id) {
        return view('attribute');
    })->name("attribute.show");

    Route::post('/attributes/edit/{id}', function ($id) {
    })->name("attribute.save");

    Route::post('/attributes/edit/children/{id}', function ($id) {
    })->name("attribute.children.save");
});


Route::get('/reports', function () {
    return view('reports');
})->name("reports");

Route::get('/messages', function () {
    return view('messages');
})->name("messages.show");

Route::get('/message/{id}', function ($id) {
    return view('message');
})->name("message.show");



Route::group(['prefix' => 'checks'], function () {
    Route::get('/list', function () {
        return view('checks');
    })->name("checks.list.show");

    Route::get('/create', function () {
        return view('check');
    })->name("check.create.show");

    Route::get('/check/{id}', function ($id) {
        return view('check');
    })->name("check.show");
});


Route::group(['prefix' => 'discounts'], function () {
    Route::get('/list', function () {
        return view('discounts');
    })->name("discounts.list.show");

    Route::get('/create', function () {
        return view('discount');
    })->name("discount.create.show");

    Route::get('/edit/{id}', function ($id) {
        return view('discount');
    })->name("discount.show");
});

Route::get('/orders/', function () {
    return view('orders');
})->name("orders.show");