<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListingPolicy {
	public function before( ?User $user, string $ability ) {
		if ( $user?->is_admin ) {
			return true;
		}
		return null;
	}
	/**
	 * viewAny
	 *
	 * @param  mixed $user
	 * @return bool
	 */
	public function viewAny( ?User $user ): bool {
		return true;
	}


	/**
	 * view
	 *
	 * @param  mixed $user
	 * @param  mixed $listing
	 * @return bool
	 */
	public function view( ?User $user, Listing $listing ): bool {
		return true;
	}

	/**
	 * create
	 *
	 * @param  mixed $user
	 * @return bool
	 */
	public function create( ?User $user ): bool {
		return true;
	}



	public function update( ?User $user, Listing $listing ) {
		return $listing->user_id === $user->id
			? Response::allow()
			: Response::deny( 'You do not own this listing' );
	}


	public function delete( ?User $user, Listing $listing ) {
		return $listing->user_id === $user->id
			? Response::allow()
			: Response::deny( 'You do not own this listing' );
	}



	public function restore( ?User $user, Listing $listing ) {
		return $listing->user_id === $user->id
			? Response::allow()
			: Response::deny( 'You do not own this listing' );
	}


	public function forceDelete( ?User $user, Listing $listing ) {
		return $listing->user_id === $user->id
			? Response::allow()
			: Response::deny( 'You do not own this listing' );
	}
}
