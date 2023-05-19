<?php 
namespace App\Http\Middleware;

use Closure;
use Auth;
use Route;
use App\User;
use Session;

class CheckPermission {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $group;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Auth $auth)
	{
		$this->group = $auth::user()->group;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$currentPath= Route::getFacadeRoot()->current()->uri();
		if ($currentPath == 'admin' || $currentPath == 'admin/auth' || $currentPath == 'admin/auth/logout' || $currentPath == 'admin/auth/login' || $currentPath == 'admin/profile/{id}' || $currentPath == 'admin/user/change-password/{id}' || $currentPath == 'admin/my_order' || $currentPath == 'admin/my_order_service') {
			return $next($request);
		}
		if ($this->group == User::IS_ADMINISTRATOR) {
			return $next($request);
		} elseif ($this->group == User::IS_TELLER) {
			$patent2 = '/^(admin\/order_shipping$)|(admin\/order_shipping\/.*)/';
			$patent3 = '/^(admin\/order-shipping-report$)|(admin\/order-shipping-report\/.*)/';
			if (preg_match($patent2, $currentPath) || preg_match($patent3, $currentPath)) {
				return $next($request);
			}

			if ($currentPath == 'admin/complain' || $currentPath == 'admin/complain/{complain}' || $currentPath == 'admin/order_shipping_service' ||  $currentPath == 'admin/user' || $currentPath == 'admin/user/{user}' || $currentPath == 'admin/user/recharge/{id}/{complain?}' || $currentPath == 'admin/user/put-recharge/{id}') {
				return $next($request);
			}
			$patent2 = '/^(admin\/payment$)|(admin\/payment\/.*)/';
			if (preg_match($patent2, $currentPath)) {
				return $next($request);
			}
			$patent3 = '/^(admin\/product-source$)|(admin\/product-source\/.*)/';
			$patent4 = '/^(admin\/category$)|(admin\/category\/.*)/';
			if ((preg_match($patent3, $currentPath) || preg_match($patent4, $currentPath)) && Auth::user()->email == 'hoado6495@gmail.com') {
				return $next($request);
			} 
			
		} elseif ($this->group == User::IS_STOREKEEPER) {
			$patent2 = '/^(admin\/order_shipping$)|(admin\/order_shipping\/.*)/';
			$patent3 = '/^(admin\/barcode$)|(admin\/barcode\/.*)/';
			$patent4 = '/^(admin\/order-shipping-report$)|(admin\/order-shipping-report\/.*)/';
			if (preg_match($patent2, $currentPath) || preg_match($patent3, $currentPath) || preg_match($patent4, $currentPath)) {
				return $next($request);
			}
			
			if ($currentPath == 'admin/complain' || $currentPath == 'admin/complain/{complain}' || $currentPath == 'admin/order_shipping_service') {
				return $next($request);
			}
		} elseif ($this->group == User::IS_ACCOUNTANT) {
			$patent2 = '/^(admin\/payment$)|(admin\/payment\/.*)/';
			$patent3 = '/^(admin\/order-shipping-report$)|(admin\/order-shipping-report\/.*)/';
			$patent4 = '/^(admin\/order-shipping-report$)|(admin\/order-shipping-report\/.*)/';
			if (preg_match($patent2, $currentPath) || preg_match($patent3, $currentPath) || preg_match($patent4, $currentPath)) {
				return $next($request);
			}
			if ($currentPath == 'admin/order_shipping' || $currentPath == 'admin/order_shipping/{order_shipping}' || $currentPath == 'admin/user' || $currentPath == 'admin/user/{user}' || $currentPath == 'admin/user/recharge/{id}/{complain?}' || $currentPath == 'admin/user/put-recharge/{id}' || $currentPath == 'admin/order_shipping_service') {
				return $next($request);
			}
		} elseif ($this->group == User::IS_CHECKINER) {
			$patent2 = '/^(admin\/order_shipping$)|(admin\/order_shipping\/.*)/';
			$patent4 = '/^(admin\/order-shipping-report$)|(admin\/order-shipping-report\/.*)/';
			if (preg_match($patent2, $currentPath) || preg_match($patent4, $currentPath)) {
				return $next($request);
			}
			
			if ($currentPath == 'admin/complain' || $currentPath == 'admin/complain/{complain}' || $currentPath == 'admin/order_shipping_service') {
				return $next($request);
			}
		
		} elseif ($this->group == User::IS_SHIPER) {
			$patent2 = '/^(admin\/order_shipping$)|(admin\/order_shipping\/.*)/';
			$patent3 = '/^(admin\/order-shipping-report$)|(admin\/order-shipping-report\/.*)/';
			if (preg_match($patent2, $currentPath) || preg_match($patent3, $currentPath)) {
				return $next($request);
			}
			if ($currentPath == 'admin/complain' || $currentPath == 'admin/complain/{complain}' || $currentPath == 'admin/order_shipping_service') {
				return $next($request);
			}
			$patent2 = '/^(admin\/payment$)|(admin\/payment\/.*)/';
			if (preg_match($patent2, $currentPath)) {
				return $next($request);
			}
		} elseif ($this->group == User::IS_CARER) {
			$patent2 = '/^(admin\/order_shipping$)|(admin\/order_shipping\/.*)/';
			if (preg_match($patent2, $currentPath)) {
				return $next($request);
			}
			if ($currentPath == 'admin/complain' || $currentPath == 'admin/complain/{complain}' || $currentPath == 'admin/order_shipping_service') {
				return $next($request);
			}
		}

		Session::flash('error', 'Bạn không có quyền truy nhập');
		return redirect('/admin');
	}

}
