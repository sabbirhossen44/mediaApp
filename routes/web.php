<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');
Route::controller(FrontendController::class)->group(function(){
    Route::get('/', 'index')->name('home');
});

Route::controller(CategoryController::class)->group(function(){
    Route::get('/category', 'index')->name('category.index');
    Route::get('/category/create', 'create')->name('category.create');
    Route::post('/category/store', 'store')->name('category.store');
    Route::get('/category/{category}/edit', 'edit')->name('category.edit');
    Route::put('/category/{category}/update', 'update')->name('category.update');
    Route::get('/category/{category}/destroy', 'destroy')->name('category.destroy');
});
