<?php

namespace App\Providers;

use App\Policies\NotificationPolicy;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Register any application services.
	 */
	public function register(): void {
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void {
		Vite::prefetch( concurrency: 3 );
		Gate::policy( class: \App\Models\Listing::class, policy: \App\Policies\ListingPolicy::class);
		Gate::policy( class: DatabaseNotification::class, policy: NotificationPolicy::class);
	}
}
