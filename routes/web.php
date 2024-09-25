<?php

use App\Models\Page;
use App\Models\Review;
use App\Models\Slider;
use App\Models\PostCategory;
use App\Traits\AuthorizeAccess;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsLoopController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\BannerController;
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
use App\Http\Controllers\PageViewController;
use App\Http\Controllers\WorkTimeController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\CodePieceController;
use App\Http\Controllers\CustomizeController;
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

    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/search', [SearchController::class, 'search'])->name('api.search');

    // table of posts
    Route::group(['prefix' => 'post'], function () {
        Route::get('/', [PostController::class, 'index'])->name("post.index")->middleware('check.permission:manage_posts,read_own');
        Route::get('/create', [PostController::class, 'create'])->name("post.create")->middleware('check.permission:manage_posts,write_own');
        Route::post('/store', [PostController::class, 'store'])->name("post.store")->middleware('check.permission:manage_posts,write_own');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name("post.edit")->middleware('check.permission:manage_posts,write_own');
        Route::put('/update/{id}', [PostController::class, 'update'])->name("post.update")->middleware('check.permission:manage_posts,write_own');
        Route::post('/delete', [PostController::class, 'delete'])->name("post.delete")->middleware('check.permission:manage_posts,write_own');
    });


    // Post Categories Routes
    Route::group(['prefix' => 'postCategories'], function () {
        Route::get('/', [PostCategoriesController::class, 'index'])->name("postCategories.index")->middleware('check.permission:manage_categories,read_own');
        Route::get('/create', [PostCategoriesController::class, 'create'])->name("postCategories.create")->middleware('check.permission:manage_categories,write_own');
        Route::post('/store', [PostCategoriesController::class, 'store'])->name("postCategories.store")->middleware('check.permission:manage_categories,write_own');
        Route::get('/edit/{id}', [PostCategoriesController::class, 'edit'])->name("postCategories.edit")->middleware('check.permission:manage_categories,write_own');
        Route::put('/update/{id}', [PostCategoriesController::class, 'update'])->name("postCategories.update")->middleware('check.permission:manage_categories,write_own');
        Route::post('/delete', [PostCategoriesController::class, 'delete'])->name("postCategories.delete")->middleware('check.permission:manage_categories,write_own');
    });

    // Tag Routes
    Route::group(['prefix' => 'tags'], function () {
        Route::get('/', [TagController::class, 'index'])->name("tags.index")->middleware('check.permission:manage_tags,read_own');
        Route::get('/create', [TagController::class, 'create'])->name("tags.create")->middleware('check.permission:manage_tags,write_own');
        Route::post('/store', [TagController::class, 'store'])->name("tags.store")->middleware('check.permission:manage_tags,write_own');
        Route::get('/edit/{id}', [TagController::class, 'edit'])->name("tags.edit")->middleware('check.permission:manage_tags,write_own');
        Route::put('/update/{id}', [TagController::class, 'update'])->name("tags.update")->middleware('check.permission:manage_tags,write_own');
        Route::post('/delete', [TagController::class, 'delete'])->name("tags.delete")->middleware('check.permission:manage_tags,write_own');
        Route::post('/bulk_action', [TagController::class, 'bulkAction'])->name('tags.bulk_action')->middleware('check.permission:manage_tags,write_own');
    });

    // Comment Routes
    Route::group(['prefix' => 'comments'], function () {
        Route::get('/', [CommentController::class, 'index'])->name("comments.index")->middleware('check.permission:manage_comments,read_own');
        Route::get('/create', [CommentController::class, 'create'])->name("comments.create")->middleware('check.permission:manage_comments,write_own');
        Route::post('/store', [CommentController::class, 'store'])->name("comments.store")->middleware('check.permission:manage_comments,write_own');
        Route::get('/edit/{id}', [CommentController::class, 'edit'])->name("comments.edit")->middleware('check.permission:manage_comments,write_own');
        Route::put('/update/{id}', [CommentController::class, 'update'])->name("comments.update")->middleware('check.permission:manage_comments,write_own');
        Route::post('/delete', [CommentController::class, 'delete'])->name("comments.delete")->middleware('check.permission:manage_comments,write_own');
        Route::post('/bulk_action', [CommentController::class, 'bulk_action'])->name("comments.bulk_action")->middleware('check.permission:manage_comments,write_own');
        Route::post('/reply', [CommentController::class, 'reply'])->name("comments.reply")->middleware('check.permission:manage_comments,write_own'); // مسیر جدید برای پاسخ
        Route::get('/approve/{id}', [CommentController::class, 'approve'])->name('comments.approve')->middleware('check.permission:manage_comments,write_own');
        Route::get('/reject/{id}', [CommentController::class, 'reject'])->name('comments.reject')->middleware('check.permission:manage_comments,write_own');
    });

    // Page Routes
    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', [PageController::class, 'index'])->name("pages.index")->middleware('check.permission:manage_pages,read_own');
        Route::get('/create', [PageController::class, 'create'])->name("pages.create")->middleware('check.permission:manage_pages,write_own');
        Route::post('/store', [PageController::class, 'store'])->name("pages.store")->middleware('check.permission:manage_pages,write_own');
        Route::get('/edit/{id}', [PageController::class, 'edit'])->name("pages.edit")->middleware('check.permission:manage_pages,write_own');
        Route::put('/update/{id}', [PageController::class, 'update'])->name("pages.update")->middleware('check.permission:manage_pages,write_own');
        Route::post('/delete', [PageController::class, 'delete'])->name("pages.delete")->middleware('check.permission:manage_pages,write_own');
        Route::post('/bulk_action', [PageController::class, 'bulk_action'])->name("pages.bulk_action")->middleware('check.permission:manage_pages,write_own');
    });

    // Product Categories Routes
    Route::group(['prefix' => 'products/categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index')->middleware('check.permission:manage_product_categories,read_own');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('check.permission:manage_product_categories,write_own');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store')->middleware('check.permission:manage_product_categories,write_own');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('check.permission:manage_product_categories,write_own');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('categories.update')->middleware('check.permission:manage_product_categories,write_own');
        Route::post('/delete', [CategoryController::class, 'delete'])->name('categories.delete')->middleware('check.permission:manage_product_categories,write_own');
        Route::post('/bulk_action', [CategoryController::class, 'bulk_action'])->name('categories.bulk_action')->middleware('check.permission:manage_product_categories,write_own');
    });

    // Product Tags Routes
    Route::group(['prefix' => 'products/tags'], function () {
        Route::get('/', [ProductTagController::class, 'index'])->name("products.tags.index")->middleware('check.permission:manage_product_tags,read_own');
        Route::get('/create', [ProductTagController::class, 'create'])->name("products.tags.create")->middleware('check.permission:manage_product_tags,write_own');
        Route::post('/store', [ProductTagController::class, 'store'])->name("products.tags.store")->middleware('check.permission:manage_product_tags,write_own');
        Route::get('/edit/{id}', [ProductTagController::class, 'edit'])->name("products.tags.edit")->middleware('check.permission:manage_product_tags,write_own');
        Route::put('/update/{id}', [ProductTagController::class, 'update'])->name("products.tags.update")->middleware('check.permission:manage_product_tags,write_own');
        Route::post('/delete', [ProductTagController::class, 'delete'])->name("products.tags.delete")->middleware('check.permission:manage_product_tags,write_own');
        Route::post('/bulk_action', [ProductTagController::class, 'bulk_action'])->name("products.tags.bulk_action")->middleware('check.permission:manage_product_tags,write_own');
    });

    // Product Reviews Routes
    Route::group(['prefix' => 'products/reviews'], function () {
        Route::get('/', [ReviewController::class, 'index'])->name("products.reviews.index")->middleware('check.permission:manage_reviews,read_own');
        Route::get('/create', [ReviewController::class, 'create'])->name("products.reviews.create")->middleware('check.permission:manage_reviews,write_own');
        Route::post('/store', [ReviewController::class, 'store'])->name("products.reviews.store")->middleware('check.permission:manage_reviews,write_own');
        Route::get('/edit/{id}', [ReviewController::class, 'edit'])->name("products.reviews.edit")->middleware('check.permission:manage_reviews,write_own');
        Route::put('/update/{id}', [ReviewController::class, 'update'])->name("products.reviews.update")->middleware('check.permission:manage_reviews,write_own');
        Route::post('/delete', [ReviewController::class, 'delete'])->name("products.reviews.delete")->middleware('check.permission:manage_reviews,write_own');
        Route::post('/bulk_action', [ReviewController::class, 'bulk_action'])->name("products.reviews.bulk_action")->middleware('check.permission:manage_reviews,write_own');
    });

    // Product Attributes Routes
    Route::group(['prefix' => 'products/attributes'], function () {
        Route::get('/', [AttributeController::class, 'index'])->name("attributes.index")->middleware('check.permission:manage_attributes,read_own');
        Route::get('/create', [AttributeController::class, 'create'])->name("attributes.create")->middleware('check.permission:manage_attributes,write_own');
        Route::post('/store', [AttributeController::class, 'store'])->name("attributes.store")->middleware('check.permission:manage_attributes,write_own');
        Route::get('/edit/{id}', [AttributeController::class, 'edit'])->name("attributes.edit")->middleware('check.permission:manage_attributes,write_own');
        Route::put('/update/{id}', [AttributeController::class, 'update'])->name("attributes.update")->middleware('check.permission:manage_attributes,write_own');
        Route::post('/delete', [AttributeController::class, 'delete'])->name("attributes.delete")->middleware('check.permission:manage_attributes,write_own');
        Route::get('/attribute-options/{attributeId}', [AttributeController::class, 'getOptions'])->middleware('check.permission:manage_attributes,read_own');
    });

    // Product Attributes Properties Routes
    Route::group(['prefix' => 'products/attributesProperties'], function () {
        Route::get('/create/{id}', [AttributeItemController::class, 'create'])->name("attribute.properties.create")->middleware('check.permission:manage_attributes,write_own');
        Route::post('/store', [AttributeItemController::class, 'store'])->name("attribute.properties.store")->middleware('check.permission:manage_attributes,write_own');
        Route::get('/edit/{id}', [AttributeItemController::class, 'edit'])->name("attribute.properties.edit")->middleware('check.permission:manage_attributes,write_own');
        Route::put('/update/{id}', [AttributeItemController::class, 'update'])->name("attribute.properties.update")->middleware('check.permission:manage_attributes,write_own');
        Route::post('/delete', [AttributeItemController::class, 'delete'])->name("attribute.properties.delete")->middleware('check.permission:manage_attributes,write_own');
    });

    // Product Routes
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductController::class, 'index'])->name("products.index")->middleware('check.permission:manage_products,read_own');
        Route::get('/create', [ProductController::class, 'create'])->name("products.create")->middleware('check.permission:manage_products,write_own');
        Route::post('/store', [ProductController::class, 'store'])->name("products.store")->middleware('check.permission:manage_products,write_own');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name("products.edit")->middleware('check.permission:manage_products,write_own');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name("products.update")->middleware('check.permission:manage_products,write_own');
        Route::post('/delete', [ProductController::class, 'delete'])->name("products.delete")->middleware('check.permission:manage_products,write_own');
        Route::post('/bulk_action', [ProductController::class, 'bulk_action'])->name("products.bulk_action")->middleware('check.permission:manage_products,write_own');
        Route::post('/update-attributes', [ProductController::class, 'updateAttributes'])->middleware('check.permission:manage_products,write_own');
        Route::get('/settings', [ProductController::class, 'settings'])->name("products.settings")->middleware('check.permission:manage_products,read_own');
        Route::get('/{id}/delete-all-images', [ProductController::class, 'deleteAllImages'])->name('products.delete.images')->middleware('check.permission:manage_products,write_own');
        Route::get('/products/{id}/delete-thumbnail', [ProductController::class, 'deleteThumbnail'])->name('products.delete.thumbnail')->middleware('check.permission:manage_products,write_own');
    });

    // Installment Routes
    Route::group(['prefix' => 'installments'], function () {
        Route::get('/list', [InstallmentController::class, 'installment'])->name("installments")->middleware('check.permission:manage_installments,read_own');
        Route::get('/', [InstallmentController::class, 'index'])->name("installments.index")->middleware('check.permission:manage_installments,read_own');
        Route::get('/create', [InstallmentController::class, 'create'])->name("installments.create")->middleware('check.permission:manage_installments,write_own');
        Route::post('/store', [InstallmentController::class, 'store'])->name("installments.store")->middleware('check.permission:manage_installments,write_own');
        Route::get('/edit/{id}', [InstallmentController::class, 'edit'])->name("installments.edit")->middleware('check.permission:manage_installments,write_own');
        Route::put('/update/{id}', [InstallmentController::class, 'update'])->name("installments.update")->middleware('check.permission:manage_installments,write_own');
        Route::post('/delete', [InstallmentController::class, 'delete'])->name("installments.delete")->middleware('check.permission:manage_installments,write_own');
        Route::post('/bulk_action', [InstallmentController::class, 'bulk_action'])->name("installments.bulk_action")->middleware('check.permission:manage_installments,write_own');
        Route::get('/plans/list', [InstallmentController::class, 'list'])->name("installments.plans.index.show")->middleware('check.permission:manage_installments,read_own');
        Route::get('/report', [InstallmentController::class, 'report'])->name("installments.report.show")->middleware('check.permission:manage_installments,read_own');
    });

    // Credit Routes
    Route::group(['prefix' => 'credits'], function () {
        Route::get('/', [CreditController::class, 'index'])->name("credits.show")->middleware('check.permission:manage_credits,read_own');
        Route::get('/create', [CreditController::class, 'create'])->name("credits.create")->middleware('check.permission:manage_credits,write_own');
        Route::post('/store', [CreditController::class, 'store'])->name("credits.store")->middleware('check.permission:manage_credits,write_own');
        Route::get('/edit/{id}', [CreditController::class, 'edit'])->name("credits.edit")->middleware('check.permission:manage_credits,write_own');
        Route::put('/update/{id}', [CreditController::class, 'update'])->name("credits.update")->middleware('check.permission:manage_credits,write_own');
        Route::post('/delete', [CreditController::class, 'delete'])->name("credits.delete")->middleware('check.permission:manage_credits,write_own');
        Route::post('/bulk_action', [CreditController::class, 'bulk_action'])->name("credits.bulk_action")->middleware('check.permission:manage_credits,write_own');
    });

    // Route::group(['prefix' => 'installments'], function () {
    //     Route::get('/list', function () {
    //         return view('installments');
    //     })->name("installments.index.show");

    //     Route::get('/edit/{id}', function ($id) {
    //         return view('installment');
    //     })->name("installment.show");

    //     Route::get('/create', function () {
    //         return view('installment');
    //     })->name("installment.create.show");

    //     Route::get('/plans/list', function () {
    //         return view('installments-plans');
    //     })->name("installments.plans.index.show");

    //     Route::get('/plans/edit/{id}', function ($id) {
    //         return view('installments-plan');
    //     })->name("installments.plan.show");

    //     Route::get('/report', function () {
    //         return view('installments-report');
    //     })->name("installments.report.show");

    // });


    // Users Routes
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name("users.index")->middleware('check.permission:manage_users,read_own');
        Route::get('/create', [UserController::class, 'create'])->name("users.create")->middleware('check.permission:manage_users,write_own');
        Route::post('/store', [UserController::class, 'store'])->name("users.store")->middleware('check.permission:manage_users,write_own');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name("users.edit")->middleware('check.permission:manage_users,write_own');
        Route::get('/profile/{id}', [UserController::class, 'profile'])->name("users.profile")->middleware('check.permission:manage_users,read_own');
        Route::get('/profile/sessions/{id}', [UserController::class, 'sessions'])->name("users.sessions.index")->middleware('check.permission:manage_users,read_own');
        Route::post('/profile/sessions/{id}', [UserController::class, 'sessions'])->name("user.sessions.save")->middleware('check.permission:manage_users,write_own');
        Route::put('/update/{id}', [UserController::class, 'update'])->name("users.update")->middleware('check.permission:manage_users,write_own');
        Route::post('/delete', [UserController::class, 'delete'])->name("users.delete")->middleware('check.permission:manage_users,write_own');
        Route::post('/bulk_action', [UserController::class, 'bulk_action'])->name("users.bulk_action")->middleware('check.permission:manage_users,write_own');
        Route::get('/roles', [UserController::class, 'roles'])->name("users.roles.index")->middleware('check.permission:manage_roles,read_own');
        Route::get('/roles/create', [UserController::class, 'rolesCreate'])->name("users.roles.create")->middleware('check.permission:manage_roles,write_own');
        Route::post('/roles/store', [UserController::class, 'rolesStore'])->name("users.roles.store")->middleware('check.permission:manage_roles,write_own');
        Route::get('/roles/edit/{id}', [UserController::class, 'rolesEdit'])->name("users.roles.edit")->middleware('check.permission:manage_roles,write_own');
        Route::put('/roles/{id}', [UserController::class, 'rolesUpdate'])->name("users.roles.update")->middleware('check.permission:manage_roles,write_own');
        Route::get('/roles/{id}', [UserController::class, 'rolesDelete'])->name("users.roles.delete")->middleware('check.permission:manage_roles,write_own');
        Route::post('/roles/bulk_action', [UserController::class, 'rolesBulk_action'])->name("users.roles.bulk_action")->middleware('check.permission:manage_roles,write_own');
    });


    // Route::group(['prefix' => 'users'], function () {
    //     Route::get('/', function () {
    //         return view('users');
    //     })->name("users.index");

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


