<?php

use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\StudentController;
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

// Route::get('/', function () {
//     return response()->json([
//         'success' => true,
//         'message' => 'Belajar Laravel',
//         'data' => [
//             'id' => 1,
//             'nama' => 'bariq',
//             'alamat' => 'malang'
//         ]
//     ]);
// });

// Route::post('/kirim', function () {
//     return response()->json([
//         'message' => 'Kirim'
//     ]);
// });

Route::apiResource('student', StudentController::class);

Route::post('login', [AuthenticationController::class, 'login']);
Route::post('registration', [AuthenticationController::class, 'registration']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthenticationController::class, 'logout']);
});
