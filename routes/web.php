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

Route::group(['prefix' => 'posts'], function () {

    Route::get('/list', function () {
        return view('posts');
    })->name("posts.show");

    // Single for edit or create a new post
    Route::get('/post/', function () {
        return view('post');
    })->name("post.show");

    // table of categories
    Route::get('/categories', function () {
        return view('post-categories');
    })->name("post-categories.show");

    Route::get('/category/{id}', function ($id) {
        return view('post-category');
    })->name("post-category.show");

    Route::get('/create-category', function () {
        return view('post-category');
    })->name("post-category.create.show");

    Route::get('/tags/', function () {
        return view('post-tags');
    })->name("post.tags.show");

    Route::get('/tags/edit/{id}', function ($id) {
        return view('post-tag');
    })->name("post.tag.show");

    Route::get('/tags/create/', function () {
        return view('post-tag');
    })->name("post.tag.create.show");

    Route::get('/comments/', function () {
        return view('post-comments');
    })->name("post.comments.show");

    Route::get('/comment/{id}', function ($id) {
        return view('post-comment');
    })->name("post.comment.show");
});

// table of posts






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
    })->name("block.create.show");

    Route::get('/edit/{id}', function ($id) {
        return view('block', ['id' => $id]);
    })->name("block.edit");
});

Route::group(['prefix' => 'page'], function () {
    Route::get('/', function () {
        return view('pages');
    })->name("page.list.show");

    Route::get('/create', function () {
        return view('page');
    })->name("page.create");

    Route::get('/edit/{id}', function ($id) {
        return view('page');
    })->name("page.edit");

    Route::post('/delete', function ($id) {
        return view('page');
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

    Route::get('/tags/create/', function () {
        return view('product-tag');
    })->name("product.tag.create.show");

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

    Route::get('/attributes/create/', function () {
        return view('attribute');
    })->name("attribute.create.show");

    Route::get('/attributes/edit/{id}', function ($id) {
        return view('attribute');
    })->name("attribute.show");

    Route::post('/attributes/edit/{id}', function ($id) {
    })->name("attribute.save");

    Route::post('/attributes/edit/children/{id}', function ($id) {
    })->name("attribute.children.save");

    Route::get('/settings', function () {
        return view('products-settings');
    })->name("products.settings.show");
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

Route::get('/order/{id}', function ($id) {
    return view('order');
})->name("order.show");

Route::post('/order/{id}', function ($id) {
})->name("order.show");

Route::get('/create-order', function () {
    return view('order-create');
})->name("order.create.show");

Route::get('/order/print/{id}', function ($id) {
    return view('order-print');
})->name("order.print.show");


Route::group(['prefix' => 'installments'], function () {
    Route::get('/list', function () {
        return view('installments');
    })->name("installments.list.show");

    Route::get('/edit/{id}', function ($id) {
        return view('installment');
    })->name("installment.show");

    Route::get('/create', function () {
        return view('installment');
    })->name("installment.create.show");

    Route::get('/plans/list', function () {
        return view('installments-plans');
    })->name("installments.plans.list.show");

    Route::get('/plans/edit/{id}', function ($id) {
        return view('installments-plan');
    })->name("installments.plan.show");

    Route::get('/report', function () {
        return view('installments-report');
    })->name("installments.report.show");
});

Route::get('/worktimes', function () {
    return view('worktimes');
})->name("worktimes.show");

Route::get('/worktime/edit/{id}', function ($id) {
    return view('worktime');
})->name("worktime.edit.show");

Route::get('/worktime/create', function () {
    return view('worktime');
})->name("worktime.create.show");

Route::get('/menus', function () {
    return view('menus');
})->name("menus.show");

Route::get('/menu/{id}', function ($id) {
    return view('menu');
})->name("menu.show");

Route::get('/imagemarkers', function () {
    return view('imagemarkers');
})->name("imagemarkers.show");

Route::get('/imagemarker/{id}', function ($id) {
    return view('imagemarker');
})->name("imagemarker.show");

Route::get('/checkouts', function () {
    return view('checkouts');
})->name("checkouts.show");

Route::get('/sms-settings', function () {
    return view('sms-settings');
})->name("sms-settings.show");

Route::group(['prefix' => 'snippets'], function () {
    Route::get('/list', function () {
        return view('snippets');
    })->name("snippets.list.show");

    Route::get('/create', function () {
        return view('snippet');
    })->name("snippet.create.show");

    Route::get('/edit/{id}', function ($id) {
        return view('snippet');
    })->name("snippet.show");
});

Route::get('/customize', function () {
    return view('customize');
})->name("customize.show");

Route::get('/services', function () {
    return view('services');
})->name("services.show");