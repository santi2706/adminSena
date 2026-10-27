<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreasController;

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
    return view('welcome');
});

Route::get('/areas/create', [AreasController::class, 'create'])
    ->name('web.areas.create');
Route::post('/areas', [AreasController::class, 'store'])
    ->name('web.areas.store');
