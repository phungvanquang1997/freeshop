<?php 
namespace App\Http\Controllers;

use App\Post;
use App\PostTag;
use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\MyHtml;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Config;
use Illuminate\Pagination\Paginator;


class PostController extends BaseController
{
    private $posts;
    private $category;
    const PAGINATION_ITEM_PER_PAGE = 12;

    public function __construct(Post $posts, Category $category)
    {        
        parent::__construct();
        $this->posts = $posts;
        $this->category = $category;
    }
    
	public function index($currentPage = 0)
	{
		$categories = Category::postType()->where('status', 1)->orderBy('order', 'asc')->get();
		$query =  $this->posts->where('status', 1)->orderBy('created_at', 'desc');		
	    Paginator::currentPageResolver(function () use ($currentPage) {
	        return $currentPage;
	    });		
		$dataPosts = $query->paginate(self::PAGINATION_ITEM_PER_PAGE);
		$dataPostMostView =$this->posts->getAllPostsMostView();
		$data = [
			'dataPosts' => $dataPosts, 
			'dataPostMostView' => $dataPostMostView,			
			'categories' => $categories
		];
		$metas_detail = [
			'meta_title_detail' => 'Tin tức',			
		];
		$data = array_merge($data, $metas_detail);

		return view('web.pages.posts.index', $data);
	}

	public function category($categorySlug)
	{
		$dataCategory = $this->category->findBySlug($categorySlug);
		$categoryId = $dataCategory->id;
		$query =  $this->posts->where('category_id', $categoryId)->orderBy('created_at', 'desc');		
		$dataPosts = $query->paginate(self::PAGINATION_ITEM_PER_PAGE);
		$dataPostMostView =$this->posts->getAllPostsMostView();
		$data = [
			'dataPosts' => $dataPosts, 
			'dataPostMostView' => $dataPostMostView,
			'category' => $dataCategory,			
		];
		$metas_detail = [
			'meta_title_detail' => $dataCategory->meta_title,
			'meta_keyword_detail' => $dataCategory->meta_keyword,
			'meta_description_detail' => $dataCategory->meta_description,
		];
		$data = array_merge($data, $metas_detail);
		return view('web.pages.posts.list', $data);
	}

	public function items($categorySlug, $currentPage)
	{
		$dataCategory = $this->category->findBySlug($categorySlug);
		$categoryId = $dataCategory->id;
		$query =  $this->posts->where('category_id', $categoryId)->orderBy('created_at', 'desc');		
	    Paginator::currentPageResolver(function () use ($currentPage) {
	        return $currentPage;
	    });		
		$dataPosts = $query->paginate(self::PAGINATION_ITEM_PER_PAGE);
		$dataPostMostView =$this->posts->getAllPostsMostView();
		$data = [
			'dataPosts' => $dataPosts, 
			'dataPostMostView' => $dataPostMostView,
			'category' => $dataCategory,			
		];
		$metas_detail = [
			'meta_title_detail' => $dataCategory->meta_title,
			'meta_keyword_detail' => $dataCategory->meta_keyword,
			'meta_description_detail' => $dataCategory->meta_description,
		];		
		$data = array_merge($data, $metas_detail);
				
		return view('web.pages.posts.list', $data);
	}

	public function tags($slug, $currentPage = 0)
	{				
		if ($slug  == '') {
			return redirect('/');
		}

		$tagArr = @explode('-', $slug);
		$postId = 0;
		if (count($tagArr) > 0) {
			$postId = (int) $tagArr[0];
			if ($postId <= 0) {
				return redirect('/');
			}
		}
		unset($tagArr[0]);
		$dataSlug = @implode('-', $tagArr);
		$tag = PostTag::where('post_id', $postId)->where('slug', 'like', '%' . $dataSlug .'%')->get()->first();
		if (!$tag) {
			return redirect('/');
		}
		$query =  $this->posts->where('tags_slug', 'like', '%' . $dataSlug .'%')->orderBy('created_at', 'desc');		
	    Paginator::currentPageResolver(function () use ($currentPage) {
	        return $currentPage;
	    });		
		$dataPosts = $query->paginate(self::PAGINATION_ITEM_PER_PAGE);
		$dataPostMostView =$this->posts->getAllPostsMostView();		
		$data = [
			'dataPosts' => $dataPosts, 
			'dataPostMostView' => $dataPostMostView,
			'postId' => $postId
		];
		$metas_detail = [
			'meta_title_detail' => 'Tin tức' . isset($tag->title) ? ' - ' . $tag->title : '',			
		];
		$data = array_merge($data, $metas_detail);
				
		return view('web.pages.posts.tags', $data);
	}	

	public function details($postId, $postSlug)
	{
        $dataPost = $this->posts->getPostDetail($postSlug);
		if (!$dataPost) {			
			return redirect('/');
		}     
		$dataPost->total_views += 1;
		$dataPost->save();
		
        $dataCategory = $this->category->find($dataPost->category_id);   
        $categoryId = $dataCategory->id;

        $postId = $dataPost->id;
        $dataPostMostView =$this->posts->getAllPostsMostView();
		$dataRelative = $this->posts->getPostRelative($categoryId, $postId);
		//seo
		$metas_detail = [
			'meta_title_detail' => $dataPost->meta_title,
			'meta_keyword_detail' => $dataPost->meta_keyword,
			'meta_description_detail' => $dataPost->meta_description,
			'meta_image' => isset($dataPost->image) ? MyHtml::showImage($dataPost->image, 'blog') : '',
		];

		$data = [
			'dataPost' => $dataPost, 
			'dataPostMostView' => $dataPostMostView, 
			'dataRelative' => $dataRelative,
			'category' => $dataCategory,
		];

		$data = array_merge($data, $metas_detail);

		return view('web.pages.posts.details', $data);
	}

	public function showAll()
	{
		$blogs = DB::table('blogs')
			->where('lang_id', $this->lang_id)
			->orderBy('created_at', 'desc')
			->paginate(Config::get('app.number_blog_paginate_in_list'));

		return view('cms.blog.list', compact('blogs'));
	}

	public function detailContent($categorySlug, $postSlug)
	{
        $category = $this->category->findBySlug($categorySlug);
        $post = $this->posts->getPostDetail($postSlug);
        if (!$post)
		{
			return redirect('/');
		}
        $postId = $post->id;
        $postList = Post::where('category_id', $category->id)
        			->where('status', 1)
        			->get();

		$data = [
			'post' => $post, 
			'category' => $category,
			'postList' => $postList,
		];

		return view('web.pages.posts.detail_content', $data);
	}

}
