<?php 
namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\Category;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use Input;
use Route;
use Session;
use Auth;

class ProductCategoryController extends AdminController
{

	public function index()
	{

		$lang_id = $this->lang_id;
		$query = Category::query();
		if (\Input::has('name')) {
			$query->where('name', 'like', '%' . \Input::get('name') . '%');
		}		
		$query->productType();
		$data['categories'] = $query->where('lang_id', $lang_id)->orderBy('order', 'asc')->get();
		return view('admin.pages.product_category.list', $data);
	}

	public function create()
	{
		$categories = Category::getCategoryOption(Category::CATEGORY_PRODUCT);
		
		$data = [
			'categories' => $categories,
		];
		
		return view('admin.pages.product_category.create', $data);
	}

	public function store(CategoryRequest $request)
	{
		$data = $request->all();
		$data['lang_id'] = $this->lang_id;
		$data['user_id'] = Auth::user()->id;
		$data['type'] = Category::CATEGORY_PRODUCT;
		Category::create($data);

		Session::flash('success', 'Đã cập nhật danh mục!');

		return redirect('admin/category/product');
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		$cate = Category::findOrFail($id);
		$data['category'] = $cate;
		$categories = Category::getCategoryOption(Category::CATEGORY_PRODUCT, 0, $cate->parent_id, $str = '', $exclude = $cate->id);
	
		$data['categories'] = $categories;

		return view('admin.pages.product_category.edit', $data);
	}

	public function update($id, CategoryRequest $request)
	{
		$category = Category::findOrFail($id);

		$category->update($request->all());

		Session::flash('success', 'Đã cập nhật danh mục!');		

		return redirect('admin/category/product');
	}

	public function destroy($id)
	{
		$product = Category::findOrFail($id);

		$product->delete();

		return redirect('admin/category/product');
	}

	public function generateSlug()
	{
		$slug = '';
		$name = trim(\Input::get('name'));
		if ($name !== '') {
			if ($this->lang_id == 'cn') {
				$slug = $name;
			} else {
				$slug = \Str::slug($name);
			}

			//check unique
			$count = 1;
			while (Category::findBySlug($slug))
			{
				$slug .= '-' . $count;
				$count++;
			}
		}

		echo $slug;
	}

}
