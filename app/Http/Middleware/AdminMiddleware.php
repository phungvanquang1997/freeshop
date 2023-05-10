<?php 
namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * Using for check admin
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{
		if (Auth::check() && Auth::user()->is_admin) {
			return $next($request);
		}

		return redirect('admin/auth');
	}

}
