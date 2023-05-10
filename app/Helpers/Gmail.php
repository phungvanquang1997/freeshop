<?php 
namespace App\Helpers;

use Mail;
use App\Order;

class Gmail
{

	public static function sendWelcome($data)
	{
		Mail::send('web.emails.welcome', $data, function ($message) use ($data)
		{
			$message->to($data['to'])->subject('Đăng ký tài khoản trên hệ thống '. $_SERVER['SERVER_NAME']);
		});
	}

	public static function sendOrderCreatedEmail($order)
	{
		$data = [
			'to'   => $order->user->email,
			'name' => $order->user->name,
			'order_code' => $order->order_code,
		];

		Mail::send('web.emails.order_shipping_created', $data, function ($message) use ($data)
		{
			$message->to($data['to'])->subject('Thông báo đặt hàng thành công');
		});
	}

	public static function sendOrderQuote(Order $order)
	{
		$data = [
			'to'                   => $order->user->email,
			'name'                 => $order->user->name,
			'total_amount'     => $order->total_amount,
			'shipping_cost'          => $order->shipping_cost,
			'discount'          => $order->discount,
			'gross'          => $order->total_amount + $order->shipping_cost - $order->discount > 0 ? $order->total_amount + $order->shipping_cost - $order->discount : 0,
			'orderCode' 			=> '#' . $order->id,
		];

		Mail::send('web.emails.order_confirmation', $data, function ($message) use ($data)
		{
			$message->to($data['to'])->subject('Áo Giá Sỉ - Báo giá đơn hàng ' . $data['orderCode'] . ' trên ' . $_SERVER['SERVER_NAME']);
		});
	}
}

