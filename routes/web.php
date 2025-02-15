<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\UserAccountController;
use App\Models\ListingImage;
use App\Policies\ListingPolicy;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get( '/test', function () {
	/** @var ListingImage $image  */
	$image = ListingImage::all()->first();
	dump( str( $image->filename )->explode( 'storage/' )->last() );
} );

Route::controller( IndexController::class)->group( function () {
	Route::get( '/', 'index' );
	// Route::get( '/hello', 'show' );
} );
Route::resource( '/listing', ListingController::class)->middleware( 'auth' )->only( [ 'index' ] );
Route::put( '/realtor-listing/{listing}/restore', [ RealtorListingController::class, 'restore' ] )
	->name( 'realtor-listing.restore' )->withTrashed();
Route::resource( '/realtor-listing', RealtorListingController::class)->parameter( 'realtor-listing', 'listing' )
	// ->only( [ 'index', 'destroy', 'update', 'edit', 'show' ] )
	->middleware( 'auth' )
	->withTrashed();
Route::middleware( 'auth' )->group( function () {
	Route::resource( 'listing.image', RealtorListingImageController::class)
		->parameter( 'image', 'listing-image' )
		->only( [ 'create', 'store', 'show', 'destroy' ] );
} );

Route::prefix( '/auth' )
	->group( function () {
		Route::controller( AuthController::class)->group( function () {
			Route::get( '/login', 'create' )->name( 'login' );
			Route::post( '/login', 'store' )->name( 'login.store' );
			Route::delete( '/logout', 'destroy' )->name( 'logout' )->middleware( 'auth' );
		} );
		Route::resource( 'user-account', UserAccountController::class)->only( [ 'create', 'store' ] );
	} );
