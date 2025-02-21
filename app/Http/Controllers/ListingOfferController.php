<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use App\Models\User;
use App\Notifications\OfferMade;
use Gate;
use Illuminate\Http\Request;

class ListingOfferController extends Controller {
	public function index() {
	}

	public function create() {
	}

	public function store( Listing $listing, Request $request ) {
		Gate::authorize( 'view', $listing );
		/** @var array $data */
		$data = $request->validate( [ 
			'amount' => [ 'required', 'numeric', 'min:1' ]
		] );
		/** @var Offer $offer*/
		$offer = $listing->offers()->create(
			collect( $data )
				->merge( [ 'user_id' => auth()->id() ] )->toArray()
		);
		return redirect()->back()->with( [ 'success' => 'Offer was made' ] );
	}

	public function show( Offer $offer ) {
	}

	public function edit( Offer $offer ) {
	}

	public function update( Request $request, Offer $offer ) {
	}

	public function destroy( Offer $offer ) {
	}
}
