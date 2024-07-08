<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ScheduleController;


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

Route::get('/', [IndexController::class, 'index']);

// Route::get('/review', [RatingController::class, 'index'])->name('review');

Route::get('/inner-page', function () {
    return view('inner-page');
})->name("inner-page");


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
//name('login') wajib biar gk error klo blom login
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']); //untuk simpen data yg diregister

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware('auth');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');



////////////////Transactions/////////
Route::get('/dashboard/transactions/index', [TransactionController::class, 'index'])->middleware('auth');
Route::get('/dashboard/transactions/create', [TransactionController::class, 'create'])->middleware('auth');
Route::resource('/dashboard/transactions', TransactionController::class)->middleware('auth');
////////////////////////////////////

////////////////Schedules/////////
Route::get('/dashboard/schedules/index', [ScheduleController::class, 'index'])->middleware('auth');
Route::get('/dashboard/schedules/create', [ScheduleController::class, 'create'])->middleware('auth');
Route::resource('/dashboard/schedules', ScheduleController::class)->middleware('auth');
////////////////////////////////////

////////////////Orders/////////
Route::get('/dashboard/orders/index', [OrderController::class, 'index'])->middleware('auth');
Route::get('/dashboard/orders/create', [OrderController::class, 'create'])->middleware('auth');
Route::resource('/dashboard/orders', OrderController::class)->middleware('auth');
Route::post('/dashboard/orders/changeStatus/{order:id}', [OrderController::class, 'changeStatus'])->middleware('auth')->name('orders.changeStatus');
////////////////////////////////////


////////////////Inventory/////////
Route::get('/dashboard/inventories/index', [InventoryController::class, 'index'])->middleware('auth');
Route::get('/dashboard/inventories/create', [InventoryController::class, 'create'])->middleware('auth');
Route::get('/dashboard/inventories/{employee:id}/edit', [InventoryController::class, 'edit'])->middleware('auth');
Route::resource('/dashboard/inventories', InventoryController::class)->middleware('auth');
////////////////////////////////////