// Menus Routes
Route::group(['prefix' => 'menus'], function () {
    Route::get('/', [MenuController::class, 'index'])->name("menus.index")->middleware('check.permission:manage_menus,read_own');
    Route::get('/create', [MenuController::class, 'create'])->name("menus.create")->middleware('check.permission:manage_menus,write_own');
    Route::post('/store', [MenuController::class, 'store'])->name("menus.store")->middleware('check.permission:manage_menus,write_own');
    Route::get('/edit/{id}', [MenuController::class, 'edit'])->name("menus.edit")->middleware('check.permission:manage_menus,write_own');
    Route::put('/update/{id}', [MenuController::class, 'update'])->name("menus.update")->middleware('check.permission:manage_menus,write_own');
    Route::post('/delete', [MenuController::class, 'delete'])->name("menus.delete")->middleware('check.permission:manage_menus,write_own');
    Route::post('/bulk_action', [MenuController::class, 'bulk_action'])->name("menus.bulk_action")->middleware('check.permission:manage_menus,write_own');
});

// Blocks Routes
Route::group(['prefix' => 'blocks'], function () {
    Route::get('/', [BlockController::class, 'index'])->name("blocks.index")->middleware('check.permission:manage_blocks,read_own');
    Route::get('/create', [BlockController::class, 'create'])->name("blocks.create")->middleware('check.permission:manage_blocks,write_own');
    Route::post('/store', [BlockController::class, 'store'])->name("blocks.store")->middleware('check.permission:manage_blocks,write_own');
    Route::get('/edit/{id}', [BlockController::class, 'edit'])->name("blocks.edit")->middleware('check.permission:manage_blocks,write_own');
    Route::put('/update/{id}', [BlockController::class, 'update'])->name("blocks.update")->middleware('check.permission:manage_blocks,write_own');
    Route::get('/delete/{id}', [BlockController::class, 'delete'])->name("blocks.delete")->middleware('check.permission:manage_blocks,write_own');
    Route::post('/bulk_action', [BlockController::class, 'bulk_action'])->name("blocks.bulk_action")->middleware('check.permission:manage_blocks,write_own');
});

