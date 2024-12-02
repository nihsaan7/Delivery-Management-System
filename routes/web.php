<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\DeliveryManagmentController;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::name('deliverRequest.')->prefix('/')->group(function () {
    Route::get('/', [DeliveryManagmentController::class, 'index'])->name('index');
    Route::get('create', [DeliveryManagmentController::class, 'create'])->name('create');
    Route::post('store', [DeliveryManagmentController::class, 'store'])->name('store');
    Route::post('status-change', [DeliveryManagmentController::class, 'statusChange'])->name('statusChange');
    
});

