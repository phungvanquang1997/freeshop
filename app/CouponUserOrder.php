<?php 
namespace App;

use App\Helpers\UserHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponUserOrder extends Model
{

	protected $table = 'coupon_user_orders';

	protected $fillable = [
		'user_id',
		'coupon_id',
		'order_id',
	];

	public function coupon()
	{
		return $this->belongsTo('App\Coupons', 'coupon_id');
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function order()
	{
		return $this->belongsTo('App\Order', 'order_id');
	}
}