// Transports Routes
Route::group(['prefix' => 'transports'], function () {
    Route::get('/', [TransportController::class, 'index'])->name("transports.index")->middleware('check.permission:manage_transports,read_own');
    Route::get('/create', [TransportController::class, 'create'])->name("transports.create")->middleware('check.permission:manage_transports,write_own');
    Route::post('/store', [TransportController::class, 'store'])->name("transports.store")->middleware('check.permission:manage_transports,write_own');
    Route::get('/edit/{id}', [TransportController::class, 'edit'])->name("transports.edit")->middleware('check.permission:manage_transports,write_own');
    Route::put('/update/{id}', [TransportController::class, 'update'])->name("transports.update")->middleware('check.permission:manage_transports,write_own');
    Route::post('/delete', [TransportController::class, 'delete'])->name("transports.delete")->middleware('check.permission:manage_transports,write_own');
    Route::post('/bulk_action', [TransportController::class, 'bulk_action'])->name("transports.bulk_action")->middleware('check.permission:manage_transports,write_own');
});

// Sessions Routes
Route::group(['prefix' => 'sessions'], function () {
    Route::get('/', [SessionController::class, 'index'])->name("sessions.index")->middleware('check.permission:manage_sessions,read_own');
    Route::get('/create', [SessionController::class, 'create'])->name("sessions.create")->middleware('check.permission:manage_sessions,write_own');
    Route::post('/store', [SessionController::class, 'store'])->name("sessions.store")->middleware('check.permission:manage_sessions,write_own');
    Route::get('/edit/{id}', [SessionController::class, 'edit'])->name("sessions.edit")->middleware('check.permission:manage_sessions,write_own');
    Route::put('/update/{id}', [SessionController::class, 'update'])->name("sessions.update")->middleware('check.permission:manage_sessions,write_own');
    Route::post('/delete', [SessionController::class, 'delete'])->name("sessions.delete")->middleware('check.permission:manage_sessions,write_own');
    Route::post('/bulk_action', [SessionController::class, 'bulk_action'])->name("sessions.bulk_action")->middleware('check.permission:manage_sessions,write_own');
    Route::post('/sessions/store', [SessionController::class, 'store'])->name('sessions.store')->middleware('check.permission:manage_sessions,write_own');
    Route::post('notifications', [SessionController::class,'save'])->name('dashboard.messages.save')->middleware('check.permission:manage_sessions,write_own');
});

