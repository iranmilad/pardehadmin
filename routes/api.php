<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::get('/view-stat', function (Request $request) {

    $data = generateRandomNumbers();
    return response()->json($data);
});

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



Route::get('/checkproduct', function (Request $request) {

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
            "top" => 33.362500508626304,
            "left" => 83.86930669936791
        ],
    ];

    return response()->json($response);
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
