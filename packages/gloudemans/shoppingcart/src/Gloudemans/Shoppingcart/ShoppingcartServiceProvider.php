<?php namespace Gloudemans\Shoppingcart;

use Illuminate\Support\ServiceProvider;

class ShoppingcartServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('cart', function($app)
		{
			$session = $app['session'];
			$events = $app['events'];
			return new Cart($session, $events);
		});
	}
}