// Checks Routes
Route::group(['prefix' => 'checks'], function () {
    Route::get('/', [CheckController::class, 'index'])->name("checks.index")->middleware('check.permission:manage_checks,read_own');
    Route::get('/create', [CheckController::class, 'create'])->name("checks.create")->middleware('check.permission:manage_checks,write_own');
    Route::post('/store', [CheckController::class, 'store'])->name("checks.store")->middleware('check.permission:manage_checks,write_own');
    Route::get('/edit/{id}', [CheckController::class, 'edit'])->name("checks.edit")->middleware('check.permission:manage_checks,write_own');
    Route::put('/update/{id}', [CheckController::class, 'update'])->name("checks.update")->middleware('check.permission:manage_checks,write_own');
    Route::post('/delete', [CheckController::class, 'delete'])->name("checks.delete")->middleware('check.permission:manage_checks,write_own');
    Route::post('/bulk_action', [CheckController::class, 'bulk_action'])->name("checks.bulk_action")->middleware('check.permission:manage_checks,write_own');
});

// Discounts Routes
Route::group(['prefix' => 'discounts'], function () {
    Route::get('/', [DiscountController::class, 'index'])->name("discounts.index")->middleware('check.permission:manage_discounts,read_own');
    Route::get('/create', [DiscountController::class, 'create'])->name("discounts.create")->middleware('check.permission:manage_discounts,write_own');
    Route::post('/store', [DiscountController::class, 'store'])->name("discounts.store")->middleware('check.permission:manage_discounts,write_own');
    Route::get('/edit/{id}', [DiscountController::class, 'edit'])->name("discounts.edit")->middleware('check.permission:manage_discounts,write_own');
    Route::put('/update/{id}', [DiscountController::class, 'update'])->name("discounts.update")->middleware('check.permission:manage_discounts,write_own');
    Route::post('/delete', [DiscountController::class, 'delete'])->name("discounts.delete")->middleware('check.permission:manage_discounts,write_own');
    Route::post('/bulk_action', [DiscountController::class, 'bulk_action'])->name("discounts.bulk_action")->middleware('check.permission:manage_discounts,write_own');
});

