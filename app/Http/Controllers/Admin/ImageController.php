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
use Input;
use Session;
use File;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageController extends AdminController
{

	public function index()
	{
		// open file a image resource
		$img = Image::make('F:\xampp\htdocs\projects\aogiasi.com\public/foo.png');
		$path = public_path();
		$img->crop(350, 150)->encode('png', 90)->trim()->save(sprintf("logo.png",$path));
		var_dump($img);

	}

	public function show(ProductRequest $request)
	{
	
	}

    public function cropImage(ProductRequest $request)
    {
    	$data = [];
    	$imageId = $request->get('imageId');
    	$imageWidth = $request->get('imageWidth');
    	$imageHeight = $request->get('imageHeight');
    	$productId = $request->get('productId');
    	$x = $request->get('x');
    	$y = $request->get('y');    	
    	$data['image_id'] = $imageId;
    	$data['w'] = $imageWidth;
    	$data['h'] = $imageHeight;
    	$data['x'] = $x;
    	$data['y'] = $y; 

    	//find image
    	$pathImage = null;
    	$image = ProductImage::where('id', $imageId)->where('product_id', $productId)->get()->first();
    	if ($image) {    		
    		$pathImage = public_path(ImageManager::getContainerFolder('product', $image->image) . $image->image);
    	}    	
    	$data['image'] = MyHtml::productImagePath($image->image) . $image->image;
    	$path = public_path();
		$img = Image::make($pathImage);
		if ($img->crop($imageWidth, $imageHeight, $x, $y)->encode('png', 90)->trim()->save($pathImage)) {
			$data['error'] = false;
			$data['html_img'] = '<img product-id="'.$productId.'" image-id="'.$imageId.'" src="/'.MyHtml::productImagePath($image->image) . $image->image.'" style="height: initial;max-height: initial;" id="Jcrop-'.$imageId.'" class="Jcrop">';
		} else {
			$data['error'] = true;			
		}
    	return response()->json($data);
    }
}
