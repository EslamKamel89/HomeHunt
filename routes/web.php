<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\UserAccountController;
use App\Policies\ListingPolicy;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::controller( IndexController::class)->group( function () {
	Route::get( '/', 'index' );
	// Route::get( '/hello', 'show' );
} );
Route::resource( '/listing', ListingController::class)->middleware( 'auth' )->except( [ 'destroy', 'update', 'edit' ] );
Route::resource( '/realtor-listing', RealtorListingController::class)->parameter( 'realtor-listing', 'listing' )
	->only( [ 'index', 'destroy', 'update', 'edit' ] )
	->middleware( 'auth' );
Route::prefix( '/auth' )
	->group( function () {
		Route::controller( AuthController::class)->group( function () {
			Route::get( '/login', 'create' )->name( 'login' );
			Route::post( '/login', 'store' )->name( 'login.store' );
			Route::delete( '/logout', 'destroy' )->name( 'logout' )->middleware( 'auth' );
		} );
		Route::resource( 'user-account', UserAccountController::class)->only( [ 'create', 'store' ] );
	} );
