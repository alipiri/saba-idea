<?php
use App\Http\Controllers\Api\CommissionController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SellerController;
use Illuminate\Support\Facades\Route;

Route::RESOURCE('seller', SellerController::class)->except('destroy');
Route::RESOURCE('product', ProductController::class)->except(['destroy', 'create', 'edit']);
Route::RESOURCE('commission', CommissionController::class)->except('destroy');
Route::RESOURCE('order', OrderController::class)->except('destroy');
Route::POST('order/create-url', [OrderController::class, 'createUrl']);
