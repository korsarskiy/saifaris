<?php

use App\Http\Controllers\AuthControlledr;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiyRequestController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductColorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/catalog', 'catalog')->name('catalog');
    Route::get('/{id}/product', 'product')->name('product');
    Route::get('/admin', 'admin')->name('admin');
});

Route::controller(AuthControlledr::class)->group(function (){
    Route::get('/auth', 'authPage')->name('login');
    Route::post('/auth', 'auth')->name('auth')->middleware('guest');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::controller(CategoryController::class)->prefix('/category')->middleware('auth')->group(function (){
    Route::post('/create', 'store')->name('category.store');
    Route::delete('/{category}/delete', 'destroy')->name('category.destroy');
});

Route::controller(ProductController::class)->prefix('product')->middleware('auth')->group(function (){
    Route::post('/create', 'store')->name('product.store');
    Route::get('/{product}/edit', 'edit')->name('product.edit');
    Route::patch('/{product}/update', 'update')->name('product.update');
    Route::delete('/{product}/delete', 'destroy')->name('product.destroy');
});


Route::controller(ProductColorController::class)->prefix('color')->middleware('auth')->group(function (){
    Route::get('/{id}/add', 'addColor')->name('color.add');
    Route::post('/{id}/add', 'store')->name('color.store');
    Route::delete('/{productColor}/destroy', 'destroy')->name('color.destroy');
});

Route::controller(RequestController::class)->group(function () {
    Route::post('/submit-request', 'store')->name('request.store');
    Route::patch('/{request}/accept-request', 'accept')->name('request.accept')->middleware('auth');
    Route::patch('/{request}/decline-request', 'decline')->name('request.decline')->middleware('auth');
});

Route::controller(DiyRequestController::class)->group(function () {
    Route::post('/submit-diyrequest', 'store')->name('diyrequest.store');
    Route::patch('/{diyRequest}/accept-diyrequest', 'accept')->name('diyrequest.accept')->middleware('auth');
    Route::patch('/{diyRequest}/decline-diyrequest', 'decline')->name('diyrequest.decline')->middleware('auth');
});






