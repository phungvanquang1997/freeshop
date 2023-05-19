<?php 
namespace App\Http\Controllers;

use App\Http\Requests;

use Illuminate\Http\Request;
use Cart;
use Session;
use App\Helpers\Currency;
use App\Setting;

class CartController extends BaseController
{
	protected $order_attr = 1;

	/**
	 * get view cart page
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
	    try {
            $cart = Cart::content();
            $total = Cart::total();
            $shipping = 0;
            $discount = 0;
            $gross = $total + $shipping - $discount;
            $hotline = Setting::findValueByKey('hotline');
            $data = [
                'cart' => $cart,
                'total' => $total,
                'shipping' => $shipping,
                'discount' => $discount,
                'gross' => $gross,
                'hotline' => $hotline,
            ];

            $metas_detail = [
                'meta_title_detail' => 'Giỏ hàng',
            ];
            $data = array_merge($data, $metas_detail);
        } catch (\Exception $e) {
	        dd($e);
        }
		return view('web.pages.cart.list', $data);
	}

	/**
	 * get item quantity
	 * @return mixed
	 */
	public function qty($rowId)
	{
		$item = Cart::get($rowId);

		return $item->qty;
	}

	/**
	 * get total cart quantity
	 * @return mixed
	 */
	public function totalQty()
	{
		return Cart::count();
	}

	/**
	 * add product to cart
	 * @param Request $request
	 * @return string
	 */
	public function add(Request $request)
	{
		$count = Cart::count(false);
		
		$options = [
			'url' => $request->get('url'),
			'image' => trim($request->get('image')),
			'color' => $request->get('color'),
			'note' => $request->get('note'),
			'sku' => $request->get('sku'),
		];

		try {
            Cart::add([
                'id' => $request->get('id'),
                'name' => $request->get('name'),
                'qty' => $request->get('qty') != '' ? (int)$request->get('qty') : 1,
                'price' => (float)$request->get('price'),
                'options' => $options,
            ]);
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
//		if (Session::has('cart-add') && Session::get('cart-add') == 'success')
//		{
//			return 'success';
//		} else
//		{
//			return 'error';
//		}
	}

	/**
	 * remove a product from cart
	 * @param $rowId
	 * @return array
	 */
	public function remove($rowId)
	{
		Cart::remove($rowId);
		$total = Cart::total();
		$gross = $total;
		return array(
			'qty'   => count(Cart::content()),
			'rowId' => $rowId,
			'gross' => Currency::displayBold($gross, 'vn'),
			'total' => Currency::displayBold($total, 'vn'),
		);
	}

	/**
	 * Update shop menu when cart update
	 * @return \Illuminate\View\View
	 */
	public function updateMenu()
	{
		return view('web.partials.header');
	}
	/**
	 * Update shop menu when cart update
	 * @return \Illuminate\View\View
	 */
	public function updateCartHeader()
	{
		return view('web.partials.cart');
	}


	/**
	 * update quantity of item in cart
	 * @param Request $request
	 * @return array
	 */
	public function updateQty(Request $request)
	{
		$rowId = $request->get('rowId');
		$qty = $request->get('qty');

		if ($qty)
		{
			Cart::update($rowId, $qty);
		} else
		{
			return array('error' => 'Cannot update item quantity!');
		}

		$item = Cart::get($rowId);
		$total = Cart::total();
		$gross = $total;
		return array(
			'qty'        => $item->qty,
			'totalPrice' => Currency::display($item->qty * $item->price, 'vn'),
			'gross' => Currency::displayBold($gross, 'vn'),
			'total' => Currency::displayBold($total, 'vn'),
		);

	}

	public function updatePrice(Request $request)
	{
		$rowId = $request->get('rowId');
		$price = $request->get('price');

		if ($price)
		{
			Cart::update($rowId, ['price' => $price]);
		} else
		{
			return array('error' => 'Cannot update item price!');
		}

		$item = Cart::get($rowId);

		return array(
			'price'        => $item->price,
			'totalPrice' => Currency::displayBold($item->qty * $item->price, 'cn'),
		);

	}

	public function updateNote(Request $request)
	{
		$rowId = $request->get('rowId');
		$note = $request->get('note');

		if ($note)
		{
			$item = Cart::get($rowId);
			$options = $item->options;
			$options['note'] = $note;
			Cart::update($rowId, [ 'options' => $options]);
		} else
		{
			return array('error' => 'Cannot update item note!');
		}

		$item = Cart::get($rowId);

		return array(
			'note'        => $item->note,
		);

	}

	public function updateName(Request $request)
	{
		$rowId = $request->get('rowId');
		$name = $request->get('name') != '' ? $request->get('name') : 'NoName';

		if ($name)
		{
			Cart::update($rowId, ['name' => $name]);
		} else
		{
			return array('error' => 'Cannot update item name!');
		}

		$item = Cart::get($rowId);

		return array(
			'name' => $item->name == 'NoName' ? '' : $item->name,
		);

	}



	/**
	 * Increase cart item by 1
	 * @param $rowId
	 * @return array
	 */
	public function qtyUp($rowId)
	{
		$item = Cart::get($rowId);

		Cart::update($rowId, $item->qty + 1);

		return array(
			'qty'        => $item->qty,
			'totalPrice' => Currency::currency($item->qty * $item->price),
		);
	}

	/**
	 * Decrease cart item by 1
	 * @param $rowId
	 * @return array
	 */
	public function qtyDown($rowId)
	{
		$item = Cart::get($rowId);

		if ($item->qty == 1)
		{
			Cart::remove($rowId);

			return array('empty' => true);
		}

		Cart::update($rowId, $item->qty - 1);

		return array(
			'qty'        => $item->qty,
			'totalPrice' => Currency::currency($item->qty * $item->price),
		);
	}

	public function destroy()
	{
		Cart::destroy();
		return redirect('/gio-hang.html');
	}
}
