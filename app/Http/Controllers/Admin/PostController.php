<?php 
namespace App\Http\Controllers\Admin;

use App\Post;
use App\PostTag;
use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Input;
use App\Helpers\ImageManager;
use Session;

class PostController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['categories'] = Category::postType()->where('lang_id', $this->lang_id)->get();

		$query = Post::query();
		$query->where('lang_id', $this->lang_id);
		if (request()->has('name')) {
			if (request()->get('name') != '') {				
				$query->where('title', 'like', '%' . trim(request()->get('name')) . '%');
			}			
		}		
		if (request()->has('category_id')) $query->where('category_id', request()->get('category_id'));
		if (request()->has('special')) $query->where('special', request()->get('special'));

		$data['blogs'] = $query->orderBy('created_at', 'desc')->get();

		return view('admin.pages.cms.blog.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data['categories'] = Category::postType()->where('lang_id', $this->lang_id)->pluck('name', 'id');

		return view('admin.pages.cms.blog.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required',
			'slug' => 'required|unique:posts',
			'content' => 'required',
		]);

		$data = $request->all();
		$data['lang_id'] = $this->lang_id;
		$arrTags = [];
		if ($data['tags'] != '') {
			$tags = @explode(',', $data['tags']);
			if (count($tags) > 0) {
				foreach ($tags as $tag) {
					$arrTags[] = \Str::slug($tag);
				}
			}
		}
		if (count($arrTags) > 0) {
			$data['tags_slug'] = @implode(',', $arrTags);
		}

		$blog = Post::create($data);
		if ($blog) {
			if ($data['tags'] != '') {
				$tags = @explode(',', $data['tags']);
				if (count($tags) > 0) {
					foreach ($tags as $tag) {
						$argTag = [];
						$argTag['post_id'] = $blog->id;
						$argTag['slug'] = \Str::slug($tag);
						$argTag['title'] = trim($tag);
						PostTag::create($argTag);
					}
				}
			}			
		}

		if ($request->hasFile('image')) {
			$image = $request->file('image');

			//upload images
			$fileName = ImageManager::upload($image, 'blog');

			//insert to database
			$blog->update(['image' => $fileName]);
		}

		Session::flash('success', 'Created a blog successfully!');

		return redirect('admin/article');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data['blog'] = Post::find($id);

		$data['categories'] = Category::postType()->where('lang_id', $this->lang_id)->pluck('name', 'id');

		return view('admin.pages.cms.blog.edit', $data);
	}

	/**
	 * Update blog
	 * @param $id
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update($id, Request $request)
	{
		$blog = Post::find($id);
		if (!$blog) {
			Session::flash('warning', 'The glog do not exits!');
			return redirect('admin/article');
		}
		$this->validate($request, [
			'title' => 'required',
			'slug' => 'required',
			'content' => 'required',
		]);
		$data = $request->all();
		$arrTags = [];
		if ($data['tags'] != '') {
			$tags = @explode(',', $data['tags']);
			if (count($tags) > 0) {
				foreach ($tags as $tag) {
					$arrTags[] = \Str::slug($tag);
				}
			}
		}
		if (count($arrTags) > 0) {
			$data['tags_slug'] = @implode(',', $arrTags);
		}

		if ($blog->update($data)) {			
			if ($data['tags'] != '') {
				PostTag::where('post_id', $blog->id)->delete();				
				$tags = @explode(',', $data['tags']);
				if (count($tags) > 0) {
					foreach ($tags as $tag) {
						$argTag = [];
						$argTag['post_id'] = $blog->id;
						$argTag['slug'] = \Str::slug($tag);
						$argTag['title'] = trim($tag);
						PostTag::create($argTag);
					}
				}
			}

			if ($request->hasFile('image')) {
				$image = $request->file('image');
				//upload images
				$fileName = ImageManager::upload($image, 'blog');

				//insert to database
				$blog->update(['image' => $fileName]);
			}

			Session::flash('success', 'Cập nhật thành công!');
		} else {
			Session::flash('error', 'Cập nhật thất bại!');
		}

		return redirect('admin/article');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$post = Post::findOrFail($id);

		if ($post)
		{
			$post->delete();

			Session::flash('success', 'Deleted the blog successfully!');
		}

		return redirect('admin/article');
	}

	public function generateSlug()
	{
		$slug = '';
		$title = trim(request()->get('title'));
		$postId = trim(request()->get('postId'));
		if ($title !== '')
		{
			$slug = \Str::slug($title);
			//check unique
			$count = 1;
			while ($post = Post::findBySlug($slug))
			{
				if ($slug == $post->slug && $postId == $post->id) {
					$slug = $post->slug;
				} else {
					$slug .= '-' . $count;
					$count++;					
				}					
			}
		}

		print $slug;
	}

}
