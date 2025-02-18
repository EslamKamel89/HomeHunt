<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
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
			->withCount( 'listingImages' )
			->withCount( 'offers' )
			->paginate( 5 )->withQueryString();
		$filters = $request->only( [ 'deleted', 'order', 'by' ] );
		return inertia( 'Realtor/Index', get_defined_vars() );
	}


	public function create() {
		Gate::authorize( 'create', Listing::class);
		return inertia( 'Listing/Create' );
	}


	public function store( Request $request ) {
		Gate::authorize( 'create', Listing::class);
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
		$listing
			->load( [ 'listingImages', 'offers' ] )
			->loadCount( 'listingImages' );
		/** @var Offer|null $offer */
		$offer = ! auth()->id() || $listing->user_id == auth()->id() ?
			null :
			$listing->offers()->byMe()->first();
		return inertia( 'Listing/Show', [ 
			'listing' => $listing,
			'offer' => $offer,
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
		info( 'hello' );
		Gate::authorize( 'delete', $listing );
		$listing->delete();
		return redirect()->route( 'realtor-listing.index', )->with( [ 'success' => 'Listing Deleted Successfully' ] );

	}
	public function restore( Listing $listing ) {
		$listing->restore();
		return redirect()
			->route( 'realtor-listing.index', )->with( [ 'success', 'Listing Restored Successfully' ] );
	}

}
