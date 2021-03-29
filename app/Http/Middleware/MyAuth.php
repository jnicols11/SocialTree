<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;
use Closure;

class MyAuth
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		// Step 1: You can use the following to get the route URI $request->path() or we can also use $request->is()
		$path = $request->path();
		Log::info("Entering My Auth in handle() at path: " . $path);
		
		// Step 2: Run the business rules that check for the URI's that you do not need to secure
		$secureCheck = true;
		if($request->is('/') || $request->is('login') || $request->is('register')) {
			$secureCheck = false;
		}
		Log::info($secureCheck ? "Security Middleware in handle()... Needs Security" : "Security Middleware in handle().... No Security Required");
		
		// Step 3: If entering a secure URI with no security token then redirect to index
		if(session()->get('security') == 'enabled') {
			return $next($request);
		}
		if($secureCheck) {
			Log::info("leaving My Security Middle in handle() doing a redirect to home");
			return redirect('/');
		}
	}
}
