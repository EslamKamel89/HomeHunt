<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Gate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

class RealtorListingController extends Controller {
	/**
	 * Display a listing of the resource.
	 */
	public function index( Request $request ) {
		$filters = [ 
			'deleted' => $request->boolean( 'deleted' ),
			...$request->only( [ 'by', 'order' ] ),
		];
		$listings = Listing::where( 'user_id', auth()->id() )
			->filter( $filters )
			->paginate( 5 )->withQueryString();
		$filters = $request->only( [ 'deleted' ] );
		return inertia( 'Realtor/Index', get_defined_vars() );
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store( Request $request ) {
		//
	}

	public function show( Listing $listing ) {
		Gate::authorize( 'view', $listing );
		return inertia( 'Listing/Show', [ 
			'listing' => $listing,
		] );
	}

	public function edit( Listing $listing ) {
		Gate::authorize( 'update', $listing );
		return inertia( 'Listing/Edit', [ 
			'listing' => $listing
		] );
	}


	public function update( Request $request, Listing $listing ) {
		Gate::authorize( 'update', $listing );
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
		return redirect()->route( 'realtor-listing.index' )->with( [ 'success' => 'Listing Updated Successfully' ] );

	}


	public function destroy( Listing $listing ) {
		Gate::authorize( 'delete', $listing );
		$listing->delete();
		return redirect()->route( 'realtor-listing.index' )->with( [ 'success' => 'Listing Deleted Successfully' ] );

	}
}
