<?php 
namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\Category;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use Input;
use Route;
use Session;

class CategoryController extends AdminController
{

	public function index()
	{
		$lang_id = $this->lang_id;
		$query = Category::query();
		if (request()->has('name')) {
			$query->where('name', 'like', '%' . request()->get('name') . '%');
		}		
		$query->postType();
		$data['categories'] = $query->where('lang_id', $lang_id)->orderBy('order', 'asc')->get();

		return view('admin.pages.category.list', $data);
	}

	public function create()
	{
		$categories = Category::getCategoryOption(Category::CATEGORY_POST);
		
		$data = [
			'categories' => $categories,
		];
		
		return view('admin.pages.category.create', $data);
	}

	public function store(CategoryRequest $request)
	{
		$data = $request->all();
		$data['lang_id'] = $this->lang_id;
		Category::create($data);

		Session::flash('success', 'Đã cập nhật danh mục!');

		$type = $request->get('type');

		return redirect('admin/category/article');
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		$cate = Category::findOrFail($id);
		$data['category'] = $cate;
		$categories = Category::getCategoryOption(Category::CATEGORY_POST,$parentId = 0, $currentId = 0, $str = '', $exclude = $cate->id);
	
		$data['categories'] = $categories;

		return view('admin.pages.category.edit', $data);
	}

	public function update($id, CategoryRequest $request)
	{
		$category = Category::findOrFail($id);

		$category->update($request->all());

		Session::flash('success', 'Đã cập nhật danh mục!');

		$type = $request->get('type');

		return redirect('admin/category/article');
	}

	public function destroy($id)
	{
		$product = Category::findOrFail($id);

		Category::destroy($id);
		//$product->delete();

		return redirect('admin/category/article');
	}

	public function del($slug = '')
	{
		$category = Category::where('slug', $slug)->get()->first();

		if ($category->delete()) {
			echo 1;
		} else {
			echo 2;
		}
		exit;
	}

	public function generateSlug()
	{
		$slug = '';
		$name = trim(request()->get('name'));
		$categoryId = trim(request()->get('categoryId'));
		if ($name !== '')
		{
			$slug = \Str::slug($name);
			$count = 1;

			while ($category = Category::findBySlug($slug))
			{
				if ($category->slug == $slug && $category->id == $categoryId) {
					$slug = $category->slug;
				} else {
					$slug .= '-' . $count;
					$count++;
				}
			}
		}

		echo $slug;
	}

}
