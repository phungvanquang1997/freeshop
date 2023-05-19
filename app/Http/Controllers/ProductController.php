<?php
namespace App\Http\Controllers;

use App\Banner;
use App\BannerItem;
use App\Brand;
use App\Category;
use App\Helpers\ImageManager;
use App\Helpers\SerializedAttribute;
use App\Http\Requests;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductImage;
use App\Helpers\MyHtml;
use App\ProductRelates;
use App\ProductTag;
use Illuminate\Database\Eloquent\Collection;
use App\Setting;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Pagination\Paginator;
use App\Post;

class ProductController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

	const PAGINATION_ITEM_PER_PAGE = 12;

	public function index()
	{
		$data['products'] = Product::all();

		return view('pages.products', $data);
	}

	public function category($slug, ProductRequest $request)
	{
		$category = Category::where('type', '=', Category::CATEGORY_PRODUCT)
		->where('slug', '=', $slug)
		->get()->first();

		if (!$category) {
			return redirect('/');
		}

		$isNew = $request->get('is_new');

		$isBestseller = $request->get('is_bestseller');

		$strIds = Category::categoriesIds($category->id);
		$arrayID = @array_map('intval', @explode(',', $strIds));
		$children = $category->children()->orderBy('order', 'asc')->get();

		$query = Product::whereIn('category_id', $arrayID);
		if (!is_null($isNew)) {
			$query->where('is_new', '=', 1);
		}

		if (!is_null($isBestseller)) {
			$query->where('is_bestseller', '=', 1);
		}

		$query->orderBy('created_at', 'desc');
		$products = $query->paginate(self::PAGINATION_ITEM_PER_PAGE);

		//hot products
		$hotProducts = Product::IsFeatured()->get();
		$metas_detail = [
			'meta_title_detail' => $category->meta_title,
			'meta_keyword_detail' => $category->meta_keyword,
			'meta_description_detail' => $category->meta_description,
		];

		// get banner
		$sliders = Banner::where('type', '=', Banner::TYPE_SLIDER)->where('position', '=', Banner::POS_TOP_DOWN)->where('status', '=', Banner::STATUS_ACTIVE)->get()->first();
		$data = [
			'products'    => $products,
			'category'    => $category,
			'children'    => $children,
			'hotProducts' => $hotProducts,
			'sliders' => $sliders ? $sliders->bannerItems()->where('status', '=', BannerItem::STATUS_ACTIVE)->get() : [],
			'currentPage' => 1,
		];
		$data = array_merge($data, $metas_detail);

		return view('web.pages.product.category', $data);
	}

	public function items($slug, $currentPage, ProductRequest $request)
	{
		$category = Category::where('type', '=', Category::CATEGORY_PRODUCT)
		->where('slug', '=', $slug)
		->get()->first();

		if (!$category) {
			return redirect('/');
		}

		$isNew = $request->get('is_new');
		$isBestseller = $request->get('is_bestseller');

		$strIds = Category::categoriesIds($category->id);
		$arrayID = @array_map('intval', @explode(',', $strIds));
		$children = $category->children()->orderBy('order', 'asc')->get();

		$query = Product::whereIn('category_id', $arrayID);
		if (!is_null($isNew)) {
			$query->where('is_new', '=', 1);
		}

		if (!is_null($isBestseller)) {
			$query->where('is_bestseller', '=', 1);
		}

		$query->orderBy('created_at', 'desc');
	    Paginator::currentPageResolver(function () use ($currentPage) {
	        return $currentPage;
	    });
		$products = $query->paginate(self::PAGINATION_ITEM_PER_PAGE);

		//hot products
		$hotProducts = Product::IsFeatured()->get();
		$metas_detail = [
			'meta_title_detail' => $category->meta_title,
			'meta_keyword_detail' => $category->meta_keyword,
			'meta_description_detail' => $category->meta_description,
		];
		$data = [
			'products'    => $products,
			'category'    => $category,
			'children'    => $children,
			'hotProducts' => $hotProducts,
			'currentPage' => $currentPage,
		];
		$data = array_merge($data, $metas_detail);

		return view('web.pages.product.category', $data);
	}

	public function lastests($currentPage = 0)
	{
	    Paginator::currentPageResolver(function () use ($currentPage) {
	        return $currentPage;
	    });

		$products = Product::where('is_new', '=', 1)
			->orderBy('created_at', 'desc')
			->paginate(self::PAGINATION_ITEM_PER_PAGE);

		$metas_detail = [
			'meta_title_detail' => 'Sản phẩm mới',
		];

		// get banner
		$sliders = Banner::where('type', '=', Banner::TYPE_SLIDER)->where('position', '=', Banner::POS_TOP_DOWN)->where('status', '=', Banner::STATUS_ACTIVE)->get()->first();

		$data = [
			'products'    => $products,
			'currentPage' => $currentPage,
			'sliders' => $sliders ? $sliders->bannerItems()->where('status', '=', BannerItem::STATUS_ACTIVE)->get() : []
		];
		$data = array_merge($data, $metas_detail);

		return view('web.pages.product.lastest', $data);
	}

	public function cateHotDeal($slug = '', $currentPage = 0)
	{
		$category = Category::where('type', '=', Category::CATEGORY_PRODUCT)
		->where('slug', '=', $slug)
		->get()->first();

		if (!$category) {
			return redirect('/');
		}

		$strIds = Category::categoriesIds($category->id);
		$arrayID = @array_map('intval', @explode(',', $strIds));
		$children = $category->children()->orderBy('order', 'asc')->get();

	    Paginator::currentPageResolver(function () use ($currentPage) {
	        return $currentPage;
	    });

		$products = Product::whereIn('category_id', $arrayID)
			->IsBestSeller()
			->orderBy('created_at', 'desc')
			->paginate(self::PAGINATION_ITEM_PER_PAGE);

		$metas_detail = [
			'meta_title_detail' => $category->meta_title,
			'meta_keyword_detail' => $category->meta_keyword,
			'meta_description_detail' => $category->meta_description,
		];

		$data = [
			'products'    => $products,
			'currentPage' => $currentPage,
			'category' => $category,
			'children' =>$children
		];

		$data = array_merge($data, $metas_detail);

		return view('web.pages.product.cate_deal', $data);
	}

	public function tags($slug = '', $currentPage = 0)
	{
		if ($slug  == '') {
			return redirect('/');
		}

		$tagArr = @explode('-', $slug);
		$productId = 0;
		if (count($tagArr) > 0) {
			$productId = (int) $tagArr[0];
			if ($productId <= 0) {
				return redirect('/');
			}
		}
		unset($tagArr[0]);
		$dataSlug = @implode('-', $tagArr);
		$tag = ProductTag::where('product_id', $productId)->where('slug', 'like', '%' . $dataSlug .'%')->get()->first();
		if (!$tag) {
			return redirect('/');
		}

		$query = Product::query();

		$query->where('tags_slug', 'like', '%' . $dataSlug .'%')->orderBy('created_at', 'desc');
	    Paginator::currentPageResolver(function () use ($currentPage) {
	        return $currentPage;
	    });

		$products = $query->paginate(self::PAGINATION_ITEM_PER_PAGE);

		$metas_detail = [
			'meta_title_detail' => isset($tag->title) ? $tag->title : 'Sản phẩm',
		];

		$data = [
			'products'    => $products,
			'currentPage' => $currentPage,
			'tag' => isset($tag) ? $tag : null,
			'productId' => $productId
		];

		$data = array_merge($data, $metas_detail);

		return view('web.pages.product.tags', $data);
	}

	public function dealHot()
	{
		$data = [];


		$featuredProducts = Product::IsFeatured()->orderBy('created_at', 'desc')->limit(12)->get();

		$data['featuredProducts'] = $featuredProducts;

		$categories = Category::ProductType()->where('is_deal', '=', 1)->get();
		$categoryProducts = [];
		foreach ($categories as $category) {
			$strIds = Category::categoriesIds($category->id);
			$arrayID = @array_map('intval', @explode(',', $strIds));
			$items = Product::whereIn('category_id', $arrayID)
				->orderBy('created_at', 'desc')
				->limit(12)->IsBestSeller()->get();
			$category->items = $items;
			$categoryProducts[] = $category;
		}

		$data['categoryProducts'] = $categoryProducts;


		$excludeCate = Category::findBySlug('chinh-sach');
		$lastnews = Post::where('posts.status', 1)->orderBy('created_at', 'desc')->limit(5);
		if ($excludeCate) {
			$lastnews->where('category_id', '<>', $excludeCate->id);
		}

		$cateParents = Category::ProductType()->where('parent_id', 0)->where('status', 1)->orderBy('order', 'asc')->get();
		$data['cateParents'] = $cateParents;

		$lastnews = Post::where('posts.status', 1)->orderBy('created_at', 'desc')->limit(5);
		if ($excludeCate) {
			$lastnews->where('category_id', '<>', $excludeCate->id);
		}
		$lastnews = $lastnews->get();
		$data['lastnews'] = $lastnews != null ? $lastnews : [];

		$metas_detail = [
			'meta_title_detail' => 'Hot Deal Thời Trang Đẹp Rẻ 2017 - Giảm Giá Sốc Đến 70%',
		];
		$data = array_merge($data, $metas_detail);

		return view('web.pages.product.deal', $data);
	}

	public function show($id)
	{
		$product = Product::find($id);

		if ($product) {
			return json_encode($product);
		}

		return [];
	}

	public function details($id, $slug)
	{
		$product = Product::findBySlug($slug);
		if (!$product) {
			return redirect('/');
		}
		$product->total_views += 1;
		$product->save();

		$tmpProduct = [];
		$cookieProducts = Cookie::get('viewedProducts');
        if ($cookieProducts != null) {
        	$viewedProducts = [];
            $jsonProducts = json_decode($cookieProducts);
            foreach ($jsonProducts as $item) {
            	$viewedProducts[] = $item;
            	if ($item->id != $product->id) {
            		$viewedProducts[] = $product;
            	}
            }
            $tmpProduct = $viewedProducts;
        } else {
        	$tmpProduct[] = $product;
        }

        Cookie::queue(Cookie::make('viewedProducts', json_encode($tmpProduct), 60));
        $viewedProducts = json_decode(Cookie::get('viewedProducts'));

		$category = $product->category()->first();

		$related = Product::where('category_id', $product->category_id)
			->where('id', '<>', $product->id)
			->orderBy('created_at', 'desc')
			->limit(10)
			->get();


		$lasts = Product::where('id', '<>', $product->id)
			->orderBy('created_at', 'desc')
			->limit(5)
			->get();

		$hotline = Setting::findValueByKey('hotline');
		$saler_phone = Setting::findValueByKey('saler_phone');

		$comments = $product->comments()->where('parent_id', 0)->where('status', 1)->orderBy('created_at', 'desc')->get();

		$metas_detail = [
			'meta_title_detail' => $product->meta_title,
			'meta_keyword_detail' => $product->meta_keyword,
			'meta_description_detail' => $product->meta_description,
			'meta_image' => isset($product->mainImage()->image) ? MyHtml::showImage($product->mainImage()->image, 'product') : '',
		];


		$relatedProducts = $product->relatedProducts()->get();
		$Ids = [];
		foreach ($relatedProducts as $item) {
			$Ids[] = (int) $item->product_related_id;
		}

		$relatedProducts = Product::whereIn('id', $Ids)
				->orderBy('created_at', 'desc')
				->get();

		// get banner
		$sliders = Banner::where('type', '=', Banner::TYPE_SLIDER)->where('position', '=', Banner::POS_TOP_DOWN)->where('status', '=', Banner::STATUS_ACTIVE)->get()->first();

		// return $data['sliders'];
		$data = [
			'product' => $product,
			'images'  => $product->images()->get(),
			'related' => $related,
			'hotline' => $hotline,
			'category' => $category,
			'saler_phone' => $saler_phone,
            'page_name' => 'product_detail',
			'lasts' => $lasts,
			'comments' => $comments,
			'relatedProducts' => $relatedProducts,
			'viewedProducts' => $viewedProducts,
			'sliders' => $sliders ? $sliders->bannerItems()->where('status', '=', BannerItem::STATUS_ACTIVE)->get() : []
		];

		$data = array_merge($data, $metas_detail);

		return view('web.pages.product.details', $data);
	}
}
