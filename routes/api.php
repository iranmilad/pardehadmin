<?php

use Illuminate\Http\Request;
use function Laravel\Prompts\search;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\API\ShopController;
use App\Http\Controllers\API\SiteController;
use App\Http\Controllers\PageViewController;

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\API\CouponController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\API\SellerController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\CompareController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\ImageMarkerController;
use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\API\FastOrderController;
use App\Http\Controllers\API\Holo\WebhookController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\API\SellerProductController;
use App\Http\Controllers\API\SessionMessageController;
use App\Http\Controllers\API\SupplierReviewController;
use App\Http\Controllers\API\RelatedProductsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Generate random numbers for testing
function generateRandomNumbers()
{
    $randomNumbers = [];
    for ($i = 0; $i < 24; $i++) {
        $randomNumbers[] = rand(0, 100);
    }
    return $randomNumbers;
}

// Route::get('/view-stat', function (Request $request) {

//     $data = generateRandomNumbers();
//     return response()->json($data);
// });

Route::get('/sell-stat', function (Request $request) {

    $data = generateRandomNumbers();
    return response()->json($data);
});


// FOR MESSAGE IN DASHBOARD
Route::get('/messages/{id}', [SessionController::class,'messages'])->name('api.messages.get');
Route::get('/messages/timestamp/{id}',  [SessionController::class,'timestamp'])->name('api.messages.timestamp');


Route::get('/search', function (Request $request) {
    $data = [
        'search' => $request->search,
        'results' => [
            [
                'id' => 1,
                "text" => "نتیجه یک",
            ],
            [
                'id' => 2,
                "text" => "نتیجه دو",
            ],
            [
                'id' => 3,
                "text" => "نتیجه سه",
            ],
        ],
    ];

    return response()->json($data);
})->name('api.search');



Route::get('/checkproduct/{id}', function (Request $request) {

    /**
     * REQUEST
     * products id
     */
    // $request = [
    //     'products' => [1,2,3,4]
    // ];

    $response = [
        [
            "dataId" => 1,
            "productName" => "نتیجه یک",
            "link" => "https://javidcode.com",
            "top" => 33.362500508626304,
            "left" => 83.86930669936791
        ],
    ];

    return response()->json($response);
});

// FOR IMAGE DOT. IT GETS DATA OF PRODUCT {ID} AND FILTER
// Route::get("/imgdot/{id}", function ($id) {
//     $product = [
//         "name" => "محصول",
//         "img" => "https://placehold.co/600x400",
//         "price" => "25,000,000",
//         "discounted_price" => "18,000,000",
//         "discount" => "20%"
//     ];

//     $html = View::make("components/imgdot", $product)->render();

//     return response()->json(['html' => $html]);
// });

Route::post('/custom-css', function () {
    // REQUEST => ID
    $css = "body{
    background-color: red;
}";
    return response()->json(['css' => $css]);
});

