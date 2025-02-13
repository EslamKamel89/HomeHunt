<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller {
	public function index() {
	}

	public function create( Listing $listing ) {
		$csrf = csrf_token();
		$listing->load( [ 'listingImages' ] );
		return inertia( 'Realtor/ListingImage/Create', get_defined_vars() );
	}

	public function store( Listing $listing, Request $request ) {
		// dd( $request->all(), $request->allFiles() );
		$imagesArr = collect( [] );
		if ( $request->hasFile( 'images' ) ) {
			/** @var \Illuminate\Http\UploadedFile $file */
			foreach ( $request->file( 'images' ) as $index => $file ) {
				$path = $file->store( 'images', 'public' );
				$imagesArr->add( [ 
					'listing_id' => $listing->id,
					'filename' => $path,
					'created_at' => now(),
					'updated_at' => now(),
				] );
			}
			ListingImage::insert( $imagesArr->toArray() );
		}
		return redirect()->back()->with( [ 'success' => 'images uploaded successfully' ] );
	}

	public function show( ListingImage $listingImage ) {
	}

	public function edit( ListingImage $listingImage ) {
	}

	public function update( Request $request, ListingImage $listingImage ) {
	}

	public function destroy( Listing $listing, ListingImage $listingImage ) {
		Storage::disk( 'public' )->delete( str( $listingImage->filename )->explode( 'storage/' )->last() );
		$listingImage->delete();
		return redirect()->back()->with( [ 'success' => 'Image deleted successfully' ] );
	}
}
