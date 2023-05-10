<?php 
namespace App\Http\Composers;

use Cart;
use App\Category;
use Illuminate\Contracts\View\View;

class CartComposer
{

	public function compose(View $view)
	{

		$cart = Cart::content();

		$linkCount = 0;
		if (Cart::count(false) >= 1) {
			$link = '';
			foreach ($cart as $key => $value) {
				if ($link != $value->options->url) {
					$linkCount++;
					$link = $value->options->url;
				}
			}
		}

		$data['cartRow'] = $linkCount;

		$data['cartQty'] = Cart::count();

		$data['cartTotal'] = Cart::total();

		return $view->with($data);
	}
}