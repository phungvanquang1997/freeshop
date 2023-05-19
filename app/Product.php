<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

	use SoftDeletes;

	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;

	static $status = [
		self::STATUS_ACTIVE => 'Kích hoạt',
		self::STATUS_INACTIVE => 'Vô hiệu',
	];

	protected $fillable = [
		'sku',
		'category_id',
		'name',
		'description',
		'market_price',
		'price',
		'promotion_price',
		'extenal_link',
		'in_stock',
		'quantity',
		'slug',
		'is_featured',
		'is_bestseller',
		'is_new',
		'is_promotion',
		'is_hot',
		'meta_title',
		'meta_keyword',
		'meta_description',
		'code_adword',
		'code_remarketing',
		'tags',
		'tags_slug',
		'content',
		'colors',
		'total_sales',
		'total_views',
		'special',
        'stock_status',
	];

	public function relatedProducts()
	{
		return $this->hasMany('App\ProductRelates');
	}

	public function listTags()
	{
		return $this->hasMany('App\ProductTag');
	}

	public function category()
	{
		return $this->belongsTo('App\Category');
	}

	public function images()
	{
		return $this->hasMany('App\ProductImage');
	}

	public function comments()
	{
		return $this->hasMany('App\Comment', 'post_id');
	}

	public function mainImage()
	{
		$firstImage = $this->images()->where('is_featured', 1)->first();

		return $firstImage ? $firstImage : (new ProductImage());
	}

	public static function availabilities()
	{
		return [
			'in_stock'    => 'Còn hàng',
			'out_of_stock' => 'Hết hàng',
		];
	}

	public function available()
	{
		$list = self::availabilities();
		foreach ($list as $key => $value)
		{
			if ($key === $this->availability) return $value;
		}

		return null;
	}

	public static function findBySlug($slug)
	{
		return self::query()->where('slug', $slug)->first();
	}

	public function scopeFilterWithCategory($query, $categoryId)
	{
		$query->where('category_id', '=', $categoryId);

		$this->scopeOtherParams($query);

		return $query;
	}

	public function scopeIsFeatured($query)
	{
		$query->where('is_featured', '=', 1);

		return $query;
	}

	public function scopeIsNew($query)
	{
		$query->where('is_new', '=', 1);

		return $query;
	}

	public function scopeIsPromotion($query)
	{
		$query->where('is_promotion', '=', 1);

		return $query;
	}		
	public function scopeIsBestSeller($query)
	{
		$query->where('is_bestseller', '=', 1);

		return $query;
	}

	public function tags()
	{
		if (isset($this->tags) && $this->tags != '') {
			$tags = explode(',', $this->tags);
			return $tags;
		}
		return [];
	}

	public function colors()
	{
		if ($this->colors != '') {
			$colors = explode(',', $this->colors);
			return $colors;
		}
		return [];
	}

	public function status()
	{
		$arr = self::$status;

		foreach ($arr as $key => $value)
		{
			if ($this->status == $key)
				return $value;
		}

		return null;
	}

	public static function allStatus()
	{
		return self::$status;
	}	
}
