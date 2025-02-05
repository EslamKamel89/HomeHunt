<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
		$user = auth()->user();
		$user->listings()->create( $data );
		return redirect()->route( 'listing.index' )->with( [ 'success' => 'Listing Created Successfully' ] );
	}


	public function show( Listing $listing ) {
		Gate::authorize( 'view', $listing );
		return inertia( 'Listing/Show', [ 
			'listing' => $listing,
		] );
	}

	public function edit( Listing $listing ) {
		return inertia( 'Listing/Edit', [ 
			'listing' => $listing
		] );
	}


	public function update( Request $request, Listing $listing ) {
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
		$listing->update( $data );
		return redirect()->route( 'listing.index' )->with( [ 'success' => 'Listing Updated Successfully' ] );

	}


	public function destroy( Listing $listing ) {
		$listing->delete();
		return redirect()->route( 'listing.index' )->with( [ 'success' => 'Listing Deleted Successfully' ] );

	}
}
