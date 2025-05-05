<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\TokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//request access token
Route::post('/token', [TokenController::class, 'token'])->name('token');

// search artists,tacks and albums
Route::controller(SearchController::class)->group(function () {
    Route::get('/search', 'search')->name('search');
});

// search artists,tacks and albums
Route::controller(SearchController::class)->group(function () {
    Route::get('/search', 'search')->name('search');
});
