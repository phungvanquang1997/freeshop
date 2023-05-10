<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

	const IS_ADMIN = 1;
	const STATUS_INACTIVE = 0;
	const STATUS_ACTIVE = 1;

	const IS_GUEST = 0;
	const IS_ACCOUNTANT = 4;
	const IS_TELLER = 2;
	const IS_STOREKEEPER = 3;
	const IS_ADMINISTRATOR = 1;
	const IS_CHECKINER = 5;
	const IS_SHIPER = 6;
	const IS_CARER = 7;

	public static $groups = [
		self::IS_ADMINISTRATOR => 'Administrator',
		self::IS_TELLER => 'Giao dịch viên',
		self::IS_STOREKEEPER => 'Nhân viên kho',
		self::IS_ACCOUNTANT => 'Kế toán',
		self::IS_CHECKINER => 'NV kiểm hàng',
		self::IS_SHIPER => 'NV Giao hàng',
		self::IS_CARER => 'NV Chăm sóc khách hàng',
		self::IS_GUEST => 'Khách hàng',
	];

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'phone', 'address', 'acc_money', 'acc_expired_at', 'group', 'is_admin', 'auth_token', 'status', 'facebook_id', 'google_id', 'province_id', 'district_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function orders()
	{
		return $this->hasMany('App\Order');
	}

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function province()
    {
    	return $this->belongsTo('App\Province', 'province_id');
    }

    public function district()
    {
    	return $this->belongsTo('App\District', 'district_id');
    }

    public static function fullAddress($id)
    {
    	$user = self::find($id);
    	$address = $user->address;
    	if ($user->district_id != 0) 
    		$address .= ' - ' . $user->district->name;
    	if ($user->province_id != 0)
    		$address .= ' - ' . $user->province->name;
    	return $address;
    }
}
