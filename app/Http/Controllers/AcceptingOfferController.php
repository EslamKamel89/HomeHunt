<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AcceptingOfferController extends Controller {
	public function __invoke( Offer $offer ) {
		Gate::authorize( 'update', $offer->listing );
		$offer->update( [ 'accepted_at' => now(),] );
		$offer->load( [ 'listing', 'listing.offers', 'user' ] );
		$offer->listing->offers()
			->except( $offer )
			->update( [ 'rejected_at' => now() ] );
		$offer->listing->offers()
			->where( 'id', $offer->id )
			->update( [ 'rejected_at' => null, 'accepted_at' => now() ] );
		$offer->listing->update( [ 'sold_at' => now() ] );
		return redirect()->back()->with( 'success', "Offer #{$offer->id} of \${$offer->amount} from {$offer->user->name} has been accepted, and all other offers have been declined." );
	}
}
