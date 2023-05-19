<?php 
namespace App;

use App\Helpers\UserHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupons extends Model
{

	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;
	const STATUS_INIT = 1;

	public static $status = [
		1 => 'lang.activate',//'Kích hoạt',
		0 => 'lang.deactivate',//'Vô hiệu',
	];

	const TYPE_CASH = 1;
	const TYPE_PERCEN = 2;

	public static $types = [
		1 => 'Tiền',
		2 => '% chiết khấu',
	];

	protected $table = 'coupons';

	protected $fillable = [
		'name',
		'type',
		'value',
		'start_date',
		'end_date',
		'num',
		'num_per_user',
		'num_used',
		'voucher',
		'status',
	];

	public function couponUserOrders()
	{
		return $this->hasMany('App\CouponUserOrder', 'coupon_id');
	}

}
