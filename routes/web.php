<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
})->name('dashboard');

Route::view('dashboard', 'dashboard-analytics_copy')->middleware(['auth']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

Route::resource('users', App\Http\Controllers\UserController::class);


Route::middleware([RoleMiddleware::class])->group(function(){
    Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
});
Route::middleware(['auth'])->group(function () {

    Route::resource('invoices', App\Http\Controllers\InvoiceController::class);
});
Route::post('/get-customer-name',  [App\Http\Controllers\InvoiceController::class, 'getCustomerName'])->name('getCustomerName');
Route::get('/invoice/print', [App\Http\Controllers\InvoiceController::class, 'printInvoice'])->name('invoice.print');
Route::post('/update-delivered-status',  [App\Http\Controllers\InvoiceController::class, 'updateDeliveredStatus']);


Route::post('/add-payment-history',  [App\Http\Controllers\InvoiceController::class, 'addPaymentHistory'])->name('addpaymentHistory');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