// Gateways Routes
Route::group(['prefix' => 'gateways'], function () {
    Route::get('/', [GatewayController::class, 'index'])->name("gateways.index")->middleware('check.permission:manage_gateways,read_own');
    Route::get('/create', [GatewayController::class, 'create'])->name("gateways.create")->middleware('check.permission:manage_gateways,write_own');
    Route::post('/store', [GatewayController::class, 'store'])->name("gateways.store")->middleware('check.permission:manage_gateways,write_own');
    Route::get('/edit/{id}', [GatewayController::class, 'edit'])->name("gateways.edit")->middleware('check.permission:manage_gateways,write_own');
    Route::put('/update/{id}', [GatewayController::class, 'update'])->name("gateways.update")->middleware('check.permission:manage_gateways,write_own');
    Route::get('/gateways/{id}/activate', [GatewayController::class, 'activate'])->name('gateways.activate')->middleware('check.permission:manage_gateways,write_own');
    Route::get('/delete/{id}', [GatewayController::class, 'delete'])->name("gateways.delete")->middleware('check.permission:manage_gateways,write_own');
    Route::post('/bulk_action', [GatewayController::class, 'bulk_action'])->name("gateways.bulk_action")->middleware('check.permission:manage_gateways,write_own');
});

// Carts Routes
Route::group(['prefix' => 'carts'], function () {
    Route::get('/', [CartController::class, 'index'])->name("carts.index")->middleware('check.permission:manage_carts,read_own');
    Route::get('/create', [CartController::class, 'create'])->name("carts.create")->middleware('check.permission:manage_carts,write_own');
    Route::post('/store', [CartController::class, 'store'])->name("carts.store")->middleware('check.permission:manage_carts,write_own');
    Route::get('/edit/{id}', [CartController::class, 'edit'])->name("carts.edit")->middleware('check.permission:manage_carts,write_own');
    Route::put('/update/{id}', [CartController::class, 'update'])->name("carts.update")->middleware('check.permission:manage_carts,write_own');
    Route::post('/delete/{id}', [CartController::class, 'delete'])->name("carts.delete")->middleware('check.permission:manage_carts,write_own');
    Route::post('/bulk_action', [CartController::class, 'bulk_action'])->name("carts.bulk_action")->middleware('check.permission:manage_carts,write_own');
});

// Orders Routes
Route::group(['prefix' => 'orders'], function () {
    Route::get('/', [OrderController::class, 'index'])->name("orders.index")->middleware('check.permission:manage_orders,read_own');
    Route::get('/create', [OrderController::class, 'create'])->name("orders.create")->middleware('check.permission:manage_orders,write_own');
    Route::post('/store', [OrderController::class, 'store'])->name("orders.store")->middleware('check.permission:manage_orders,write_own');
    Route::get('/edit/{id}', [OrderController::class, 'edit'])->name("orders.edit")->middleware('check.permission:manage_orders,write_own');
    Route::put('/update/{id}', [OrderController::class, 'update'])->name("orders.update")->middleware('check.permission:manage_orders,write_own');
    Route::post('/delete', [OrderController::class, 'delete'])->name("orders.delete")->middleware('check.permission:manage_orders,write_own');
    Route::post('/bulk_action', [OrderController::class, 'bulk_action'])->name("orders.bulk_action")->middleware('check.permission:manage_orders,write_own');
    Route::get('/print/{id}', [OrderController::class, 'print'])->name("orders.print")->middleware('check.permission:manage_orders,read_own');
    Route::put('/{order}/update-billing', [OrderController::class, 'updateBilling'])->name('orders.updateBilling')->middleware('check.permission:manage_orders,write_own');
    Route::put('/{order}/update-shipping', [OrderController::class, 'updateShipping'])->name('orders.updateShipping')->middleware('check.permission:manage_orders,write_own');
    Route::put('/{order}/update-shipping-note', [OrderController::class, 'updateShippingNote'])->name('orders.updateShippingNote')->middleware('check.permission:manage_orders,write_own');
    Route::post('/{order}/add-product', [OrderController::class, 'addProduct'])->name('orders.addProduct')->middleware('check.permission:manage_orders,write_own');
    Route::post('/product-details/{id}/update', [OrderController::class, 'updateProductDetails'])->name('updateProductDetails')->middleware('check.permission:manage_orders,write_own');
});

// Sliders Routes
Route::group(['prefix' => 'sliders'], function () {
    Route::get('/', [SliderController::class, 'index'])->name("sliders.index")->middleware('check.permission:manage_sliders,read_own');
    Route::get('/create', [SliderController::class, 'create'])->name("sliders.create")->middleware('check.permission:manage_sliders,write_own');
    Route::post('/store', [SliderController::class, 'store'])->name("sliders.store")->middleware('check.permission:manage_sliders,write_own');
    Route::get('/edit/{id}', [SliderController::class, 'edit'])->name("sliders.edit")->middleware('check.permission:manage_sliders,write_own');
    Route::put('/update/{id}', [SliderController::class, 'update'])->name("sliders.update")->middleware('check.permission:manage_sliders,write_own');
    Route::get('/delete/{id}', [SliderController::class, 'delete'])->name("sliders.delete")->middleware('check.permission:manage_sliders,write_own');
    Route::post('/bulk_action', [SliderController::class, 'bulk_action'])->name("sliders.bulk_action")->middleware('check.permission:manage_sliders,write_own');
    Route::get('/add/{id}', [SliderController::class, 'slideView'])->name("sliders.view")->middleware('check.permission:manage_sliders,write_own');
    Route::put('/add/{id}', [SliderController::class, 'addImage'])->name("sliders.add")->middleware('check.permission:manage_sliders,write_own');
    Route::get('/{image_id}/delete', [SliderController::class, 'deleteImage'])->name('sliders.deleteImage')->middleware('check.permission:manage_sliders,write_own');

});

