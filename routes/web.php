<?php

use App\Models\Page;
use App\Models\Review;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductTagController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\SubAttributeController;
use App\Http\Controllers\AttributeItemController;
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


Route::get('/search', [SearchController::class, 'search'])->name('api.search');
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

Route::group(['prefix' => 'pages'], function () {

    Route::get('/', [PageController::class, 'index'])->name("pages.list");

    Route::get('/create', [PageController::class, 'create'])->name("pages.create");
    Route::post('/store', [PageController::class, 'store'])->name("pages.store");

    Route::get('/edit/{id}', [PageController::class, 'edit'])->name("pages.edit");
    Route::put('/update/{id}', [PageController::class, 'update'])->name("pages.update");

    Route::post('/delete', [PageController::class, 'delete'])->name("pages.delete");

    Route::post('/bulk_action', [PageController::class, 'bulk_action'])->name("pages.bulk_action");

});


Route::group(['prefix' => 'products/categories'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.list');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::post('/delete', [CategoryController::class, 'delete'])->name('categories.delete');
    Route::post('/bulk_action', [CategoryController::class, 'bulk_action'])->name('categories.bulk_action');
});

Route::group(['prefix' => 'products/tags'], function () {

    Route::get('/', [ProductTagController::class, 'index'])->name("products.tags.list");
    Route::get('/create', [ProductTagController::class, 'create'])->name("products.tags.create");
    Route::post('/store', [ProductTagController::class, 'store'])->name("products.tags.store");

    Route::get('/edit/{id}', [ProductTagController::class, 'edit'])->name("products.tags.edit");
    Route::put('/update/{id}', [ProductTagController::class, 'update'])->name("products.tags.update");

    Route::post('/delete', [ProductTagController::class, 'delete'])->name("products.tags.delete");

    Route::post('/bulk_action', [ProductTagController::class, 'bulk_action'])->name("products.tags.bulk_action");

});

Route::group(['prefix' => 'products/reviews'], function () {

    Route::get('/', [ReviewController::class, 'index'])->name("products.reviews.list");

    Route::get('/create', [ReviewController::class, 'create'])->name("products.reviews.create");
    Route::post('/store', [ReviewController::class, 'store'])->name("products.reviews.store");

    Route::get('/edit/{id}', [ReviewController::class, 'edit'])->name("products.reviews.edit");
    Route::put('/update/{id}', [ReviewController::class, 'update'])->name("products.reviews.update");

    Route::post('/delete', [ReviewController::class, 'delete'])->name("products.reviews.delete");

    Route::post('/bulk_action', [ReviewController::class, 'bulk_action'])->name("products.reviews.bulk_action");

});




Route::group(['prefix' => 'products/attributes'], function () {

    Route::get('/', [AttributeController::class, 'index'])->name("attributes.list");
    Route::get('/create', [AttributeController::class, 'create'])->name("attributes.create");
    Route::post('/store', [AttributeController::class, 'store'])->name("attributes.store");
    Route::get('/edit/{id}', [AttributeController::class, 'edit'])->name("attributes.edit");
    Route::put('/update/{id}', [AttributeController::class, 'update'])->name("attributes.update");
    Route::post('/delete', [AttributeController::class, 'delete'])->name("attributes.delete");
    Route::get('/attribute-options/{attributeId}', [AttributeController::class, 'getOptions']);
});

Route::group(['prefix' => 'products/attributesProperties'], function () {
    Route::get('/create/{id}', [AttributeItemController::class, 'create'])->name("attribute.properties.create");
    Route::post('/store', [AttributeItemController::class, 'store'])->name("attribute.properties.store");
    Route::get('/edit/{id}', [AttributeItemController::class, 'edit'])->name("attribute.properties.edit");
    Route::put('/update/{id}', [AttributeItemController::class, 'update'])->name("attribute.properties.update");
    Route::post('/delete', [AttributeItemController::class, 'delete'])->name("attribute.properties.delete");
});

Route::group(['prefix' => 'products'], function () {

    Route::get('/', [ProductController::class, 'index'])->name("products.list");
    Route::get('/create', [ProductController::class, 'create'])->name("products.create");
    Route::post('/store', [ProductController::class, 'store'])->name("products.store");
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name("products.edit");
    Route::put('/update/{id}', [ProductController::class, 'update'])->name("products.update");
    Route::post('/delete', [ProductController::class, 'delete'])->name("products.delete");
    Route::post('/bulk_action', [ProductController::class, 'bulk_action'])->name("products.bulk_action");
    Route::post('/update-attributes', [ProductController::class, 'updateAttributes']);

});

