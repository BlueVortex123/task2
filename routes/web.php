<?php

use App\Http\Controllers\Backend\ProductController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::resource('/providers', App\Http\Controllers\Backend\ProviderController::class)->except('show');
    Route::get('backend/providers/trashed', [App\Http\Controllers\Backend\ProviderController::class, 'onlyTrashedProviders'])->name('trashed_providers');
    Route::get('backend/provider.restore/{id}', [App\Http\Controllers\Backend\ProviderController::class, 'restoreProviders'])->name('restore_providers');
    Route::get('backend/providers/permanentlyDelete/{id}', [App\Http\Controllers\Backend\ProviderController::class, 'permanentlyDeleteProviders'])->name('permanently_delete_providers');


// Contracts Routes
Route::resource('/contracts', App\Http\Controllers\Backend\ContractController::class)->except('show');
Route::get('backend/contracts/trashed', [App\Http\Controllers\Backend\ContractController::class, 'onlyTrashedContracts'])->name('trashed_contracts');
Route::get('backend/contracts.restore/{id}', [App\Http\Controllers\Backend\ContractController::class, 'restoreContracts'])->name('restore_contracts');
Route::get('backend/contracts/permanentlyDelete/{id}', [App\Http\Controllers\Backend\ContractController::class, 'permanentlyDeleteContracts'])->name('permanently_delete_contracts');

// Product Routes
Route::resource('/products', App\Http\Controllers\Backend\ProductController::class)->except('show');
Route::get('backend/products/trashed', [App\Http\Controllers\Backend\ProductController::class, 'onlyTrashedProducts'])->name('trashed_products');
Route::get('backend/products.restore/{id}', [App\Http\Controllers\Backend\ProductController::class, 'restoreProducts'])->name('restore_products');
Route::get('backend/products/permanentlyDelete/{id}', [App\Http\Controllers\Backend\ProductController::class, 'permanentlyDeleteProducts'])->name('permanently_delete_products');



Route::get('backend/activities/activity', [App\Http\Controllers\LogController::class, 'index'])->name('activity');
Route::get('backend/activities/list/{model_type}', [App\Http\Controllers\LogController::class, 'getActivity'])->name('list_activity');