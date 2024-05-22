<?php

use App\Models\PostCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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


Route::group(['prefix' => 'tags'], function () {

    Route::get('/', [TagController::class, 'index'])->name("tags.list");

    Route::get('/create', [TagController::class, 'create'])->name("tags.create");
    Route::post('/store', [TagController::class, 'store'])->name("tags.store");

    Route::get('/edit/{id}', [TagController::class, 'edit'])->name("tags.edit");
    Route::put('/update/{id}', [TagController::class, 'update'])->name("tags.update");

    Route::post('/delete', [TagController::class, 'delete'])->name("tags.delete");
    Route::post('/bulk_action', [TagController::class, 'bulkAction'])->name('tags.bulk_action');
});

Route::group(['prefix' => 'comments'], function () {

    Route::get('/', [CommentController::class, 'index'])->name("comments.list");

    Route::get('/create', [CommentController::class, 'create'])->name("comments.create");
    Route::post('/store', [CommentController::class, 'store'])->name("comments.store");

    Route::get('/edit/{id}', [CommentController::class, 'edit'])->name("comments.edit");
    Route::put('/update/{id}', [CommentController::class, 'update'])->name("comments.update");

    Route::post('/delete', [CommentController::class, 'delete'])->name("comments.delete");

    Route::post('/bulk_action', [CommentController::class, 'bulk_action'])->name("comments.bulk_action");
    Route::post('/reply', [CommentController::class, 'reply'])->name("comments.reply"); // مسیر جدید برای پاسخ

    Route::get('/approve/{id}', [CommentController::class, 'approve'])->name('comments.approve');
    Route::get('/reject/{id}', [CommentController::class, 'reject'])->name('comments.reject');




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