// Banners Routes
Route::group(['prefix' => 'banners'], function () {
    Route::get('/', [BannerController::class, 'index'])->name("banners.index")->middleware('check.permission:manage_banners,read_own');
    Route::get('/create', [BannerController::class, 'create'])->name("banners.create")->middleware('check.permission:manage_banners,write_own');
    Route::post('/store', [BannerController::class, 'store'])->name("banners.store")->middleware('check.permission:manage_banners,write_own');
    Route::get('/edit/{id}', [BannerController::class, 'edit'])->name("banners.edit")->middleware('check.permission:manage_banners,write_own');
    Route::put('/update/{id}', [BannerController::class, 'update'])->name("banners.update")->middleware('check.permission:manage_banners,write_own');
    Route::get('/delete/{id}', [BannerController::class, 'delete'])->name("banners.delete")->middleware('check.permission:manage_banners,write_own');
    Route::post('/bulk_action', [BannerController::class, 'bulk_action'])->name("banners.bulk_action")->middleware('check.permission:manage_banners,write_own');
    Route::get('/add/{id}', [BannerController::class, 'slideView'])->name("banners.view")->middleware('check.permission:manage_banners,write_own');
    Route::put('/add/{id}', [BannerController::class, 'addImage'])->name("banners.add")->middleware('check.permission:manage_banners,write_own');
    Route::get('/{image_id}/delete', [BannerController::class, 'deleteImage'])->name('banners.deleteImage')->middleware('check.permission:manage_banners,write_own');

});


// Settings Routes
Route::group(['prefix' => 'settings'], function () {
    Route::get('/create', [SettingController::class, 'create'])->name("settings.create")->middleware('check.permission:manage_settings,write_own');
    Route::post('/store', [SettingController::class, 'store'])->name("settings.store")->middleware('check.permission:manage_settings,write_own');
    Route::get('/{group}', [SettingController::class, 'edit'])->name("settings.edit")->middleware('check.permission:manage_settings,write_own');
    Route::post('/update/{group}', [SettingController::class, 'update'])->name("settings.update")->middleware('check.permission:manage_settings,write_own');
    Route::post('/delete', [SettingController::class, 'delete'])->name("settings.delete")->middleware('check.permission:manage_settings,write_own');
    Route::post('/bulk_action', [SettingController::class, 'bulk_action'])->name("settings.bulk_action")->middleware('check.permission:manage_settings,write_own');
});

// Services Routes
Route::group(['prefix' => 'services'], function () {
    Route::get('/create', [SettingController::class, 'create'])->name("services.create")->middleware('check.permission:manage_services,write_own');
    Route::post('/store', [SettingController::class, 'store'])->name("services.store")->middleware('check.permission:manage_services,write_own');
    Route::get('/holo', [HoloSettingController::class, 'edit'])->name('settings.holo.edit')->middleware('check.permission:manage_services,write_own');
    Route::post('/holo', [HoloSettingController::class, 'update'])->name('settings.holo.update')->middleware('check.permission:manage_services,write_own');
    Route::get('/sms', [SettingController::class, 'editSms'])->name("services.sms.edit")->middleware('check.permission:manage_services,write_own');
    Route::post('/update/sms', [SettingController::class, 'updateSms'])->name("services.update.sms")->middleware('check.permission:manage_services,write_own');
    Route::put('/update/sms', [SettingController::class, 'storeSms'])->name("services.store.sms")->middleware('check.permission:manage_services,write_own');
    Route::post('/delete', [SettingController::class, 'delete'])->name("services.delete")->middleware('check.permission:manage_services,write_own');
    Route::post('/bulk_action', [SettingController::class, 'bulk_action'])->name("services.bulk_action")->middleware('check.permission:manage_services,write_own');
});

// Code Pieces Routes
Route::group(['prefix' => 'code-piceces'], function () {
    Route::get('/', [CodePieceController::class, 'index'])->name("code-piceces.index")->middleware('check.permission:manage_code_pieces,read_own');
    Route::get('/create', [CodePieceController::class, 'create'])->name("code-piceces.create")->middleware('check.permission:manage_code_pieces,write_own');
    Route::post('/store', [CodePieceController::class, 'store'])->name("code-piceces.store")->middleware('check.permission:manage_code_pieces,write_own');
    Route::get('/edit/{id}', [CodePieceController::class, 'edit'])->name("code-piceces.edit")->middleware('check.permission:manage_code_pieces,write_own');
    Route::put('/update/{id}', [CodePieceController::class, 'update'])->name("code-piceces.update")->middleware('check.permission:manage_code_pieces,write_own');
    Route::post('/delete', [CodePieceController::class, 'delete'])->name("code-piceces.delete")->middleware('check.permission:manage_code_pieces,write_own');
    Route::post('/bulk_action', [CodePieceController::class, 'bulk_action'])->name("code-piceces.bulk_action")->middleware('check.permission:manage_code_pieces,write_own');
});

// Image Markers Routes
Route::group(['prefix' => 'image-markers'], function () {
    Route::get('/', [ImageMarkerController::class, 'index'])->name('image-markers.index')->middleware('check.permission:manage_image_markers,read_own');
    Route::get('/create', [ImageMarkerController::class, 'create'])->name('image-markers.create')->middleware('check.permission:manage_image_markers,write_own');
    Route::post('/store', [ImageMarkerController::class, 'store'])->name('image-markers.store')->middleware('check.permission:manage_image_markers,write_own');
    Route::get('/edit/{id}', [ImageMarkerController::class, 'edit'])->name('image-markers.edit')->middleware('check.permission:manage_image_markers,write_own');
    Route::put('/update/{id}', [ImageMarkerController::class, 'update'])->name('image-markers.update')->middleware('check.permission:manage_image_markers,write_own');
    Route::post('/delete', [ImageMarkerController::class, 'delete'])->name('image-markers.delete')->middleware('check.permission:manage_image_markers,write_own');
    Route::post('/bulk_action', [ImageMarkerController::class, 'bulk_action'])->name('image-markers.bulk_action')->middleware('check.permission:manage_image_markers,write_own');
    Route::get('/checkproduct/{id}', [ImageMarkerController::class, 'checkProduct'])->name('image-markers.checkProduct')->middleware('check.permission:manage_image_markers,read_own');
    Route::get('/imgdot/{id}', [ImageMarkerController::class, 'imgdot'])->name('image-markers.imgdot')->middleware('check.permission:manage_image_markers,read_own');
});

