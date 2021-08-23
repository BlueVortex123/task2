<?php

use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProviderController;
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

Route::prefix('/provider')->group(function(){
    Route::get('/providers/view', [ProviderController::class, 'ViewProvider'])->name('view.providers');
    Route::get('/providers/add', [ProviderController::class, 'AddProvider'])->name('add.providers');
    Route::post('/providers/store', [ProviderController::class, 'StoreProvider'])->name('store.providers');
    Route::get('/providers/edit/{id}', [ProviderController::class, 'EditProvider'])->name('edit.providers');
    Route::post('/providers/update/{id}', [ProviderController::class, 'UdpateProvider'])->name('update.providers');
    Route::get('/providers/delete/{id}', [ProviderController::class, 'DeleteProvider'])->name('delete.providers');
});

// Contracts Routes
Route::resource('/contracts', App\Http\Controllers\Backend\ContractController::class)->except('show');
Route::get('backend/contracts/trashed', [App\Http\Controllers\Backend\ContractController::class, 'onlyTrashedContracts'])->name('trashed_contracts');
Route::get('backend/contracts.restore/{id}', [App\Http\Controllers\Backend\ContractController::class, 'restoreContracts'])->name('restore_contracts');
Route::get('backend/contracts/permanentlyDelete/{id}', [App\Http\Controllers\Backend\ContractController::class, 'permanentlyDeleteContracts'])->name('permanently_delete_contracts');



Route::prefix('/products')->group(function(){
    Route::get('/product/view', [ProductController::class, 'ViewProducts'])->name('view.products');
    Route::get('/product/add', [ProductController::class, 'AddProducts'])->name('add.products');
    Route::post('/product/store', [ProductController::class, 'StoreProducts'])->name('store.products');
    Route::get('/product/edit/{id}', [ProductController::class, 'EditProducts'])->name('edit.products');
    Route::post('/product/update/{id}', [ProductController::class, 'UpdateProducts'])->name('update.products');
    Route::get('/product/delete/{id}', [ProductController::class, 'DeleteProducts'])->name('delete.products');
});

Route::get('backend/activities/activity', [App\Http\Controllers\LogController::class, 'index'])->name('activity');
Route::get('backend/activities/list/{model_type}', [App\Http\Controllers\LogController::class, 'getActivity'])->name('list_activity');