<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Notifications\DatabaseNotification;

class NotificationPolicy {
	public function viewAny( User $user ): bool {
		return true;
	}

	public function view( User $user, DatabaseNotification $databaseNotification ): bool {
		return true;
	}

	public function create( User $user ): bool {
		return true;
	}

	public function update( User $user, DatabaseNotification $databaseNotification ): bool {
		return $user->id == $databaseNotification->notifiable_id;
	}

	public function delete( User $user, DatabaseNotification $databaseNotification ): bool {
		return true;
	}

	public function restore( User $user, DatabaseNotification $databaseNotification ): bool {
		return true;
	}

	public function forceDelete( User $user, DatabaseNotification $databaseNotification ): bool {
		return true;
	}
}
