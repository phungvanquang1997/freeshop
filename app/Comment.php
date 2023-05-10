<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	protected $fillable = [
		'content',
		'name',
		'user_id',
		'email',
		'star',
		'level',
		'parent_id',
		'post_id',
		'status',
	];

	public function post()
	{
		return $this->belongsTo('App\Post');
	}

	public function product()
	{
		return $this->belongsTo('App\Product', 'post_id');
	}

	public function children()
	{
		return $this->hasMany('App\Comment', 'parent_id')->where('status', 1);
	}

}
