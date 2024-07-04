<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\SpecialController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InventoryController;

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

////////////////Menu////////////////
Route::get('/dashboard/menus/index', [MenuController::class, 'index'])->middleware('auth');
Route::get('/dashboard/menus/create', [MenuController::class, 'create'])->middleware('auth');
Route::post('/dashboard/menus/uploadImage', [MenuController::class, 'uploadImage'])->middleware('auth');
Route::get('/dashboard/menus/{menu:id}/edit', [MenuController::class, 'edit'])->middleware('auth');
Route::resource('/dashboard/menus', MenuController::class)->middleware('auth');
Route::post('/dashboard/ingredientmenus/{menu:id}', [MenuController::class, 'menuGroup'])->middleware('auth');
Route::get('/dashboard/ingredientmenus/{menu:id}/show', [MenuController::class, 'index_bahan'])->middleware('auth');
Route::delete('/dashboard/ingredientmenus/{id}/delete', [MenuController::class, 'deleteGroup'])->middleware('auth');
////////////////////////////////////

////////////////Ingredients/////////
Route::get('/dashboard/ingredients/index', [IngredientController::class, 'index'])->middleware('auth');
Route::get('/dashboard/ingredients/create', [IngredientController::class, 'create'])->middleware('auth');
Route::get('/dashboard/ingredients/{ingredient:id}/edit', [IngredientController::class, 'edit'])->middleware('auth');
Route::resource('/dashboard/ingredients', IngredientController::class)->middleware('auth');
////////////////////////////////////

////////////////Specials/////////
Route::get('/dashboard/specials/index', [SpecialController::class, 'index'])->middleware('auth');
Route::get('/dashboard/specials/create', [SpecialController::class, 'create'])->middleware('auth');
Route::get('/dashboard/specials/{special:id}/edit', [SpecialController::class, 'edit'])->middleware('auth');
Route::resource('/dashboard/specials', SpecialController::class)->middleware('auth');
////////////////////////////////////


////////////////Transactions/////////
Route::get('/dashboard/transactions/index', [TransactionController::class, 'index'])->middleware('auth');
Route::get('/dashboard/transactions/create', [TransactionController::class, 'create'])->middleware('auth');
Route::resource('/dashboard/transactions', TransactionController::class)->middleware('auth');
////////////////////////////////////

////////////////Orders/////////
Route::get('/dashboard/orders/index', [OrderController::class, 'index'])->middleware('auth');
Route::get('/dashboard/orders/create', [OrderController::class, 'create'])->middleware('auth');
Route::resource('/dashboard/orders', OrderController::class)->middleware('auth');
Route::post('/dashboard/orders/changeStatus/{order:id}', [OrderController::class, 'changeStatus'])->middleware('auth')->name('orders.changeStatus');
////////////////////////////////////

////////////////Employees/////////
Route::get('/dashboard/employees/index', [EmployeeController::class, 'index'])->middleware('auth');
Route::get('/dashboard/employees/create', [EmployeeController::class, 'create'])->middleware('auth');
Route::get('/dashboard/employees/{employee:id}/edit', [EmployeeController::class, 'edit'])->middleware('auth');
Route::resource('/dashboard/employees', EmployeeController::class)->middleware('auth');
////////////////////////////////////

////////////////Inventory/////////
Route::get('/dashboard/inventories/index', [InventoryController::class, 'index'])->middleware('auth');
Route::get('/dashboard/inventories/create', [InventoryController::class, 'create'])->middleware('auth');
Route::get('/dashboard/inventories/{employee:id}/edit', [InventoryController::class, 'edit'])->middleware('auth');
Route::resource('/dashboard/inventories', InventoryController::class)->middleware('auth');
////////////////////////////////////