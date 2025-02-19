<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class AcceptingOfferController extends Controller {
	public function __invoke( Offer $offer ) {
		$offer->update( [ 'accepted_at' => now(),] );
		$offer->listing->offers()
			->except( $offer )
			->update( [ 'rejected_at' => now() ] );
		return redirect()->back()->with( 'success', "Offer #{$offer->id} is accepted and other offers rejected_at" );
	}
}
