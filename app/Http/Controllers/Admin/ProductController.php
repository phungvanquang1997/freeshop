<?php 
namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Distributor;
use App\Helpers\ImageManager;
use App\Helpers\MyHtml;
use App\Helpers\SerializedAttribute;
use App\Http\Requests;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductImage;
use App\ProductRelates;
use App\ProductTag;
use File;
use Session;

class ProductController extends AdminController
{

	public function index()
	{
		$data = [];

		//Get category options
		$categories = Category::getCategoryOption(Category::CATEGORY_PRODUCT, 0, \request()->get('category_id'));
		$data['categories'] = $categories;

		//Get Products
		$query = Product::query();
		if (\request()->has('name')) {
			if (\request()->get('name') != '') {
				$query->where('name', 'like', '%' . strtolower(\request()->get('name')) . '%');
			}			
		}

		if (\request()->has('category_id')) {
			if (\request()->get('category_id') > 0) {
				$strIds = Category::categoriesIds(\request()->get('category_id'));
				$arrayID = @array_map('intval', @explode(',', $strIds));
				$query->whereIn('category_id', $arrayID);
				//$query->where('category_id', '=', request()->get('category_id'));	
			}
		}

		if (\request()->has('status')) {
			if (!is_null(\request()->get('status'))) {
				$query->where('status', '=', \request()->get('status'));
			}
		}

		$data['products'] = $query->orderBy('created_at', 'desc')->get();

		return view('admin.pages.product.list', $data);
	}

	public function create()
	{
		$data = [
			'categories'     => Category::getCategoryOption(Category::CATEGORY_PRODUCT),
			'availabilities' => [],
			'conditions'     => [null => 'Normal']			
		];

		foreach (Product::availabilities() as $key => $value)
		{
			$data['availabilities'] = \Arr::add($data['availabilities'], $key, $value);
		}

		return view('admin.pages.product.create', $data);
	}

	public function store(ProductRequest $request)
	{
		$this->validate($request, [
	        'slug' => 'required|unique:products',
	        'sku' => 'required|unique:products',
	    ],[
	    	'slug.unique' => 'Slug đã tồn tại',
	    ]);
		$data = $request->all();
		$relatedProductIds = (isset($data['related_products']) && count($data['related_products']) > 0) ? $data['related_products'] : null;

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

		$product = Product::create($data);
		if ($product) {

			if ($data['tags'] != '') {
				$tags = @explode(',', $data['tags']);
				if (count($tags) > 0) {
					foreach ($tags as $tag) {
						$argTag = [];
						$argTag['product_id'] = $product->id;
						$argTag['slug'] = \Str::slug($tag);
						$argTag['title'] = trim($tag);
						ProductTag::create($argTag);
					}
				}
			}

			if (!is_null($relatedProductIds)) {
				foreach ($relatedProductIds as $id) {
					$relatedItems = [
						'product_id' => $product->id,
						'product_related_id' => $id
					];	
					$where = [
						'product_id', '=', $product->id,
						'product_related_id', '=', $id,
					];
					$item = ProductRelates::where('product_id', '=', $product->id)
					->where('product_related_id', '=', $id)
					->get()->first();
					if (is_null($item)) {
						ProductRelates::create($relatedItems);
					}
				}
			}
		}

		if ($request->hasFile('images')) $this->uploadImages($product, $request->file('images'));

		Session::flash('success', 'Created a product successful!');

		return redirect('admin/product/' . $product->id .'/edit?tab=img');
	}

	public function show($id)
	{

	}

	public function edit($id)
	{
		$product = Product::find($id);
		$relatedProducts = $product->relatedProducts()->get();
		$Ids = [];
		foreach ($relatedProducts as $item) {
			$Ids[] = (int) $item->product_related_id;
		}

		$relatedProducts = Product::whereIn('id', $Ids)
				->orderBy('created_at', 'desc')
				->get();
		$data = [
			'product' => $product,
			'categories'     => Category::getCategoryOption(Category::CATEGORY_PRODUCT, 0, $product->category_id),
			'availabilities' => [],
			'relatedProducts' => $relatedProducts,
		];

		foreach (Product::availabilities() as $key => $value)
		{
			$data['availabilities'] = \Arr::add($data['availabilities'], $key, $value);
		}

		return view('admin.pages.product.edit', $data);
	}

