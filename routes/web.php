<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\InvoiceController;
use App\Models\Invoice;

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
//     return view('create');
// });
// Route::get('/create', function () {
//     return view('create');
// });

// Route::get('/', function () {
//     return view('dashboard');
// });

// Route::get('/sample', function () {
//     return view('home');
// });
Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/create', [PageController::class, 'create'])->name('create');
Route::get('/headndetails', [PageController::class, 'about'])->name('headndetails');
// Route::get('/invoice-info/{id}', function ($id) {
//     return view('invoiceinfo', ['id' => $id]);
// });
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/invoiceinfo/{id}', [InvoiceController::class, 'invoiceinfo'])->name('invoiceinfo');





