<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Services\Auth\AuthService;
use Closure;
use Illuminate\Http\Request;
use function redirect;

class RedirectIfAuthenticated
{
	private AuthService $service;

	public function __construct(){
		$this->service = new AuthService();
	}
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
	 * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
	 */
	public function handle(Request $request, Closure $next)
	{
		if($this->service->get($request) !== null) {
			return redirect($request->query('auth_redirect', '/'));
		}
		return $next($request);
	}
}