	public function update($id, ProductRequest $request)
	{
		$product = Product::findOrFail($id);
		$data = $request->all();
		if (!isset($data['is_featured'])) {
			$data['is_featured'] = 0;
		}

		if (!isset($data['is_bestseller'])) {
			$data['is_bestseller'] = 0;
		}

		if (!isset($data['is_new'])) {
			$data['is_new'] = 0;
		}

		if (!isset($data['is_promotion'])) {
			$data['is_promotion'] = 0;
		}						

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

		$product->update($data);

		if ($product) {
			if ($data['tags'] != '') {
				ProductTag::where('product_id', $product->id)->delete();				
				$tags = @explode(',', $data['tags']);
				if (count($tags) > 0) {
					foreach ($tags as $tag) {
						$argTag = [];
						$argTag['product_id'] = $product->id;
						$argTag['slug'] = \Str::slug($tag);
						$argTag['title'] = trim($tag);
						ProductTag::create($argTag);
					}
				}
			}
		}

		$relatedProductIds = (isset($data['related_products']) && count($data['related_products']) > 0) ? $data['related_products'] : null;

		if ($product && !is_null($relatedProductIds)) {
			foreach ($relatedProductIds as $id) {
				$relatedItems = [
					'product_id' => $product->id,
					'product_related_id' => $id
				];	
				$where = [
					'product_id', '=', $product->id,
					'product_related_id', '=', $id,
				];
				$item = ProductRelates::where('product_id', '=', $product->id)
				->where('product_related_id', '=', $id)
				->get()->first();
				if (is_null($item)) {
					ProductRelates::create($relatedItems);
				}
			}
		}		
		if ($request->hasFile('images')) $this->uploadImages($product, $request->file('images'));

		Session::flash('success', 'Updated a product successful!');

		return redirect('admin/product');
	}

	public function destroy($id)
	{
		$product = Product::findOrFail($id);

		foreach ($product->images()->get() as $image)
		{
			$this->deleteRealImage($image);
		}

		$product->delete();

		Session::flash('success', 'Product is deleted successful!');

		return redirect('admin/product');
	}

	public function deleteRelated($productId, $productRelatedId)
	{
		$item = ProductRelates::where('product_id', '=', $productId)
				->where('product_related_id', '=', $productRelatedId)
				->get()
				->first();
		if (!is_null($item)) {
			$item->delete();
			Session::flash('success', 'Đã xóa sản phẩm gợi ý!');
		}
		return redirect('admin/product/' . $productId . '/edit');
	}

	public function deleteImage($productId, $imageId)
	{
		$image = ProductImage::findOrFail(intval($imageId));

		$this->deleteRealImage($image);

		//delete in database
		$result = $image->delete();
		if ($result)
		{
			$data = ['success' => true, 'error' => null,];
		} else
		{
			$data = ['success' => false, 'error' => 'Cannot delete this image!',];
		}

		print json_encode($data);
	}

	public function setFeaturedImage($productId, $imageId)
	{
		$data = ['success' => false, 'error' => 'Không thể cập nhật ảnh đại diện!',];
		$image = ProductImage::findOrFail(intval($imageId));
		if ($image) {
			ProductImage::where('product_id', $productId)
          		->update(['is_featured' => 0]);
			$image->is_featured = 1;
			$result = $image->save();
			if ($result)
			{
				$data = ['success' => true, 'error' => null,];
			}          
		}
		print json_encode($data);
	}

	public function generateSlug()
	{

		$slug = '';
		$name = trim(request()->get('name'));
		$formType = trim(request()->get('formType'));
		$postId = trim(request()->get('postId'));
		if ($name !== '')
		{
			$slug = \Str::slug($name);
			$count = 1;
			while ($item = Product::findBySlug($slug))
			{
				if ($slug == $item->slug && $item->id == $postId) {
					$slug = $item->slug;
				} else {
					$slug .= '-' . $count;
					$count++;
				}
			}
		}

		print $slug;
	}

	private function deleteRealImage(ProductImage $image)
	{
		File::delete( public_path( MyHtml::productImagePath( ImageManager::getThumb($image->image, 'product') ) . ImageManager::getThumb($image->image, 'product') ) );

		File::delete(public_path( MyHtml::productImagePath($image->image) . $image->image ) );
	}

	private function uploadImages(Product $product, $images)
	{
		if (!empty($images))
		{
			foreach ($images as $file)
			{
				$filename = ImageManager::upload($file, 'product');

				//insert to database
				ProductImage::create(['product_id' => $product->id, 'image' => ($filename)]);
			}
		}

		return $product;
	}

    public function apiGetProductByCategory($categoryId) {
		$strIds = Category::categoriesIds($categoryId);
		$arrayID = @array_map('intval', @explode(',', $strIds));		
		$products = Product::whereIn('category_id', $arrayID)->get();
        
        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'id' => $product->id,
                'name' => $product->name
            ];
        }
        return response()->json($data);
    }
}
