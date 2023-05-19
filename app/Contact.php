<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

	const TYPE_CONTACT = 1;
	const TYPE_PARTNER = 2;

	public static $types = [
		0 => 'Liên hệ',
		1 => 'Liện hệ',
		2 => 'Hợp tác',
	];

	protected $table = 'contacts';

	protected $fillable = ['name', 'email', 'content', 'phone', 'position', 'company', 'website', 'address', 'type'];

	protected $hidden = [];

}
