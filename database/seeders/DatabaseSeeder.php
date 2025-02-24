<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 */
	public function run(): void {
		// User::factory(10)->create();

		User::factory()->create( [ 
			'name' => 'admin',
			'email' => 'admin@gmail.com',
			'is_admin' => true,
		] );
		User::factory()->create( [ 
			'name' => 'user',
			'email' => 'user@gmail.com',
		] );
		// User::factory(   )->create();
		Listing::factory( 100 )->create();
	}
}
