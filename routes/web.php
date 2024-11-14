<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();



use App\Http\Controllers\InventoryController;
use App\Http\Controllers\DueController;
use App\Http\Controllers\OrderController;




Route::group(['middleware' => ['auth', 'approved']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::post('inventory', [InventoryController::class, 'store'])->name('inventory.store');
    Route::delete('inventory/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
    Route::get('inventory/{id}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
    Route::put('inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update');


    Route::get('due', [DueController::class, 'index'])->name('due.index');
    Route::post('due/store', [DueController::class, 'store'])->name('due.store');
    Route::delete('due/{id}', [DueController::class, 'destroy'])->name('due.destroy');
    Route::get('due/{id}/edit', [DueController::class, 'edit'])->name('due.edit');
    Route::put('due/{id}', [DueController::class, 'update'])->name('due.update');


    Route::resource('orders', OrderController::class);


});





