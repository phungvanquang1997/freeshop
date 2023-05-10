<?php 
namespace App\Http\Controllers;

use App\Page;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Config;


class PageController extends BaseController
{

    public function __construct()
    {        
        parent::__construct();
    }


	public function detail($slug)
	{
		$page = Page::where('slug', '=', $slug)->get()->first(); 
		if (!$page) {			
			return redirect('/');
		}     

		$pages = Page::get();

		$metas_detail = [
			'meta_title_detail' => $page->meta_title,
			'meta_keyword_detail' => $page->meta_keyword,
			'meta_description_detail' => $page->meta_description,
		];

		$data = [
			'page' => $page, 
			'pages' => $pages
		];

		$data = array_merge($data, $metas_detail);

		return view('web.pages.pages.view', $data);
	}
}
