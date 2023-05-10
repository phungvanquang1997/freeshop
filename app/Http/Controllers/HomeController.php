<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Session;
use App\Brand;
use App\Category;
use App\Helpers\ImageManager;
use App\Helpers\SerializedAttribute;
use App\Http\Requests;
use App\Product;
use App\ProductImage;
use App\Banner;
use App\BannerItem;
use Illuminate\Database\Eloquent\Collection;
use App\Post;

class HomeController extends BaseController
{

    public function __construct()
    {        
        parent::__construct();
    }

	public function index()
	{
		$data = [];

		$featuredProducts = Product::IsNew()->orderBy('created_at', 'desc')->limit(12)->get();

		$data['featuredProducts'] = $featuredProducts;

		$categories = Category::ProductType()->where('show_home_block', '=', 1)->get();
		$categoryProducts = [];
		foreach ($categories as $category) {
			$strIds = Category::categoriesIds($category->id);
			$arrayID = @array_map('intval', @explode(',', $strIds));	
			$items = Product::whereIn('category_id', $arrayID)
				->orderBy('created_at', 'desc')
				->limit(12)->IsFeatured()->get();
			$category->items = $items;
			$categoryProducts[] = $category;
		}

		$data['categoryProducts'] = $categoryProducts;

		$sliders = Banner::where('type', '=', Banner::TYPE_SLIDER)->where('position', '=', Banner::POS_TOP_DOWN)->where('status', '=', Banner::STATUS_ACTIVE)->get()->first();
		if ($sliders)
			$data['sliders'] = $sliders->bannerItems()->where('status', '=', BannerItem::STATUS_ACTIVE)->get();

		$excludeCate = Category::findBySlug('chinh-sach');
		$lastnews = Post::where('posts.status', 1)->orderBy('created_at', 'desc')->limit(5);
		if ($excludeCate) {
			$lastnews->where('category_id', '<>', $excludeCate->id);
		}
		$lastnews = $lastnews->get();
		$data['lastnews'] = $lastnews != null ? $lastnews : [];

		$cateParents = Category::ProductType()->where('parent_id', 0)->where('status', 1)->orderBy('order', 'asc')->get();
		$data['cateParents'] = $cateParents;

		return view('web.pages.home.index', $data);
	}
}
