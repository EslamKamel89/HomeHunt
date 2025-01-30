<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class IndexController extends Controller {
	/**
	 * Summary of index
	 * @return \Inertia\Response|\Inertia\ResponseFactory
	 */
	public function index() {
		return inertia( 'Index/Index', [ 
			'message' => 'Hello from laravel'
		] );
	}

	/**
	 * Summary of show
	 * @param \App\Models\Listing $listing
	 * @return \Inertia\Response|\Inertia\ResponseFactory
	 */
	public function show( Listing $listing ) {
		return inertia( 'Index/Show' );
	}
}
