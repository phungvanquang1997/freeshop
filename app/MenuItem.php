<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
	
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;
	const STATUS_INIT = 1;

	protected $table = 'menu_items';

	protected $fillable = [
		'name',
		'slug',
		'link',
		'ordering',
		'icon',
		'status',
		'hash_id',
		'menu_id',
		'parent_id',
	];

	public function menu()
	{
		return $this->belongsTo('App\Menu', 'menu_id');
	}


	public static function getChildren($id, $backend = true)
	{
		$query = self::query()->where('parent_id', $id);
		if ($backend == false) {
			$query->where('status', MenuItem::STATUS_ACTIVE);
		}
		$result = $query->orderBy('ordering', 'asc')->get();
		if (!$result->isEmpty())
			return $result;
		return null;
	}

	public static function getParentOption($menu ,$parentId = 0, $currentId = 0, $str = '')
	{
		$html = '';
		$result = self::query();
		if($menu) {
			$result = $result->where('menu_id', (int) $menu);
		}
		$result = $result->where('parent_id', $parentId)->get();	  
		$selected = '';
		foreach ($result as $item) {	   		
			$name = $str.$item->name;

			if($currentId == $item->id) {
				$selected = 'selected = "selected"';
			} else {
				 $selected = '';
			}
			$html .= '<option ' .$selected. 'value="' . $item->id . '">' . $name . '</option>';
			$html .= self::getParentOption($menu, $item->id, $currentId, $str.'|--');
		}	 
	 	return $html;
	}	

}
