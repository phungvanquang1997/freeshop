<?php 
namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;

class Category extends Model
{
	//use SoftDeletes;

	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;

	const CATEGORY_PRODUCT = 'product';
	const CATEGORY_POST = 'post';

	protected $dates = ['deleted_at'];
    protected $table = 'categories';

	protected $fillable = [
		'parent_id',
		'name',
		'order',		
		'slug',
		'lang_id',
		'type',
		'icon',
		'thumb',
		'content',
		'show_home_block',
		'meta_title',
		'meta_keyword',
		'meta_description',
		'status',
		'is_deal'
	];

	public function products()
	{
		return $this->hasMany('App\Product');
	}

	public function posts()
	{
		return $this->hasMany('App\Post');
	}

	public function scopeActive($query)
	{
		return $query->whereActive(self::STATUS_ACTIVE);
	}

	public function scopeParents($query)
	{
		return $query->whereParentId(0);
	}

	public function scopeProductType($query)
	{
		return $query->whereType(self::CATEGORY_PRODUCT);
	}

	public function scopePostType($query)
	{
		return $query->whereType(self::CATEGORY_POST);
	}

	public function parent()
	{
		return $this->belongsTo('App\Category', 'parent_id');
	}

	public function children()
	{
		return $this->hasMany('App\Category', 'parent_id');
	}

	public static function findBySlug($slug)
	{
		return self::query()->where('slug', $slug)->first();
	}

	public static function getCategoryOption($type ,$parentId = 0, $currentId = 0, $str = '', $exclude = 0) {
	  $html = '';
	  $result = self::query();
	  $result->where('lang_id', Session('lang', 'vi'));
	  if($type) {
	  	$result = $result->where('type', $type);
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

	public static function categoriesIds($categoryId = 0)
	{
		$symbol = $strId = '';		 
		if (!is_null($categoryId) && $categoryId > 0) {			
			$category = Category::find($categoryId);	
			if ($category) {
				$strId .= $category->id;
				$children = $category->children()->orderBy('order', 'asc')->get();
				if (count($children)) {					
					foreach ($children as $item) {						
						$strId .= ',' . self::categoriesIds($item->id);
					}
				}
			}			
		}

		return $strId;
	}	
}
