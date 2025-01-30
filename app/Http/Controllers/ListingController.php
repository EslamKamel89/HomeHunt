<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller {

	public function index() {
		return inertia( 'Listing/Index', [ 
			'listings' => Listing::latest()->get()
		] );
	}


	public function create() {
		return inertia( 'Listing/Create' );
	}


	public function store( Request $request ) {
		$data = $request->validate( [ 
			'beds' => [ 'required', 'numeric',],
			'baths' => [ 'required', 'numeric',],
			'area' => [ 'required', 'numeric',],
			'city' => [ 'required', 'max:255' ],
			'code' => [ 'required', 'max:255' ],
			'street' => [ 'required', 'max:255' ],
			'street_nr' => [ 'required', 'numeric',],
			'price' => [ 'required', 'numeric',],
		] );
		$listing = Listing::create( $data );
		return redirect()->route( 'listing.index' )->with( [ 'success' => 'Listing Created Successfully' ] );
	}


	public function show( Listing $listing ) {
		return inertia( 'Listing/Show', [ 
			'listing' => $listing,
		] );
	}

	public function edit( Listing $listing ) {
		//
	}


	public function update( Request $request, Listing $listing ) {

	}


	public function destroy( Listing $listing ) {

	}
}
