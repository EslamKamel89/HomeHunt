<?php

use App\Http\Controllers\AcceptingOfferController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\UserAccountController;
use App\Models\ListingImage;
use App\Policies\ListingPolicy;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get( '/test', function () {
	Mail::raw( 'This is a test email', function ($message) {
		$message->to( 'test@example.com' )
			->subject( 'Test Email' );
	} );
} );

Route::controller( IndexController::class)->group( function () {
	Route::get( '/', 'index' );
	// Route::get( '/hello', 'show' );
} );

Route::middleware( [ 'auth', 'verified' ] )->group( function () {
	Route::resource( '/listing', ListingController::class)
		->only( [ 'index' ] );
	Route::put( '/realtor-listing/{listing}/restore', [ RealtorListingController::class, 'restore' ] )
		->name( 'realtor-listing.restore' )->withTrashed();
	Route::resource( '/realtor-listing', RealtorListingController::class)
		->parameter( 'realtor-listing', 'listing' )
		->withTrashed();
	Route::resource( 'listing.image', RealtorListingImageController::class)
		->parameter( 'image', 'listing-image' )
		->only( [ 'create', 'store', 'show', 'destroy' ] );
	Route::resource( 'listing.offer', ListingOfferController::class)
		->only( [ 'store' ] );
	Route::put( '/offer/{offer}/accept', AcceptingOfferController::class)->name( 'offer.accept' );
	Route::resource( 'notification', NotificationController::class)->only( [ 'index' ] );
	Route::put( '/notification/{notification}/seen', NotificationSeenController::class)->name( 'notification.seen' );
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


Route::middleware( [ 'auth' ] )->group( function () {
	Route::get( '/email/verify', fn() => inertia( 'Auth/VerifyEmail' ) )
		->name( 'verification.notice' );
	Route::get( '/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
		$request->fulfill();
		return redirect( '/' )->with( 'success', 'You activated you account!' );
	} )->middleware( [ 'signed' ] )->name( 'verification.verify' );
	Route::post( '/email/verification-notification', function (Request $request) {
		auth()->user()->sendEmailVerificationNotification();
		return back()->with( 'success', 'Verification link sent!' );
	} )->middleware( [ 'throttle:6,1' ] )->name( 'verification.send' );
} );

