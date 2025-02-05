<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListingPolicy {

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


	/**
	 * update
	 *
	 * @param  mixed $user
	 * @param  mixed $listing
	 * @return bool
	 */
	public function update( ?User $user, Listing $listing ): bool {
		return true;
	}

	/**
	 * delete
	 *
	 * @param  mixed $user
	 * @param  mixed $listing
	 * @return bool
	 */
	public function delete( ?User $user, Listing $listing ): bool {
		return true;
	}


	/**
	 * restore
	 *
	 * @param  mixed $user
	 * @param  mixed $listing
	 * @return bool
	 */
	public function restore( ?User $user, Listing $listing ): bool {
		return true;
	}


	/**
	 * forceDelete
	 *
	 * @param  mixed $user
	 * @param  mixed $listing
	 * @return bool
	 */
	public function forceDelete( ?User $user, Listing $listing ): bool {
		return true;
	}
}
