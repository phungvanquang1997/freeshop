<?php 
namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Session;

class Page extends Model {

	protected $table = 'pages';	

	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;

	protected $dates = ['deleted_at'];

	protected $fillable = [
		'image', 
		'title', 
		'description', 
		'content', 
		'slug', 
		'user_id', 
		'status',
		'user_id',
		'meta_title',
		'meta_keyword',
		'meta_description'
	];

	protected $hidden = [];

	public static function findBySlug($slug)
	{
		return self::query()->where('slug', $slug)->first();
	}
}
