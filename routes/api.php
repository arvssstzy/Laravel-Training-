<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InvoiceController;
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


Route::prefix('student')->group( function () {
    Route::get('/', [StudentController::class, 'index']);
    Route::post('/create-student', [StudentController::class, 'store']);
    Route::get('/{id}',[StudentController::class, 'show']);
    Route::put('/update-student/{id}', [StudentController::class, 'update']);
    Route::delete('/delete-student/{id}', [StudentController::class, 'destroy']);
});

Route::prefix('invoices')->group( function () {
    Route::get('/',[InvoiceController::class, 'index']);
    Route::post('/create-invoice',[InvoiceController::class, 'store']);
    Route::get('/{id}',[InvoiceController::class, 'show']);
    Route::get('/', [InvoiceController::class, 'getInvoices']);
    Route::put('/update-invoice/{id}', [InvoiceController::class, 'update']);
    Route::delete('/delete-invoice/{id}', [InvoiceController::class, 'destroy']);
    
});

