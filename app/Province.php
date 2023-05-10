<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model {

	protected $fillable = [
		'id',
		'name',
		'ordering',
	];


	public function districts()
	{
		return $this->hasMany('App\District');
	}

	public static function loadModel($id) {
		$province = self::find($id);
		return $province;
	}

	public static function listDistrict($id = null)
	{	
		if ($id == null) {
			return [];
		}
		$province = self::loadModel($id);
		$districts = $province->districts()->get();
		$listDistrict = [];
		foreach ($districts as $item) {
			$listDistrict[$item->id] = $item->name;
		}
		return $listDistrict;
	}

	public static function listProvince()
	{
		$provinces = self::orderBy('ordering', 'asc')->get();
		$listProvince = ['' => '--Chọn Tỉnh/ TP--'];
		foreach ($provinces as $item) {
			$listProvince[$item->id] = $item->name;
		}
		return $listProvince;
	}
}
