<?php

use App\Models\Page;
use App\Models\Review;
use App\Models\Slider;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\WorkTimeController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\CodePieceController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\ProductTagController;
use App\Http\Controllers\ScoreGroupController;
use App\Http\Controllers\SmsSettingController;
use App\Http\Controllers\HoloSettingController;
use App\Http\Controllers\ImageMarkerController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\SubAttributeController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\AttributeItemController;
use App\Http\Controllers\Auth\Mail\AuthController;
use App\Http\Controllers\PostCategoriesController;
use App\Http\Controllers\Auth\Mail\LoginController;
use App\Http\Controllers\SettlementDocumentController;
use App\Http\Controllers\Auth\Mail\ResetPasswordController;
use App\Http\Controllers\Auth\Mail\ForgotPasswordController;

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
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name("index");
    Route::get('/home', function () {
        return view('index');
    })->name("home");

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
        Route::get('/settings', [ProductController::class, 'settings'])->name("products.settings");
        Route::get('/{id}/delete-all-images', [ProductController::class, 'deleteAllImages'])->name('products.delete.images');
        Route::get('/products/{id}/delete-thumbnail', [ProductController::class, 'deleteThumbnail'])->name('products.delete.thumbnail');
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

    Route::group(['prefix' => 'credits'], function () {

        Route::get('/', [CreditController::class, 'index'])->name("credits.show");

        Route::get('/create', [CreditController::class, 'create'])->name("credits.create");
        Route::post('/store', [CreditController::class, 'store'])->name("credits.store");

        Route::get('/edit/{id}', [CreditController::class, 'edit'])->name("credits.edit");
        Route::put('/update/{id}', [CreditController::class, 'update'])->name("credits.update");

        Route::post('/delete', [CreditController::class, 'delete'])->name("credits.delete");

        Route::post('/bulk_action', [CreditController::class, 'bulk_action'])->name("credits.bulk_action");

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

        Route::get('/roles', [UserController::class, 'roles'])->name("users.roles.index");
        Route::get('/roles/create', [UserController::class, 'rolesCreate'])->name("users.roles.create");
        Route::post('/roles/store', [UserController::class, 'rolesStore'])->name("users.roles.store");
        Route::get('/roles/edit/{id}', [UserController::class, 'rolesEdit'])->name("users.roles.edit");
        Route::put('/roles/{id}', [UserController::class, 'rolesUpdate'])->name("users.roles.update");
        Route::get('/roles/{id}', [UserController::class, 'rolesDelete'])->name("users.roles.delete"); // اضافه کردن روت حذف نقش
        Route::post('/roles/bulk_action', [UserController::class, 'rolesBulk_action'])->name("users.roles.bulk_action");
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

    Route::group(['prefix' => 'menus'], function () {

        Route::get('/', [MenuController::class, 'index'])->name("menus.list");

        Route::get('/create', [MenuController::class, 'create'])->name("menus.create");
        Route::post('/store', [MenuController::class, 'store'])->name("menus.store");

        Route::get('/edit/{id}', [MenuController::class, 'edit'])->name("menus.edit");
        Route::put('/update/{id}', [MenuController::class, 'update'])->name("menus.update");

        Route::post('/delete', [MenuController::class, 'delete'])->name("menus.delete");

        Route::post('/bulk_action', [MenuController::class, 'bulk_action'])->name("menus.bulk_action");

    });

    Route::group(['prefix' => 'blocks'], function () {

        Route::get('/', [BlockController::class, 'index'])->name("blocks.list");

        Route::get('/create', [BlockController::class, 'create'])->name("blocks.create");
        Route::post('/store', [BlockController::class, 'store'])->name("blocks.store");

        Route::get('/edit/{id}', [BlockController::class, 'edit'])->name("blocks.edit");
        Route::put('/update/{id}', [BlockController::class, 'update'])->name("blocks.update");

        Route::get('/delete/{id}', [BlockController::class, 'delete'])->name("blocks.delete");

        Route::post('/bulk_action', [BlockController::class, 'bulk_action'])->name("blocks.bulk_action");

    });
    Route::group(['prefix' => 'transports'], function () {

        Route::get('/', [TransportController::class, 'index'])->name("transports.list");

        Route::get('/create', [TransportController::class, 'create'])->name("transports.create");
        Route::post('/store', [TransportController::class, 'store'])->name("transports.store");

        Route::get('/edit/{id}', [TransportController::class, 'edit'])->name("transports.edit");
        Route::put('/update/{id}', [TransportController::class, 'update'])->name("transports.update");

        Route::post('/delete', [TransportController::class, 'delete'])->name("transports.delete");

        Route::post('/bulk_action', [TransportController::class, 'bulk_action'])->name("transports.bulk_action");

    });

    Route::group(['prefix' => 'sessions'], function () {

        Route::get('/', [SessionController::class, 'index'])->name("sessions.list");

        Route::get('/create', [SessionController::class, 'create'])->name("sessions.create");
        Route::post('/store', [SessionController::class, 'store'])->name("sessions.store");

        Route::get('/edit/{id}', [SessionController::class, 'edit'])->name("sessions.edit");
        Route::put('/update/{id}', [SessionController::class, 'update'])->name("sessions.update");

        Route::post('/delete', [SessionController::class, 'delete'])->name("sessions.delete");

        Route::post('/bulk_action', [SessionController::class, 'bulk_action'])->name("sessions.bulk_action");
        Route::post('/sessions/store', [SessionController::class, 'store'])->name('sessions.store');
        Route::post('notifications', [SessionController::class,'save'])->name('dashboard.messages.save');

    });

    Route::group(['prefix' => 'checks'], function () {

        Route::get('/', [CheckController::class, 'index'])->name("checks.list");

        Route::get('/create', [CheckController::class, 'create'])->name("checks.create");
        Route::post('/store', [CheckController::class, 'store'])->name("checks.store");

        Route::get('/edit/{id}', [CheckController::class, 'edit'])->name("checks.edit");
        Route::put('/update/{id}', [CheckController::class, 'update'])->name("checks.update");

        Route::post('/delete', [CheckController::class, 'delete'])->name("checks.delete");

        Route::post('/bulk_action', [CheckController::class, 'bulk_action'])->name("checks.bulk_action");

    });


Route::group(['prefix' => 'discounts'], function () {

    Route::get('/', [DiscountController::class, 'index'])->name("discounts.list");

    Route::get('/create', [DiscountController::class, 'create'])->name("discounts.create");
    Route::post('/store', [DiscountController::class, 'store'])->name("discounts.store");

    Route::get('/edit/{id}', [DiscountController::class, 'edit'])->name("discounts.edit");
    Route::put('/update/{id}', [DiscountController::class, 'update'])->name("discounts.update");

    Route::post('/delete', [DiscountController::class, 'delete'])->name("discounts.delete");

    Route::post('/bulk_action', [DiscountController::class, 'bulk_action'])->name("discounts.bulk_action");

});

Route::group(['prefix' => 'gateways'], function () {

    Route::get('/', [GatewayController::class, 'index'])->name("gateways.list");

    Route::get('/create', [GatewayController::class, 'create'])->name("gateways.create");
    Route::post('/store', [GatewayController::class, 'store'])->name("gateways.store");

    Route::get('/edit/{id}', [GatewayController::class, 'edit'])->name("gateways.edit");
    Route::put('/update/{id}', [GatewayController::class, 'update'])->name("gateways.update");
    Route::get('/gateways/{id}/activate', [GatewayController::class, 'activate'])->name('gateways.activate');

    Route::get('/delete/{id}', [GatewayController::class, 'delete'])->name("gateways.delete");

    Route::post('/bulk_action', [GatewayController::class, 'bulk_action'])->name("gateways.bulk_action");

});


Route::group(['prefix' => 'carts'], function () {

    Route::get('/', [CartController::class, 'index'])->name("carts.list");

    Route::get('/create', [CartController::class, 'create'])->name("carts.create");
    Route::post('/store', [CartController::class, 'store'])->name("carts.store");

    Route::get('/edit/{id}', [CartController::class, 'edit'])->name("carts.edit");
    Route::put('/update/{id}', [CartController::class, 'update'])->name("carts.update");

    Route::post('/delete/{id}', [CartController::class, 'delete'])->name("carts.delete");

    Route::post('/bulk_action', [CartController::class, 'bulk_action'])->name("carts.bulk_action");

});

Route::group(['prefix' => 'orders'], function () {

    Route::get('/', [OrderController::class, 'index'])->name("orders.list");

    Route::get('/create', [OrderController::class, 'create'])->name("orders.create");
    Route::post('/store', [OrderController::class, 'store'])->name("orders.store");

    Route::get('/edit/{id}', [OrderController::class, 'edit'])->name("orders.edit");
    Route::put('/update/{id}', [OrderController::class, 'update'])->name("orders.update");

    Route::post('/delete', [OrderController::class, 'delete'])->name("orders.delete");

    Route::post('/bulk_action', [OrderController::class, 'bulk_action'])->name("orders.bulk_action");
    Route::get('/print/{id}', [OrderController::class, 'print'])->name("orders.print");

    Route::put('/{order}/update-billing', [OrderController::class, 'updateBilling'])->name('orders.updateBilling');
    Route::put('/{order}/update-shipping', [OrderController::class, 'updateShipping'])->name('orders.updateShipping');
    Route::put('/{order}/update-shipping-note', [OrderController::class, 'updateShippingNote'])->name('orders.updateShippingNote');
    Route::post('/{order}/add-product', [OrderController::class, 'addProduct'])->name('orders.addProduct');


    Route::post('/product-details/{id}/update', [OrderController::class, 'updateProductDetails'])->name('updateProductDetails');

});

Route::group(['prefix' => 'sliders'], function () {

    Route::get('/', [SliderController::class, 'index'])->name("sliders.list");

    Route::get('/create', [SliderController::class, 'create'])->name("sliders.create");
    Route::post('/store', [SliderController::class, 'store'])->name("sliders.store");

    Route::get('/edit/{id}', [SliderController::class, 'edit'])->name("sliders.edit");
    Route::put('/update/{id}', [SliderController::class, 'update'])->name("sliders.update");

    Route::post('/delete', [SliderController::class, 'delete'])->name("sliders.delete");

    Route::post('/bulk_action', [SliderController::class, 'bulk_action'])->name("sliders.bulk_action");

    Route::get('/add/{id}', [SliderController::class, 'slideView'])->name("sliders.view");

    Route::put('/add/{id}', [SliderController::class, 'addImage'])->name("sliders.add");
    Route::get('/{image_id}/delete', [SliderController::class, 'deleteImage'])->name('sliders.deleteImage');
});

Route::group(['prefix' => 'settings'], function () {

    //Route::get('/', [SettingController::class, 'index'])->name("settings.list");

    Route::get('/create', [SettingController::class, 'create'])->name("settings.create");
    Route::post('/store', [SettingController::class, 'store'])->name("settings.store");

    Route::get('/{group}', [SettingController::class, 'edit'])->name("settings.edit");
    Route::post('/update/{group}', [SettingController::class, 'update'])->name("settings.update");

    Route::post('/delete', [SettingController::class, 'delete'])->name("settings.delete");

    Route::post('/bulk_action', [SettingController::class, 'bulk_action'])->name("settings.bulk_action");

});

Route::group(['prefix' => 'services'], function () {

    //Route::get('/', [SettingController::class, 'index'])->name("services.list");

    Route::get('/create', [SettingController::class, 'create'])->name("services.create");
    Route::post('/store', [SettingController::class, 'store'])->name("services.store");
    Route::get('/holo', [HoloSettingController::class, 'edit'])->name('settings.holo.edit');
    Route::post('/holo', [HoloSettingController::class, 'update'])->name('settings.holo.update');
    Route::get('/sms', [SettingController::class, 'editSms'])->name("services.sms.edit");
    Route::post('/update/sms', [SettingController::class, 'updateSms'])->name("services.update.sms");
    Route::put('/update/sms', [SettingController::class, 'storeSms'])->name("services.store.sms");

    //Route::post('/update/{group}', [SettingController::class, 'update'])->name("services.update");

    Route::post('/delete', [SettingController::class, 'delete'])->name("services.delete");

    Route::post('/bulk_action', [SettingController::class, 'bulk_action'])->name("services.bulk_action");


});



Route::group(['prefix' => 'code-piceces'], function () {

    Route::get('/', [CodePieceController::class, 'index'])->name("code-piceces.list");

    Route::get('/create', [CodePieceController::class, 'create'])->name("code-piceces.create");
    Route::post('/store', [CodePieceController::class, 'store'])->name("code-piceces.store");

    Route::get('/edit/{id}', [CodePieceController::class, 'edit'])->name("code-piceces.edit");
    Route::put('/update/{id}', [CodePieceController::class, 'update'])->name("code-piceces.update");

    Route::post('/delete', [CodePieceController::class, 'delete'])->name("code-piceces.delete");

    Route::post('/bulk_action', [CodePieceController::class, 'bulk_action'])->name("code-piceces.bulk_action");

});

Route::resource('image-markers', ImageMarkerController::class);
Route::get('/checkproduct/{id}', [ImageMarkerController::class, 'checkProduct']);
Route::get('/imgdot/{id}', [ImageMarkerController::class, 'imgdot']);


Route::resource('worktimes', WorktimeController::class);
Route::delete('worktimes/{worktime}', [WorkTimeController::class, 'destroy'])->name('worktimes.destroy');

Route::get('/files-manager', function () {
    return view('files');
})->name("files-manager");


Route::resource('settlement_documents', SettlementDocumentController::class);
Route::post('/settlement_documents/bulk-delete', [SettlementDocumentController::class, 'bulkDelete'])->name('settlement_documents.bulk_delete');


Route::group(['prefix' => 'groups'], function () {
    Route::get('/', [GroupController::class, 'index'])->name('groups.index');
    Route::get('/create', [GroupController::class, 'create'])->name('groups.create');
    Route::post('/store', [GroupController::class, 'store'])->name('groups.store');
    Route::get('/{group}/edit', [GroupController::class, 'edit'])->name('groups.edit');
    Route::put('/{group}', [GroupController::class, 'update'])->name('groups.update');
    Route::delete('/{group}', [GroupController::class, 'destroy'])->name('groups.destroy');
    Route::post('/bulk_action', [GroupController::class, 'bulk_action'])->name("groups.bulk_action");

});
Route::group(['prefix' => 'score-groups'], function () {

    Route::get('/', [ScoreGroupController::class, 'index'])->name("score-groups.index");

    Route::get('/create', [ScoreGroupController::class, 'create'])->name("score-groups.create");
    Route::post('/store', [ScoreGroupController::class, 'store'])->name("score-groups.store");

    Route::get('/edit/{id}', [ScoreGroupController::class, 'edit'])->name("score-groups.edit");
    Route::put('/update/{id}', [ScoreGroupController::class, 'update'])->name("score-groups.update");

    Route::delete('/{id}', [ScoreGroupController::class, 'destroy'])->name("score-groups.destroy");

    Route::post('/bulk_action', [ScoreGroupController::class, 'bulk_action'])->name("score-groups.bulk_action");
    Route::get('/setting', [ScoreGroupController::class, 'setting'])->name("score-groups.setting");
    Route::post('/setting/edit', [ScoreGroupController::class, 'editSetting'])->name("score-groups.setting.edit");
});


Route::group(['prefix' => 'sms'], function () {

    Route::get('/', [SmsController::class, 'index'])->name("sms.index");

    Route::get('/create', [SmsController::class, 'create'])->name("sms.create");
    Route::post('/store', [SmsController::class, 'store'])->name("sms.store");

    Route::get('/edit/{id}', [SmsController::class, 'edit'])->name("sms.edit");
    Route::put('/update/{id}', [SmsController::class, 'update'])->name("sms.update");

    Route::post('/delete', [SmsController::class, 'delete'])->name("sms.delete");

    Route::post('/bulk_action', [SmsController::class, 'bulk_action'])->name("sms.bulk_action");

});





});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('user.login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/forgotPassword', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('forgot');
Route::post('/sendResetLinkEmail', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('forgot.send');
Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.email.update');
Route::get('/register', [AuthController::class, 'show'])->name('register');
Route::post('/register', [AuthController::class, 'submit'])->name('register.submit');





Route::get('/signup', function () {
    return view('auth.signup');
})->name("signup");

Route::get('/forgetpass', function () {
    return view('auth.forgetpass');
})->name("forgetpass");

Route::get('/changepass', function () {
    return view('auth.changepass');
})->name("changepass");

// Route::get('/slides', function () {
//     return view('slides');
// })->name("slides.show");

// Route::post('/slides', function () {
// })->name("slides.save");

// Route::get('/slide/{id}', function ($id) {
//     return view('slide');
// })->name("slide.edit.show");

// Route::get('/create-slide', function () {
//     return view('slide');
// })->name("slide.create.show");

// Route::group(['prefix' => 'block'], function () {
//     Route::get('/', function () {
//         return view('blocks');
//     })->name("block.list");

//     Route::get('/create', function () {
//         return view('block');
//     })->name("block.create.show");

//     Route::get('/edit/{id}', function ($id) {
//         return view('block', ['id' => $id]);
//     })->name("block.edit");
// });

// Route::group(['prefix' => 'page'], function () {
//     Route::get('/', function () {
//         return view('pages');
//     })->name("page.list.show");

//     Route::get('/create', function () {
//         return view('page');
//     })->name("page.create");

//     Route::get('/edit/{id}', function ($id) {
//         return view('page');
//     })->name("page.edit");

//     Route::post('/delete', function ($id) {
//         return view('page');
//     })->name("page.delete");
// });

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

// Route::group(['prefix' => 'settings'], function () {
//     Route::get('/general', function () {
//         return view('settings');
//     })->name("settings.show");

//     Route::post('/settings', function () {
//     })->name("settings.save");
// });



// Route::group(['prefix' => 'products'], function () {

//     Route::get('/list/', function () {
//         return view('products');
//     })->name("products.list.show");

//     Route::get('/create/', function () {
//         return view('product');
//     })->name("product.create.show");

//     Route::get('/edit/{id}', function ($id) {
//         return view('product');
//     })->name("product.edit.show");

//     Route::get('/categories/', function () {
//         return view('product-categories');
//     })->name("product.categories.show");

//     Route::get('/category/{id}', function ($id) {
//         return view('product-category');
//     })->name("product.category.show");

//     Route::get('/tags/', function () {
//         return view('product-tags');
//     })->name("product.tags.show");

//     Route::get('/tags/edit/{id}', function ($id) {
//         return view('product-tag');
//     })->name("product.tag.show");

//     Route::get('/tags/create/', function () {
//         return view('product-tag');
//     })->name("product.tag.create.show");

//     Route::get('/comments/', function () {
//         return view('product-comments');
//     })->name("product.comments.show");

//     Route::get('/comment/{id}', function ($id) {
//         return view('product-comment');
//     })->name("product.comment.show");

//     Route::post('/category/{id}', function ($id) {
//     })->name("product.category.save");



//     Route::delete('/delete/{id}', function () {
//     })->name("product.delete");

//     Route::get('/attributes', function () {
//         return view('attributes');
//     })->name("attributes.list.show");

//     Route::get('/attributes/create/', function () {
//         return view('attribute');
//     })->name("attribute.create.show");

//     Route::get('/attributes/edit/{id}', function ($id) {
//         return view('attribute');
//     })->name("attribute.show");

//     Route::post('/attributes/edit/{id}', function ($id) {
//     })->name("attribute.save");

//     Route::post('/attributes/edit/children/{id}', function ($id) {
//     })->name("attribute.children.save");

//     Route::get('/settings', function () {
//         return view('products-settings');
//     })->name("products.settings.show");
// });

// Route::group(['prefix' => 'reports'], function () {

//     Route::get('/all', function () {
//         return view('reports');
//     })->name("reports.show");

//     Route::get('/reports/create', function () {
//         return view('report');
//     })->name("report.create.show");

//     Route::get('/reports/{id}', function ($id) {
//         return view('report');
//     })->name("report.edit.show");
// });

// Route::group(['prefix' => 'customers-group'], function () {
//     Route::get('/list', function () {
//         return view('customers-group');
//     })->name("customers-group.show");

//     Route::get('/create', function () {
//         return view('customer-group');
//     })->name("customers-group.create.show");

//     Route::get('/edit/{id}', function ($id) {
//         return view('customer-group');
//     })->name("customers-group.edit.show");
// });

// Route::group(['prefix' => 'discounts'], function () {
//     Route::get('/list', function () {
//         return view('discounts');
//     })->name("discounts.list.show");

//     Route::get('/create', function () {
//         return view('discount');
//     })->name("discount.create.show");

//     Route::get('/edit/{id}', function ($id) {
//         return view('discount');
//     })->name("discount.show");
// });

// Route::group(['prefix' => 'orders'], function () {
//     Route::get('/list/', function () {
//         return view('orders');
//     })->name("orders.show");

//     Route::get('/order/{id}', function ($id) {
//         return view('order');
//     })->name("order.show");

//     Route::post('/order/{id}', function ($id) {
//     })->name("order.show");

//     Route::get('/create-order', function () {
//         return view('order-create');
//     })->name("order.create.show");

//     Route::get('/order/print/{id}', function ($id) {
//         return view('order-print');
//     })->name("order.print.show");



// });
Route::group(['prefix' => 'service-orders'], function () {
    Route::get('/list/', function () {
        return view('orders-service');
    })->name("service-orders.show");
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

// Route::get('/worktimes', function () {
//     return view('worktimes');
// })->name("worktimes.show");

// Route::get('/worktime/edit/{id}', function ($id) {
//     return view('worktime');
// })->name("worktime.edit.show");

// Route::get('/worktime/create', function () {
//     return view('worktime');
// })->name("worktime.create.show");



// Route::get('/imagemarkers', function () {
//     return view('imagemarkers');
// })->name("imagemarkers.show");

// Route::get('/imagemarkers-create', function () {
//     return view('imagemarker');
// })->name("imagemarkers.create");

// Route::get('/imagemarker/{id}', function ($id) {
//     return view('imagemarker');
// })->name("imagemarker.edit");

// Route::get('/gateways', function () {
//     return view('gateways');
// })->name("gateways.show");

// Route::get('/checkout/{id}', function ($id) {
//     return view('checkout');
// })->name("checkout.show");

// Route::get('/checkout-create', function () {
//     return view('checkout-create');
// })->name("checkout-create.show");

// Route::get('/sms', function () {
//     return view('sms');
// })->name("sms.index");

// Route::get('/sms-text/{id}', function ($id) {
//     return view('sms-text');
// })->name("sms-text.show");

// Route::get('/create-sms-text/', function () {
//     return view('sms-text');
// })->name("sms.create");

// Route::get('/sms-text-create', function () {
//     return view('sms-text-create');
// })->name("sms-text.create");


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

// Route::group(['prefix' => 'services'], function () {
//     Route::get('/service1', function () {
//         return view('services');
//     })->name("services.show");
// });


// Route::get('/carts', function () {
//     return view('carts');
// })->name("carts.show");

// Route::get('/cart/{id}', function ($id) {
//     return view('cart');
// })->name("cart.edit.show");

// Route::get('/create-cart', function () {
//     return view('cart');
// })->name("cart.create.show");


// Route::get('/transports', function () {
//     return view('transports');
// })->name("transports.show");

// Route::get('/transport/{id}', function ($id) {
//     return view('transport');
// })->name("transport.edit.show");

// Route::get('/create-transport', function () {
//     return view('transport');
// })->name("transport.create.show");



Route::get('/test', function () {
    return view('file.ckeditor');
})->name("files-test");


// Route::group(['prefix' => 'scores'], function () {
//     Route::get('/groups', function () {
//         return view('score-groups');
//     })->name("score-groups.show");

//     Route::get('/group/{id}', function ($id) {
//         return view('score-group');
//     })->name("score-group.edit.show");

//     Route::get('/group-create/', function () {
//         return view('score-group');
//     })->name("score-group.create.show");

//     Route::get('/settings', function () {
//         return view('score-settings');
//     })->name("score-settings.show");
// });




Route::group(['prefix' => 'tasks'], function () {
    Route::get('/list', function () {
        return view('tasks');
    })->name("tasks.show");

    Route::get('/task/{id}', function ($id) {
        return view('task');
    })->name("task.edit.show");
});

Route::group(['prefix' => 'workflows'], function () {
    Route::get('/list/', function () {
        return view('workflows');
    })->name("workflows.show");

    Route::get('/workflow/{id}', function ($id) {
        return view('workflow');
    })->name("workflow.edit.show");

    Route::get('/workflow-create', function ($id) {
        return view('workflow');
    })->name("workflow.create.show");
});