// Worktimes Routes
Route::group(['prefix' => 'worktimes'], function () {
    Route::get('/', [WorktimeController::class, 'index'])->name('worktimes.index')->middleware('check.permission:manage_worktimes,read_own');
    Route::get('/create', [WorktimeController::class, 'create'])->name('worktimes.create')->middleware('check.permission:manage_worktimes,write_own');
    Route::post('/store', [WorktimeController::class, 'store'])->name('worktimes.store')->middleware('check.permission:manage_worktimes,write_own');
    Route::get('/edit/{id}', [WorktimeController::class, 'edit'])->name('worktimes.edit')->middleware('check.permission:manage_worktimes,write_own');
    Route::put('/update/{id}', [WorktimeController::class, 'update'])->name('worktimes.update')->middleware('check.permission:manage_worktimes,write_own');
    Route::delete('/{worktime}', [WorktimeController::class, 'destroy'])->name('worktimes.destroy')->middleware('check.permission:manage_worktimes,write_own');
});

// Files Manager Route
Route::get('/files-manager', function () {
    return view('files');
})->name('files-manager')->middleware('check.permission:manage_files,read_own');

// Settlement Documents Routes
Route::group(['prefix' => 'settlement_documents'], function () {
    Route::get('/', [SettlementDocumentController::class, 'index'])->name('settlement_documents.index')->middleware('check.permission:manage_settlement_documents,read_own');
    Route::get('/create', [SettlementDocumentController::class, 'create'])->name('settlement_documents.create')->middleware('check.permission:manage_settlement_documents,write_own');
    Route::post('/store', [SettlementDocumentController::class, 'store'])->name('settlement_documents.store')->middleware('check.permission:manage_settlement_documents,write_own');
    Route::get('/edit/{id}', [SettlementDocumentController::class, 'edit'])->name('settlement_documents.edit')->middleware('check.permission:manage_settlement_documents,write_own');
    Route::put('/update/{id}', [SettlementDocumentController::class, 'update'])->name('settlement_documents.update')->middleware('check.permission:manage_settlement_documents,write_own');
    Route::post('/delete', [SettlementDocumentController::class, 'delete'])->name('settlement_documents.delete')->middleware('check.permission:manage_settlement_documents,write_own');
    Route::post('/bulk-delete', [SettlementDocumentController::class, 'bulkDelete'])->name('settlement_documents.bulk_delete')->middleware('check.permission:manage_settlement_documents,write_own');
});

// Groups Routes
Route::group(['prefix' => 'groups'], function () {
    Route::get('/', [GroupController::class, 'index'])->name('groups.index')->middleware('check.permission:manage_groups,read_own');
    Route::get('/create', [GroupController::class, 'create'])->name('groups.create')->middleware('check.permission:manage_groups,write_own');
    Route::post('/store', [GroupController::class, 'store'])->name('groups.store')->middleware('check.permission:manage_groups,write_own');
    Route::get('/{group}/edit', [GroupController::class, 'edit'])->name('groups.edit')->middleware('check.permission:manage_groups,write_own');
    Route::put('/{group}', [GroupController::class, 'update'])->name('groups.update')->middleware('check.permission:manage_groups,write_own');
    Route::delete('/{group}', [GroupController::class, 'destroy'])->name('groups.destroy')->middleware('check.permission:manage_groups,write_own');
    Route::post('/bulk_action', [GroupController::class, 'bulk_action'])->name('groups.bulk_action')->middleware('check.permission:manage_groups,write_own');
});

// Score Groups Routes
Route::group(['prefix' => 'score-groups'], function () {
    Route::get('/', [ScoreGroupController::class, 'index'])->name('score-groups.index')->middleware('check.permission:manage_score_groups,read_own');
    Route::get('/create', [ScoreGroupController::class, 'create'])->name('score-groups.create')->middleware('check.permission:manage_score_groups,write_own');
    Route::post('/store', [ScoreGroupController::class, 'store'])->name('score-groups.store')->middleware('check.permission:manage_score_groups,write_own');
    Route::get('/edit/{id}', [ScoreGroupController::class, 'edit'])->name('score-groups.edit')->middleware('check.permission:manage_score_groups,write_own');
    Route::put('/update/{id}', [ScoreGroupController::class, 'update'])->name('score-groups.update')->middleware('check.permission:manage_score_groups,write_own');
    Route::delete('/{id}', [ScoreGroupController::class, 'destroy'])->name('score-groups.destroy')->middleware('check.permission:manage_score_groups,write_own');
    Route::post('/bulk_action', [ScoreGroupController::class, 'bulk_action'])->name('score-groups.bulk_action')->middleware('check.permission:manage_score_groups,write_own');
    Route::get('/setting', [ScoreGroupController::class, 'setting'])->name('score-groups.setting')->middleware('check.permission:manage_score_groups,read_own');
    Route::post('/setting/edit', [ScoreGroupController::class, 'editSetting'])->name('score-groups.setting.edit')->middleware('check.permission:manage_score_groups,write_own');
});

// SMS Routes
Route::group(['prefix' => 'sms'], function () {
    Route::get('/', [SmsController::class, 'index'])->name('sms.index')->middleware('check.permission:manage_sms,read_own');
    Route::get('/create', [SmsController::class, 'create'])->name('sms.create')->middleware('check.permission:manage_sms,write_own');
    Route::post('/store', [SmsController::class, 'store'])->name('sms.store')->middleware('check.permission:manage_sms,write_own');
    Route::get('/edit/{id}', [SmsController::class, 'edit'])->name('sms.edit')->middleware('check.permission:manage_sms,write_own');
    Route::put('/update/{id}', [SmsController::class, 'update'])->name('sms.update')->middleware('check.permission:manage_sms,write_own');
    Route::post('/delete', [SmsController::class, 'delete'])->name('sms.delete')->middleware('check.permission:manage_sms,write_own');
    Route::post('/bulk_action', [SmsController::class, 'bulk_action'])->name('sms.bulk_action')->middleware('check.permission:manage_sms,write_own');
});

