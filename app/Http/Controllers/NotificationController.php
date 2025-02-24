<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller {
	public function index( Request $request ) {
		return inertia( 'Notification/Index', [ 
			'notifications' => auth()->user()->notifications()->paginate( 5 )
		] );
	}

	public function create() {
	}

	public function store( Request $request ) {
	}

	public function show( string $id ) {
	}

	public function edit( string $id ) {
	}

	public function update( Request $request, string $id ) {
	}

	public function destroy( string $id ) {
	}
}
