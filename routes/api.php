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