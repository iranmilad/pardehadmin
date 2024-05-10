<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
function generateRandomNumbers() {
    $randomNumbers = [];
    for ($i = 0; $i < 24; $i++) {
        $randomNumbers[] = rand(0, 100);
    }
    return $randomNumbers;
}

Route::get('/view-stat', function(Request $request){

    $data = generateRandomNumbers();
    return response()->json($data);
});

Route::get('/sell-stat', function(Request $request){

    $data = generateRandomNumbers();
    return response()->json($data);
});


// FOR MESSAGE IN DASHBOARD
Route::get('/messages/{id}', function ($id) {
    $message = [
        'id' => $id,
        'sender' => 'مدیریت',
        'priority' => 'زیاد',
        'title' => 'اندازه گیری پرده',
        'timestamp' => 100,
        'messages' => [
            [
                'id' => 1,
                'message' => 'پیام اول',
                'created_at' => '1400/01/01 12:00:00',
                'files' => ['https://placehold.co/600x400', 'https://placehold.co/600x400'],
                'you' => true
            ],
            [
                'id' => 2,
                'message' => 'پیام دوم',
                'created_at' => '1400/01/01 12:00:00',
                'files' => ['https://placehold.co/600x400', 'https://placehold.co/600x400'],
                'you' => false
            ],
        ],
    ];

    return response()->json(['message' => $message]);
});

Route::get('/messages/{id}/timestamp', function ($id) {
    $timestamp = 200;
    return response()->json(array("timestamp" => $timestamp));
});