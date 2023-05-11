<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;

use App\Order;
use App\OrderItem;
use App\OrderCustom;
use App\OrderCustomImage;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Session;
use URL;
use App\Helpers\ImageManager;
use Validator;
use App\Coupons;
use App\CouponUserOrder;
use App\Helpers\Currency;
use App\Product;
use Mail;

class CheckoutController extends BaseController
{

    public function __construct()
    {        
        parent::__construct();
    }
    
	public function index()
	{
		return view('web.pages.checkout.index');
	}

	public function create(Request $request)
	{
		/*
		if (Auth::guest()) {
			Session::flash('warning', 'Bạn phải đăng nhập mới có thể đặt hàng');
	    	return redirect('/gio-hang.html')->withInput();
		}*/

		if (Cart::count(false) == 0) {
			Session::flash('warning', 'Vui lòng chọn sản phẩm muốn mua trước khi đặt hàng');
	    	return redirect('/gio-hang.html')->withInput();
		}
		$postData = $request->all();
		$validator = Validator::make($postData, [
			'name' => 'required',
			'phone' => 'required',
			'address' => 'required',
			//'email' => 'required|email',
			'province_id' => 'required',
			'district_id' => 'required',
		],[
			'name.required' => 'Bạn phải điền họ tên',
			//'email.email' => 'Email không đúng định dạng',
			//'email.required' => 'Bạn phải điền email',
			'address.required' => 'Bạn phải điền địa chỉ',
			'phone.required' => 'Bạn phải điền số điện thoại',
			'province_id.required' => 'Bạn phải chọn Tỉnh/ TP',
			'district_id.required' => 'Bạn phải chọn Huyện/ Quận',
		]);

	    if ($validator->fails()) {
	    	$errors = $validator->messages()->all();
	    	$errorText = '';
	    	if(!empty($errors)) {
	    		foreach ($errors as $er) {
	    			$errorText .= $er . '<br/>';
	    		}
	    	}
	    	Session::flash('warning', $errorText);
	    	return redirect('/gio-hang.html')->withErrors($validator)->withInput();
		}
		$user = Auth::user();

		//Normal Order
		$data = $request->all();
		$data['note'] = $data['note'] ?? '';
		$data['discount'] = 0;
		if ($data['p_cart_coupon'] != '') {
			$coupon = Coupons::query()->where('voucher', $data['p_cart_coupon'])->whereDate('start_date', '<=', date('Y-m-d'))->whereDate('end_date', '>=', date('Y-m-d'))->where('status', 1)->first();
			if ($coupon && $coupon->num > $coupon->num_used) {
				$num_used = $coupon->couponUserOrders()->where('user_id', Auth::Id())->count();
				if ($num_used < $coupon->num_per_user) {
					
					if ($coupon->type == 1) {
						$data['discount'] = $coupon->value;
					} else {
						$total = Cart::total();
						$value = round(($total * $coupon->value) / 100);
						$data['discount'] = $value;
					}
				} 
			}
		}
		$data['total_amount'] = Cart::total();
    	$data['status'] = Order::ORDER_PENDING;

    	if (Auth::guest()) {
            $data['user_id'] = 0;
            $data['email'] = '';
            $data['deposit_value'] = 0;
            $data['shipping_cost'] = 0;
    		$order = Order::create($data);
    	} else {
            $data['user_id'] = $user->id;
            $data['email'] = $user->email;
            $data['deposit_value'] = 0;
            $data['shipping_cost'] = 0;
    		$order = $user->orders()->create($data);
    	}
		
        if ($order) {
    		$cart = Cart::content();
    		foreach ($cart as $item) {
    			$orderItems[] = new OrderItem(array(
    				'product_id' => $item->id,
    				'quantity'	 => $item->qty,
    				'price'  	 => $item->price,
                    'color'      => $item->options->color,
    			));
    		}
            $order->items()->saveMany($orderItems);
    		Cart::destroy();

    		if (isset($coupon) && !Auth::guest()) {
	    		$num_used = $coupon->num_used + 1;
	    		$coupon->update(['num_used' => $num_used]);
	    		$coupon_user_order = CouponUserOrder::create([
	    			'user_id' => Auth::Id(),
	    			'coupon_id' => $coupon->id,
	    			'order_id' => $order->id,
	    		]);
	    	}
	    	$customer = (object) $postData;

    		Session::flash('success', 'Bạn đã tạo đơn hàng thành công. Chúng tôi sẽ liên hệ lại với bạn trong vòng 24h!');

    		/*
			try {
			    Mail::send('emails.order', ['user' => $user, 'customer' =>  $customer, 'orderItems' => $cart, 'order' => $order, 'data' => $data], function ($m) use ($user, $order, $customer, $data) {
			        $m->from($customer->email, $customer->name);

			        $m->to('admin@thoitrangred.com', 'Admin')->subject('[Aogiasi.com] Đơn hàng số #' . $order->id);
			    });
			} catch(\Exception $e){
				return redirect('dat-hang-thanh-cong/don-hang-so-' . $order->id .'.html');
			}
			*/
    		return redirect('dat-hang-thanh-cong/don-hang-so-' . $order->id .'.html');
        }
		return redirect('/');
	}

	public function checkCoupon(Request $request)
	{
		if (Auth::guest()) {
			$res['code'] = 0;
		}
		$voucher = $request->get('voucher');
		$coupon = Coupons::query()->where('voucher', $voucher)->whereDate('start_date', '<=', date('Y-m-d'))->whereDate('end_date', '>=', date('Y-m-d'))->where('status', 1)->first();
		if ($coupon && $coupon->num > $coupon->num_used) {
			$num_used = $coupon->couponUserOrders()->where('user_id', Auth::Id())->count();
			if ($num_used < $coupon->num_per_user) {
				$res['code'] = 1;
				if ($coupon->type == 1) {
					$res['discount'] = Currency::displayBold($coupon->value, 'vn');
					$total = Cart::total();
					$gross = ($total - $coupon->value) <= 0 ? 0 : $total - $coupon->value;
					$res['gross'] = Currency::displayBold($gross, 'vn');
				} else {
					$total = Cart::total();
					$value = ($total * $coupon->value) / 100;
					$res['discount'] = Currency::displayBold($value, 'vn');
					$gross = ($total - $value) <= 0 ? 0 : $total - $value;
					$res['gross'] = Currency::displayBold($gross, 'vn');
				}
			} else {
				$res['code'] = 2;
			}
		} else {
			$res['code'] = 3;
		}
		echo json_encode($res);
	}

	public function success($id)
	{
		$order = Order::find($id);
		$orderItems = $order->items()->get();
		$relatedProducts = [];
		if ($orderItems) {
			foreach ($orderItems as $item) {
				if (!$item->product->relatedProducts()->get()->isEmpty()) {
					$relatedProducts = array_merge($relatedProducts, $item->product->relatedProducts()->get()->toArray());
				}
			}
		}
		$Ids = [];
		if ($relatedProducts) {
			foreach ($relatedProducts as $item) {
				$Ids[] = (int) $item['product_related_id'];
			}
		}

		$suggest = Product::whereIn('id', $Ids)
				->orderBy('created_at', 'desc')
				->get();
		
		return view('web.pages.checkout.success', [
			'order' => $order,
			'suggest' => $suggest,
		]);
	}

}
