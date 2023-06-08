<?php 
namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;

class Post extends Model {

	use SoftDeletes;

	protected $table = 'posts';	

	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;

	const TYPE_POST = 'post';
	const TYPE_PAGE = 'page';

	protected $dates = ['deleted_at'];

	protected $fillable = [
		'image', 
		'title', 
		'description', 
		'content', 
		'slug', 
		'category_id', 
		'user_id', 
		'is_featured', 
		'lang_id', 
		'status',
		'user_id',
		'meta_title',
		'meta_keyword',
		'tags_slug',
		'meta_description',
		'tags',
		'type'
	];

	protected $hidden = [];

	public function category()
	{
		return $this->belongsTo('App\Category', 'category_id');
	}

	public function tags()
	{
		return $this->hasMany('App\PostTag');
	}

	public function scopeSpecial($query)
	{
		return $query->where('is_featured', 1);
	}

	public static function findBySlug($slug)
	{
		return self::query()->where('slug', $slug)->first();
	}

	public function getAllPosts($categoryId)
    {
        return self::query()->where('category_id', $categoryId)
                            ->where('type', config('constant.post'))
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
    }

    public function getAllPostsMostView()
    {
        return self::query()->orderBy('total_views', 'desc')
                            ->take(10)
                            ->get();

    }

    public function getPostRelative($categoryId, $postId)
    {
        return self::where('category_id', $categoryId)
                            ->where('id', '<>', $postId)
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
    }

    public function getPostDetail($postSlug)
    {
        return self::query()->where('slug', $postSlug)->first();
    }

}
