<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\BDashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BranchController;

Route::get('/', fn () => redirect()->route('branches.index'));

Route::resource('branches', BranchController::class);
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);

Route::controller(BDashboardController::class)->group(function () {
    Route::get('/dashboard', 'index');
});
