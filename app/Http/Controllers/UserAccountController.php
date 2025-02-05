<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller {
	public function create() {
		return inertia( 'UserAccount/Create' );
	}
	public function store( Request $request ) {
		$data = $request->validate( [ 
			'name' => 'required|string|max:255',
			'email' => 'required|email|unique:users',
			'password' => 'required|string|max:255|confirmed',
		] );
		$user = User::create( $data );
		Auth::login( $user );
		$request->session()->regenerate();
		return redirect()
			->intended( '/listing' )
			->with( 'success', 'Account created successfully!' );
	}
}