// Track Page View Routes
Route::group(['prefix' => 'track-page-view'], function () {
    Route::post('/', [PageViewController::class, 'trackPageView'])->name('trackPageView')->middleware('check.permission:manage_page_views,write_own');
    Route::get('/', [PageViewController::class, 'getDailyPageViews'])->name('getDailyPageViews')->middleware('check.permission:manage_page_views,read_own');
    Route::get('/hourly-page-views/{date}', [PageViewController::class, 'getHourlyPageViews'])->name('getHourlyPageViews')->middleware('check.permission:manage_page_views,read_own');
});

Route::group(['prefix' => 'themes'], function () {
    Route::get('/', [ThemeController::class, 'index'])->name('theme.index')->middleware('check.permission:manage_themes,read_own');
});


Route::group(['prefix' => 'customizes'], function () {

    Route::get('/', [CustomizeController::class, 'index'])->name("customizes.index")->middleware('check.permission:manage_site_customizes,read_own');

    Route::get('/create', [CustomizeController::class, 'create'])->name("customizes.create")->middleware('check.permission:manage_site_customizes,write_own');
    Route::post('/store', [CustomizeController::class, 'store'])->name("customizes.store")->middleware('check.permission:manage_site_customizes,write_own');


    Route::get('/edit', [CustomizeController::class, 'edit'])->name("customizes.edit")->middleware('check.permission:manage_site_customizes,write_own');
    Route::put('/update', [CustomizeController::class, 'update'])->name("customizes.update")->middleware('check.permission:manage_site_customizes,write_own');

    Route::post('/delete', [CustomizeController::class, 'delete'])->name("customizes.delete")->middleware('check.permission:manage_site_customizes,write_own');

    Route::post('/bulk_action', [CustomizeController::class, 'bulk_action'])->name("customizes.bulk_action")->middleware('check.permission:manage_site_customizes,write_own');
    Route::get('/reset', [CustomizeController::class, 'reset'])->name("customizes.reset")->middleware('check.permission:manage_site_customizes,write_own');
});

Route::group(['prefix' => 'products-loop'], function () {

    Route::get('/', [ProductsLoopController::class, 'index'])->name("products-loop.index");

    Route::get('/create', [ProductsLoopController::class, 'create'])->name("products-loop.create");
    Route::post('/store', [ProductsLoopController::class, 'store'])->name("products-loop.store");

    Route::get('/edit/{id}', [ProductsLoopController::class, 'edit'])->name("products-loop.edit");
    Route::put('/update/{id}', [ProductsLoopController::class, 'update'])->name("products-loop.update");

    Route::get('/delete/{id}', [ProductsLoopController::class, 'delete'])->name("products-loop.delete");

    Route::post('/bulk_action', [ProductsLoopController::class, 'bulk_action'])->name("products-loop.bulk_action");

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
Route::get('/view-stat/{range}', [PageViewController::class, 'getViewStat']);
Route::get('/sell-stat/{range}', [HomeController::class, 'getSellStat']);



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
//     })->name("block.index");

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
//     })->name("page.index.show");

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
//     })->name("users.index");

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
//     })->name("products.index.show");

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
//     })->name("attributes.index.show");

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
//     })->name("discounts.index.show");

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
//     })->name("installments.index.show");

//     Route::get('/edit/{id}', function ($id) {
//         return view('installment');
//     })->name("installment.show");

//     Route::get('/create', function () {
//         return view('installment');
//     })->name("installment.create.show");

//     Route::get('/plans/list', function () {
//         return view('installments-plans');
//     })->name("installments.plans.index.show");

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
    })->name("snippets.index.show");

    Route::get('/create', function () {
        return view('snippet');
    })->name("snippet.create.show");

    Route::get('/edit/{id}', function ($id) {
        return view('snippet');
    })->name("snippet.show");
});

// Route::get('/customize', function () {
//     return view('customize');
// })->name("customize.show");

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

    Route::get('/workflow-create', function () {
        return view('workflow');
    })->name("workflow.create.show");

    Route::get('/workflow-logs', function () {
        return view('workflow-logs');
    })->name("workflow-logs.show");

    Route::get('/workflow-log/{id}', function ($id) {
        return view('workflow-log');
    })->name("workflow-log.show");
});

Route::get('/changes-request', function () {
    return view('changes-request');
})->name("changes-request.show");

Route::get('/change-request/{id}', function ($id) {
    return view('change-request');
})->name("change-request.show");

Route::get('/add-request/', function () {
    return view('change-request-add');
})->name("change-request-add.show");

// Route::get('/themes', function () {
//     return view('themes');
// })->name("themes.show");

Route::get('/custom-css', function () {
    return view('custom-css');
})->name("custom-css.show");

Route::get('/site-categories', function () {
    return view('site-categories');
})->name("site-categories.show");

Route::get('/change-site-category/{id}', function ($id) {
    return view('site-category');
})->name("change-site-category.show");

Route::get('/create-site-category', function () {
    return view('site-category');
})->name("create-site-category.show");


// LANDING
Route::get('/landings', function () {
    return view('landings');
})->name("landings.show");

Route::post('/landings', function () {
})->name("landings.save");

Route::get('/landing/{id}', function ($id) {
    return view('landing');
})->name("landing.edit.show");

Route::get('/create-landing', function () {
    return view('landing');
})->name("landing.create.show");

// products-loop => حلقه و باکس محصولات در صفحه اصلی
// Route::get('/products-loop', function () {
//     return view('products-loop');
// })->name("products-loop.show");

// Route::post('/products-loop', function () {
// })->name("products-loop.save");

// Route::get('/loop/{id}', function ($id) {
//     return view('loop');
// })->name("loop.edit.show");

// Route::get('/create-loop', function () {
//     return view('loop');
// })->name("loop.create.show");