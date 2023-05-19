<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

	const TYPE_ORDER = 1;
	const TYPE_COMPLAIN = 2;
	const TYPE_PACKAGE = 3;

	protected $table = 'notifications';

	protected $fillable = [
		'id',
		'data',
		'type',
		'content',
		'status',
		'created_by',
	];

	public function userNotification()
	{
		return $this->hasMany('App\UserNotification');
	}

}
