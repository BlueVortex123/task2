<?php

use App\Http\Controllers\Backend\ContractController;
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
    return redirect('/provider/providers/view');
});

Route::prefix('/provider')->group(function(){
    Route::get('/providers/view', [ProviderController::class, 'ViewProvider'])->name('view.providers');
    Route::get('/providers/add', [ProviderController::class, 'AddProvider'])->name('add.providers');
    Route::post('/providers/store', [ProviderController::class, 'StoreProvider'])->name('store.providers');
    Route::get('/providers/edit/{id}', [ProviderController::class, 'EditProvider'])->name('edit.providers');
    Route::post('/providers/update/{id}', [ProviderController::class, 'UdpateProvider'])->name('update.providers');
    Route::get('/providers/delete/{id}', [ProviderController::class, 'DeleteProvider'])->name('delete.providers');
});

Route::prefix('/contract')->group(function(){
    Route::get('/contract/view', [ContractController::class, 'ViewContracts'])->name('view.contracts');
    Route::get('/contract/add', [ContractController::class, 'AddContracts'])->name('add.contracts');
    
    });

    Route::prefix('/products')->group(function(){
    Route::get('/product/view', [ProductController::class, 'ViewProducts'])->name('view.products');
    Route::get('/product/add', [ProductController::class, 'AddProducts'])->name('add.products');
    
    });