Route::group(['prefix' => 'installments'], function () {

    Route::get('/list', [InstallmentController::class, 'installment'])->name("installments");

    Route::get('/', [InstallmentController::class, 'index'])->name("installments.list");

    Route::get('/create', [InstallmentController::class, 'create'])->name("installments.create");
    Route::post('/store', [InstallmentController::class, 'store'])->name("installments.store");

    Route::get('/edit/{id}', [InstallmentController::class, 'edit'])->name("installments.edit");
    Route::put('/update/{id}', [InstallmentController::class, 'update'])->name("installments.update");

    Route::post('/delete', [InstallmentController::class, 'delete'])->name("installments.delete");

    Route::post('/bulk_action', [InstallmentController::class, 'bulk_action'])->name("installments.bulk_action");

    Route::get('/plans/list', [InstallmentController::class, 'list'])->name("installments.plans.list.show");
    Route::get('/report', [InstallmentController::class, 'report'])->name("installments.report.show");
});

Route::group(['prefix' => 'credit'], function () {

    Route::get('/', [CreditController::class, 'index'])->name("credit.show");

    Route::get('/create', [CreditController::class, 'create'])->name("credit.create");
    Route::post('/store', [CreditController::class, 'store'])->name("credit.store");

    Route::get('/edit/{id}', [CreditController::class, 'edit'])->name("credit.edit");
    Route::put('/update/{id}', [CreditController::class, 'update'])->name("credit.update");

    Route::post('/delete', [CreditController::class, 'delete'])->name("credit.delete");

    Route::post('/bulk_action', [CreditController::class, 'bulk_action'])->name("credit.bulk_action");

});

// Route::group(['prefix' => 'installments'], function () {
//     Route::get('/list', function () {
//         return view('installments');
//     })->name("installments.list.show");

//     Route::get('/edit/{id}', function ($id) {
//         return view('installment');
//     })->name("installment.show");

//     Route::get('/create', function () {
//         return view('installment');
//     })->name("installment.create.show");

//     Route::get('/plans/list', function () {
//         return view('installments-plans');
//     })->name("installments.plans.list.show");

//     Route::get('/plans/edit/{id}', function ($id) {
//         return view('installments-plan');
//     })->name("installments.plan.show");

//     Route::get('/report', function () {
//         return view('installments-report');
//     })->name("installments.report.show");

// });


Route::group(['prefix' => 'users'], function () {

    Route::get('/', [UserController::class, 'index'])->name("users.list");

    Route::get('/create', [UserController::class, 'create'])->name("users.create");
    Route::post('/store', [UserController::class, 'store'])->name("users.store");

    Route::get('/edit/{id}', [UserController::class, 'edit'])->name("users.edit");
    Route::get('/profile/{id}', [UserController::class, 'profile'])->name("users.profile");

    Route::get('/profile/sessions/{id}', [UserController::class, 'sessions'])->name("users.sessions.index");
    Route::post('/profile/sessions/{id}', [UserController::class, 'sessions'])->name("user.sessions.save");

    Route::put('/update/{id}', [UserController::class, 'update'])->name("users.update");

    Route::post('/delete', [UserController::class, 'delete'])->name("users.delete");

    Route::post('/bulk_action', [UserController::class, 'bulk_action'])->name("users.bulk_action");

});


// Route::group(['prefix' => 'users'], function () {
//     Route::get('/', function () {
//         return view('users');
//     })->name("users.list");

//     Route::get('/create', function () {
//         return view('user-create');
//     })->name("user.create");

//     Route::get('/profile/{id}', function ($id) {
//         return view('user-profile', ['id' => $id]);
//     })->name("user.profile");

//     // User sessions for user login history like IP, browser, device, etc.
//     Route::get('/profile/sessions/{id}', function () {
//         return view('user-sessions');
//     })->name("user.sessions.show");

//     Route::delete('/profile/sessions/{id}', function () {
//     })->name("user.sessions.save");

//     Route::get('/edit/{id}', function ($id) {
//         return view('user-detail', ['id' => $id]);
//     })->name("user.edit.show");

//     Route::post('/edit/{id}', function ($id) {
//     })->name("user.edit.save");

//     Route::post('/delete', function ($id) {
//         return view('user', ['id' => $id]);
//     })->name("user.delete");
// });

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





// table of posts
Route::get('/settings', function () {
    return view('settings');
})->name("settings.show");

Route::post('/settings', function () {
})->name("settings.save");




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
