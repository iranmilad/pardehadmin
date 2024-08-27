<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageViewController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\ImageMarkerController;
use App\Http\Controllers\Admin\SessionController;

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

Route::post('/custom-css',function(){
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


