<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//status
define('ORDER_PENDING', 'pending');
define('ORDER_DEPOSIT', 'deposit');
define('ORDER_PROCESSING', 'processing');
define('ORDER_COMPLETE', 'complete');
define('ORDER_CANCEL', 'canceled');

class Order extends Model
{

	protected $table = 'orders';

	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
    const ORDER_PENDING = 1;
    const ORDER_RESOLVING = 2;
    const ORDER_PAYED = 3;
    const ORDER_SUCCESS = 9;
    const ORDER_INACTIVE = 0;
    const ORDER_QUOTE = 4;

	static $status = [
		1 => 'Chờ duyệt',
		4 => 'Báo giá',
		3 => 'Đã thanh toán',
		2 => 'Đang xử lý',
		9 => 'Thành công',
        0 => 'Hủy bỏ',
	];

	public static function allStatus()
	{
		return self::$status;
	}

	public function status()
	{
		$arr = self::$status;

		foreach ($arr as $key => $value)
		{
			if ($this->status == $key) return $value;
		}

		return null;
	}

	protected $fillable = ['user_id', 'name', 'phone', 'email', 'address', 'note',
		'deposit_value', 'shipping_cost', 'total_amount', 'status', 'discount', 'province_id', 'district_id'];

	protected $hidden = [];

	public function items()
	{
		return $this->hasMany('App\OrderItem');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function customs()
	{
		return $this->hasOne('App\OrderCustom');
	}

	public function voucher()
	{
		$coupon_order = CouponUserOrder::where('order_id', $this->id)->first();
		if ($coupon_order) {
			$voucher = $coupon_order->coupon->voucher;
			return $voucher;
		}
		return null;
	}

	public static function fullAddress($order)
	{
		$add = $order->address;
		$province = Province::find($order->province_id);
		if ($province) {
			$add .= ' - ' . $province->name;
		}
		$district = District::find($order->district_id);
		if ($district) {
			$add .= ' - ' . $district->name;
		}
		return $add;
	}

}
