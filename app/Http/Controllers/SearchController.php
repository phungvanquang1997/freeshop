<?php 
namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Session;
use App\Category;
use App\Helpers\SerializedAttribute;
use App\Http\Requests;
use App\Product;
use App\ProductImage;
use Illuminate\Database\Eloquent\Collection;
use App\Post;
use Illuminate\Pagination\Paginator;

class SearchController extends BaseController {

	const PAGINATION_ITEM_PER_PAGE = 12;

    public function __construct()
    {        
        parent::__construct();
    }

    public function index(Request $request)
    {
    	$keyword = $request->get('keyword');
		if (!$keyword || $keyword == '') {			
			return redirect('404');
		}

		return redirect('tim-kiem/' . $keyword . '.html');
    }

    public function search($keyword = '', $currentPage = 0)
    {    	
		if (!$keyword || $keyword == '') {			
			return redirect('/');
		}
		
	    Paginator::currentPageResolver(function () use ($currentPage) {
	        return $currentPage;
	    });	    

		$products = Product::where("name", "LIKE", "%$keyword%")
			->orderBy('created_at', 'desc')
			->paginate(self::PAGINATION_ITEM_PER_PAGE);

		$data = [
			'products'	=> $products,
			'keyword'	=> isset($keyword) ? $keyword : '',
			'currentPage' => $currentPage
		];

    	return view('web.pages.search.index', $data);
    }


}
