<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::controller( IndexController::class)->group( function () {
	Route::get( '/', 'index' );
	// Route::get( '/hello', 'show' );
} );
Route::resource( '/listing', ListingController::class);