Route::get('/product-options/{id}', function ($id) {
    // TYPE => SELECT,INPUT
    // event for something like wrarranty use select.
    // for select you can use multiple or not.
    $response = [
        [
            'label' => 'رنگ',
            'name' => 'color',
            'type' => 'select',
            'multiple' => false,
            'options' => [
                [
                    'name' => 'قرمز',
                    'value' => 'red'
                ],
                [
                    'name' => 'آبی',
                    'value' => 'blue'
                ],
            ]
        ],
        [
            'label' => 'انتخاب گارانتی',
            'name' => 'warranty',
            'type' => 'select',
            'multiple' => false,
            'options' => [
                [
                    'name' => '3 سال',
                    'value' => '3'
                ],
                [
                    'name' => '5 سال',
                    'value' => '5'
                ],
            ]
        ],
        [
            'label' => 'تعداد',
            'name' => 'count',
            'type' => 'input',
        ]
    ];

    return response()->json($response);
});
Route::group(['middleware' => ['web']], function () {

    Route::post('/file/upload', [FileController::class,'upload'])->name('api.dashboard.upload');
    Route::delete('/file/remove', [FileController::class,'remove'])->name('api.dashboard.remove');
});
// برای دریافت کار ها
Route::get('/tasks', function () {
    $response = [
        [
            'id' => "nkjkln56342",
            "title" => "شروع نشده",
            "color" => '#6b7280',
            "items" => [
                [
                    "id" => "1111",
                    "title" => "ارسال برای خریدار",
                    "assigneeName" => "فرهاد باقری",
                    "startDate" => "01/01/1403",
                    "endDate" => "30/01/1403",
                ],
                [
                    "id" => "2222",
                    "title" => "طراحی دوخت",
                    "assigneeName" => "فرهاد باقری",
                    "startDate" => "01/01/1403",
                    "endDate" => "30/01/1403",
                ]
            ]
        ],
        [
            'id' => "sb7df9asd",
            "title" => "درحال انجام",
            "color" => '#2196F3',
            "items" => [
                [
                    "id" => "3333",
                    "title" => "خرید پارچه",
                    "assigneeName" => "فرهاد باقری",
                    "startDate" => "01/01/1403",
                    "endDate" => "30/01/1403",
                ],
                [
                    "id" => "4544",
                    "title" => "ارسال برای نصاب",
                    "assigneeName" => "فرهاد باقری",
                    "startDate" => "01/01/1403",
                    "endDate" => "30/01/1403",
                ]
            ]
        ],
        [
            'id' => "fdgmndfg2",
            "title" => "اتمام یافته",
            "color" => '#009688',
            "items" => [
                [
                    "id" => "5555",
                    "title" => "خرید پارچه",
                    "assigneeName" => "فرهاد باقری",
                    "startDate" => "01/01/1403",
                    "endDate" => "30/01/1403",
                ],
                [
                    "id" => "6666",
                    "title" => "ارسال برای نصاب",
                    "assigneeName" => "فرهاد باقری",
                    "startDate" => "01/01/1403",
                    "endDate" => "30/01/1403",
                ]
            ]
        ],
    ];

    return response()->json(array("boards" => $response));
});

// برای دریافت وضعیت ها
Route::get('/tasks/status', function () {
    $arr = [
        [
            'id' => "nkjkln56342",
            "title" => "شروع نشده"
        ],
        [
            'id' => "sb7df9asd",
            "title" => "درحال انجام"
        ],
        [
            'id' => "fdgmndfg2",
            "title" => "اتمام یافته"
        ],
    ];

    return response()->json($arr);
});

// برای اضافه کردن کار
Route::post('/tasks/add', function () {

    // $request = [
    //     'id' => '',
    //     'title' => '',
    //     'assigneeName' => '',
    //     'startDate' => '',
    //     'endDate' => ''
    //     'board' => 'inprogress'
    // ];

    return response()->json();
});

// برای بروزرسانی کار
Route::post('/tasks/update', function () {

    // $request = [
    //     'id' => '',
    //     'title' => '',
    //     'assigneeName' => '',
    //     'startDate' => '',
    //     'endDate' => ''
    //     'board' => 'inprogress'
    // ];

    return response()->json();
});

// برای دریافت مشخصات کار
Route::get('/task/{id}', function ($id) {

    $response = [
        'id' => '3333',
        'title' => 'ارسال برای مشتری',
        'assigneeName' => 'فرهاد باقری',
        'startDate' => '1403/01/01', // Y - M -D
        'endDate' => "1403/01/30", // Y - M -D
        'board' => 'sb7df9asd'
    ];

    return response()->json($response);
});

// برای آپدیت کردن وضعیت
Route::post('/tasks/update-kanban', function () {

    // $request = [
    //     'id' => '',
    //     'title' => '',
    //     'color' => '',
    //     'position' => ''
    // ];

    return response()->json();
});

// ساخت وضعیت
Route::post('/tasks/create-kanban', function () {

    // $request = [
    //     'id' => '',
    //     'title' => '',
    //     'color' => '',
    //     'position' => ''
    // ];

    return response()->json();
});

