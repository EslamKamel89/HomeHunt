<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller {
	public function create() {
		return inertia( 'Auth/Login' );
	}
	public function store( Request $request ) {
		$this->pr( $request->all(), 'Login form' );
		$data = $request->validate( [ 
			'email' => [ 'required', 'email' ],
			'password' => [ 'required', 'max:255' ]
		] );
		if ( ! Auth::attempt( $data, true ) ) {
			throw ValidationException::withMessages( [ 'email' => 'Authentication failed' ] );
		}
		$request->session()->regenerate();
		return redirect()->intended( '/listing' );
	}
	public function destroy( Request $request ) {
		if ( auth()->user() )
			auth()->logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return redirect()->intended( '/' );
	}
}
