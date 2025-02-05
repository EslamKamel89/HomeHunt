<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory {
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array {
		return [ 
			'user_id' => User::inRandomOrder()->first()->id,
			'beds' => fake()->numberBetween( 1, 10 ),
			'baths' => fake()->numberBetween( 1, 5 ),
			'area' => fake()->numberBetween( 200, 500 ),
			'city' => fake()->city(),
			'code' => fake()->postcode(),
			'street' => fake()->streetName(),
			'street_nr' => fake()->numberBetween( 1, 20 ),
			'price' => fake()->numberBetween( 100000, 1000000 ),
		];
	}
}
