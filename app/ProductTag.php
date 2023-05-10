<?php 
namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Session;

class ProductTag extends Model {

	protected $table = 'product_tags';	

	protected $fillable = [
		'title', 
		'slug', 
		'product_id', 
	];

	protected $hidden = [];

	public function product()
	{
		return $this->belongsTo('App\Product', 'product_id');
	}
}
