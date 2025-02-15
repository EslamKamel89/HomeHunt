<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListingPolicy {
	/**
	 * @param User|null $user
	 * @param string $ability
	 *
	 * @return bool
	 */
	public function before( ?User $user, string $ability ): bool|null {
		if ( $user?->is_admin ) {
			return true;
		}
		return null;
	}

	/**
	 * @param User|null $user
	 *
	 * @return bool
	 */
	public function viewAny( ?User $user ): bool {
		return true;
	}



	/**
	 * @param User|null $user
	 * @param Listing $listing
	 *
	 * @return bool
	 */
	public function view( ?User $user, Listing $listing ): bool {
		return true;
	}


	/**
	 * @param User|null $user
	 *
	 * @return bool
	 */
	public function create( ?User $user ): bool {
		return true;
	}



	/**
	 * @param User|null $user
	 * @param Listing $listing
	 *
	 * @return Response
	 */
	public function update( ?User $user, Listing $listing ): Response {
		return $listing->user_id === $user->id
			? Response::allow()
			: Response::deny( 'You do not own this listing' );
	}


	/**
	 * @param User|null $user
	 * @param Listing $listing
	 *
	 * @return Response
	 */
	public function delete( ?User $user, Listing $listing ): Response {
		return $listing->user_id === $user->id
			? Response::allow()
			: Response::deny( 'You do not own this listing' );
	}



	/**
	 * @param User|null $user
	 * @param Listing $listing
	 *
	 * @return Response
	 */
	public function restore( ?User $user, Listing $listing ): Response {
		return $listing->user_id === $user->id
			? Response::allow()
			: Response::deny( 'You do not own this listing' );
	}


	/**
	 * @param User|null $user
	 * @param Listing $listing
	 *
	 * @return Response
	 */
	public function forceDelete( ?User $user, Listing $listing ): Response {
		return $listing->user_id === $user->id
			? Response::allow()
			: Response::deny( 'You do not own this listing' );
	}
}
