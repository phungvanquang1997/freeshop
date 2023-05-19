<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRelates extends Model
{
	
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;
	const STATUS_INIT = 1;

	protected $table = 'product_relates';

	protected $fillable = [
		'product_id',
		'product_related_id',
		'created_at',
		'updated_at'
	];

	public function product()
	{
		return $this->belongsTo('App\Product', 'product_id');
	}
}
