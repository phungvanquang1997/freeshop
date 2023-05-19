<?php 
namespace App;

use App\Helpers\UserHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{

	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;
	const STATUS_INIT = 1;
	const STATUS_CATEGORY = 5;

	const POS_TOP = 1;
	const POS_BOTTOM_LEFT = 2;
	const POS_BOTTOM_RIGHT = 3;
	const POS_BOTTOM_MIDDLE = 4;

	public static $positions = [
		1 => 'Main menu',
		2 => 'Footer left',
		3 => 'Footer right',
		4 => 'Footer center'
	];

	public static $status = [
		1 => 'lang.activate',//'Kích hoạt',
		0 => 'lang.deactivate',//'Vô hiệu',
	];

	protected $table = 'menus';

	protected $fillable = [
		'name',
		'position',
		'status',
		'lang_id',
		'hash_id',
	];

	public function menuItems()
	{
		return $this->hasMany('App\MenuItem', 'menu_id');
	}

}
