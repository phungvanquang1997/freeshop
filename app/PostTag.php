<?php 
namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Session;

class PostTag extends Model {

	protected $table = 'post_tags';	

	protected $fillable = [
		'title', 
		'slug', 
		'post_id', 
	];

	protected $hidden = [];

	public function post()
	{
		return $this->belongsTo('App\Post', 'post_id');
	}
}