// اپدیت کردن کار
Route::post('/tasks/update-card', function () {

    // $request = [
    //     'id' => '',
    //     'title' => '',
    //     'assigneeName' => '',
    //     'startDate' => '',
    //     'endDate' => ''
    //     'board' => ''
    //     'position' => ''
    // ];

    return response()->json();
});

// حذف کردن وضعیت
Route::post('/tasks/remove-card', function () {

    // $request = [
    //     'id' => '',
    // ];

    return response()->json();
});

// حذف کردن کار
Route::post('/tasks/remove', function () {

    // $request = [
    //     'id' => '',
    // ];

    return response()->json();
});

Route::group([
    'middleware' => 'api',
], function ($router) {

    Route::post('/sms/newsmscode', [AuthController::class, 'sendOtp']);
    Route::post('/sms/verifysms', [AuthController::class, 'verifyOtp']);


    Route::post('/auth/login', [AuthController::class, 'verifyOtp']);
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::get('/auth/verify-token', [AuthController::class, 'verifyToken']);
    Route::post('/auth/verifyregister', [AuthController::class, 'verifyregister']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');

    Route::post('/edit-account', [ProfileController::class, 'edit'])->middleware('auth:api');
    Route::get('/edit-account', [ProfileController::class, 'show'])->middleware('auth:api');


    Route::get('/favorites', [FavoriteController::class, 'index'])->middleware('auth:api');
    Route::post('/favorites/delete', [FavoriteController::class, 'destroy'])->middleware('auth:api');
    Route::post('/favorites', [FavoriteController::class, 'store'])->middleware('auth:api');

    Route::post('/tickets', [SessionMessageController::class, 'getUserActiveSessions'])->middleware('auth:api');
    Route::get('/tickets/{id}', [SessionMessageController::class, 'getSessionDetails'])->middleware('auth:api');
    Route::post('/tickets/send', [SessionMessageController::class, 'sendMessage'])->middleware('auth:api');

    Route::post('/product/related', [RelatedProductsController::class, 'showRelatedProducts'])->middleware('auth:api');

    Route::post('/orders', [OrderController::class, 'index'])->middleware('auth:api');
    Route::post('/orders/{id}', [OrderController::class, 'getOrderResponse'])->middleware('auth:api');
    Route::post('/order-confirm/{id}', [OrderController::class, 'confirmOrder'])->middleware('auth:api');

    Route::post('/cart/update', [CartController::class, 'update'])->middleware('auth:api');
    Route::post('/cart/remove', [CartController::class, 'cartRemove'])->middleware('auth:api');
    Route::get('/cart', [CartController::class, 'index'])->middleware('auth:api');
    Route::get('/cartinfo', [CartController::class, 'cartInfo'])->middleware('auth:api');


    Route::get('/myaccount', [AccountController::class, 'myaccount'])->middleware('auth:api');
    Route::post('/upload/{sessionId}', [SessionMessageController::class, 'uploadImage'])->middleware('auth:api');


    Route::post('/submitcoupon', [CouponController::class, 'submitCoupon'])->middleware('auth:api');

    Route::get('/payment', [PaymentController::class, 'index']);
    Route::get('/bootstrap', [SiteController::class, 'bootstrap']);
    Route::get('/home', [SiteController::class, 'home']);
    Route::get('/search', [SearchController::class, 'search']);
    Route::get('/product/{id}', [ProductController ::class, 'show']);
    Route::get('/seller/{id}', [SellerController::class, 'getSellerInfo']);
    Route::post('/seller/{id}/products', [SellerProductController::class, 'getSellerProducts']);
    Route::post('/seller/{id}/comments', [SupplierReviewController::class, 'getSupplierComments']);
    Route::post('/shop', [ShopController::class, 'getProducts']);
    Route::post('/fastorder', [FastOrderController::class, 'getFastOrderProducts']);
    Route::post('/compare', [CompareController::class, 'compare']);
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::post('/page', [PageController::class, 'show']);
});
Route::post('/webhook', [WebhookController::class, 'handleWebhook']);




