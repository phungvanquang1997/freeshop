<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Requests;

use App\Order;
use Illuminate\Http\Request;
use Mail;
use URL;
use Auth;
use App\User;
use Input;
use Session;
use App\Product;
use App\Helpers\Gmail;

class OrderController extends AdminController
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$query = Order::query();
		if (request()->has('orderId') && request()->get('orderId') != '') {
			$query->where('id', '=', request()->get('orderId'));
		}

		if (request()->has('status') && request()->get('status') != '') {
			$query->where('status', request()->get('status'));
		}

		if (request()->has('fullname') && request()->get('fullname') != '') {			
			$query->where('LOWER(name)', 'like', '%' . strtolower(trim(request()->get('fullname'))) . '%');
		}

		if (request()->has('phone') && request()->get('phone') != '') {
			$query->where('phone', 'like', '%' . trim(request()->get('phone')) . '%');
		}

		if (request()->has('date')) {
			$date = explode('-', request()->get('date'));
			$date[0] = str_replace('/', '-', $date[0]);
			if (isset($date[1])) {
				$date[1] = str_replace('/', '-', $date[1]);					
				$query->whereDate('created_at', '>=', date('Y-m-d', strtotime(trim($date[0]))));
				$query->whereDate('created_at', '<=', date('Y-m-d', strtotime(trim($date[1]))));
			}
		}

		$orders = $query->orderBy('created_at', 'desc')->get();

		return view('admin.pages.order.list')->with('orders', $orders);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function show($id)
	{
		$order = Order::find($id);
		$items = $order->items()->get();
		$voucher = $order->voucher();

		return view('admin.pages.order.details', compact('order', 'items', 'voucher'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update(Request $request, $id)
	{
		$order = Order::findOrFail($id);

		$data = $request->all();

		//re-calculate total amount
		$data['total_amount'] = 0;
		$items = $order->items()->get();
		if (count($items))
			foreach ($items as $item)
			{
				$data['total_amount'] += $item->price * $item->quantity;
			}

		$data['total_amount'] += $data['shipping_cost'];

		$order->update($data);

		if ($order->status == Order::ORDER_SUCCESS) {
			if (count($items))
				foreach ($items as $item)
				{
					$product = Product::find($item->product_id);
					$product->update(['total_sales' => $product->total_sales + $item->quantity
						]);
				}
		}
		if ($order->status == Order::ORDER_QUOTE) {
			Gmail::sendOrderQuote($order);
		}

		return redirect(URL::previous());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Auth::user()->group != User::IS_ADMINISTRATOR) {
			Session::flash('error', 'Xóa đơn hàng thất bại');
			return redirect()->back();
		}
		if ( Order::destroy($id)) {
			Session::flash('success', 'Xóa đơn hàng thành công');
		} else {
			Session::flash('warning', 'Xóa đơn hàng thất bại');
		}
		return redirect()->back();
	}

	/**
	 * Filter orders by status
	 * @param string $status
	 * @return \Illuminate\View\View
	 */
	public function filter($status = 'all')
	{
		if ($status == 'all')
		{
			$data['orders'] = Order::all();
		} else
		{
			$data['orders'] = Order::where('status', $status)->get();
		}

		$data['status'] = $status;

		return view('admin.pages.order.list', $data);
	}

}
