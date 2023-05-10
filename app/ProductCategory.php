<?php 
namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;

class ProductCategory extends Model
{
	use SoftDeletes;

	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;

	const TYPE_PRODUCT = 1;
	const TYPE_NEWS = 2;
	const TYPE_SOURCE = 3;

	protected $dates = ['deleted_at'];

	protected $fillable = [
		'parent_id',
		'name',
		'order',
		'slug',
		'type',
		'show_home_block',
		'lang_id',
		'meta_title',
		'meta_keyword',
		'meta_description',
	];

	public function products()
	{
		return $this->hasMany('App\Product');
	}

	public function scopeActive($query)
	{
		return $query->whereActive(self::STATUS_ACTIVE);
	}

	public function scopeParents($query)
	{
		return $query->whereParentId(0);
	}

	public function parent()
	{
		return $this->belongsTo('App\ProductCategory', 'parent_id');
	}

	public function children()
	{
		return $this->hasMany('App\ProductCategory', 'parent_id');
	}

	public static function findBySlug($slug)
	{
		return self::query()->where('slug', $slug)->first();
	}

	public static function getCategoryOption($type ,$parentId = 0, $currentId = 0, $str = '', $exclude = 0) {
	  $categories_doc = array();
	  $html = '';
	  $result = self::query();
	  $result->where('lang_id', Session('lang', 'vi'));
	  if($type) {
	  	$result = $result->where('type', (int) $type);
	  }
	  if ($exclude != 0) {
	  	$cate = self::find($exclude);
	  	if($cate){
	  		$ids = [$cate->id];
	  		$children = $cate->children()->get();
	  		if ($children) {
	  			foreach ($children as $key => $value) {
	  				$ids[] = $value->id;
	  			}
	  		}
	  		$result->whereNotIn('id', $ids);
	  	}
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
	  		$html .= self::getCategoryOption($type, $item->id, $currentId, $str.'|--');
	  }	 
	  return $html;
	}	
}
