<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model {

	protected $fillable = [
		'id',
		'name',
		'ordering',
		'province_id'
	];


	public function province()
	{
		return $this->belongsTo('App\Province', 'province_id');
	}
}
