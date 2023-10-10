<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

use function auth;
use function redirect;
use function response;

class AuthController extends Controller
{
	private AuthService $service;

	public function __construct()
	{
		$this->service = new AuthService();
	}

	public function login(Request $request)
	{
		$request->validate([
			'email' => 'required',
			'password' => 'required'
		]);

		$email = $request->post('email');
		$password = $request->post('password');

		/** @var User $user */
		$user = User::query()->where('email', '=', $email)->first();
		if ($user === null || !$user->isPasswordValid($password)) {
			$request->session()->flash('login_error', 'Invalid email or password');
			return response()->view('pages.auth.login', [], 401);
		}
		$this->service->set($request, $user);

		if ($user->isAdmin()) {
			return redirect('/dashboard/admin');
		}

		if ($user->isWarehouseStaff()) {
			return redirect('/dashboard/petugas');
		}

		// Redirect Requester
		return redirect('/dashboard/pemohon');
	}

	public function logout(Request $request)
	{
		auth()->logout();

		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return redirect('/');
	}
}
