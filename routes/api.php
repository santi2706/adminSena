<?php
use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\AreasController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TrainingCenterController;
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
Route::get('hola', function () {
    return response()->json([
        'status' => 200,
        'mensaje' => 'hola'
    ]);
});
Route::get('ping', function () {
    return response()->json(['message' => 'Hola, API conectada']);
});



Route::apiResource('teachers', TeacherController::class);
Route::apiResource('areas', AreasController::class);
Route::apiResource('training-centers', TrainingCenterController::class);
Route::apiResource('courses', CourseController::class);
Route::apiResource('computers', ComputerController::class);
Route::apiResource('apprentices', ApprenticeController::class);