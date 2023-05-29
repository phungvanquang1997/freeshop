<?php 
namespace App\Http\Controllers\Admin;

use App\Page;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Input;
use App\Helpers\ImageManager;
use Session;

class PageController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{		
		$query = Page::query();				
		$data = [];

		$data['blogs'] = $query->orderBy('created_at', 'desc')->get();

		return view('admin.pages.pages.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{		
		return view('admin.pages.pages.create');
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
			'slug' => 'required',
			'content' => 'required',
		]);

		$data = $request->all();
		$data['lang_id'] = $this->lang_id;
		$data['image'] = '';
		$data['user_id'] = 0;
		$blog = Page::create($data);

		if ($request->hasFile('image')) {
			$image = $request->file('image');

			//upload images
			$fileName = ImageManager::upload($image, 'blog');

			//insert to database
			$blog->update(['image' => $fileName]);
		}

		Session::flash('success', 'Tạo trang đơn thành công!');

		return redirect('admin/page');
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
		$data['blog'] = Page::find($id);		

		return view('admin.pages.pages.edit', $data);
	}

	/**
	 * Update blog
	 * @param $id
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update($id, Request $request)
	{
		$blog = Page::find($id);
		if (!$blog) {
			Session::flash('warning', 'Trang đơn không tồn tại');
			return redirect('admin/page');
		}
		$this->validate($request, [
			'title' => 'required',
			'slug' => 'required',
			'content' => 'required',
		]);
		$blog->update($request->all());

		if ($request->hasFile('image')) {
			$image = $request->file('image');
			//upload images
			$fileName = ImageManager::upload($image, 'blog');

			//insert to database
			$blog->update(['image' => $fileName]);
		}

		Session::flash('success', 'Cập nhật trang đơn thành công!');

		return redirect('admin/page');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$post = Page::findOrFail($id);

		if ($post)
		{
			$post->delete();

			Session::flash('success', 'Deleted the blog successfully!');
		}

		return redirect('admin/page');
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
			while ($post = Page::findBySlug($slug))
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
