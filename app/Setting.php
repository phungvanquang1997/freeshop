<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $table = 'settings';

	protected $fillable = [
		'key',
		'name',
		'value',
	];

	public static function findByKey($key)
	{
		return self::query()->where('key', $key)->first();
	}

	public static function findValueByKey($key)
	{
		$model =  self::query()->where('key', $key)->first();
		if ($model)
			return $model->value;
		return null;
	}
}
