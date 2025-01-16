<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next) : Response
	{
		$token = $request->bearerToken();
		$routeName = Route::currentRouteName();


		if(in_array($routeName, RoleEnum::GLOBAL_ACCEPTED_ROUTES)) {
			return $next($request);
		} else if($token == RoleEnum::ADMIN) {
			if(!in_array($routeName, RoleEnum::ADMIN_ACCEPTED_ROUTES)) {
				return response()->json(['message' => 'Access denied.'], Response::HTTP_UNAUTHORIZED);
			}
		} else if($token == RoleEnum::MANAGER) {
			if(!in_array($routeName, RoleEnum::MANAGER_ACCEPTED_ROUTES)) {
				return response()->json(['message' => 'Access denied.'], Response::HTTP_UNAUTHORIZED);
			}
		}  else if($token == RoleEnum::CLIENT) {
			if(!in_array($routeName, RoleEnum::CLIENT_ACCEPTED_ROUTES)) {
				return response()->json(['message' => 'Access denied.'], Response::HTTP_UNAUTHORIZED);
			}
		}

		return $next($request);
	}
}