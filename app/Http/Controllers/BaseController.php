<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use View;
use App\Menu;
use App\MenuItem;
use App\Setting;
use App;
use DB;
use URL;
use App\Category;
use App\Product;
use App\Page;
use App\Post;
use Session;

class BaseController extends Controller
{
	/**
     * @return User
     */

	const PAGINATION_ITEM_PER_PAGE = 12;
	
    public function __construct()
    {
    	$data = [];
		$google_webmaster_tool = Setting::findValueByKey('google_webmaster_tool');
		if ($google_webmaster_tool)
			$data['google_webmaster_tool'] = $google_webmaster_tool;
		$google_analytic_code = Setting::findValueByKey('google_analytic_code');
		if ($google_analytic_code)
			$data['google_analytic_code'] = $google_analytic_code;
						    	
		$home_seo_content = Setting::findValueByKey('home_seo_content');
		if ($home_seo_content)
			$data['home_seo_content'] = $home_seo_content;

		$home_seo_title = Setting::findValueByKey('home_seo_title');
		if ($home_seo_title)
			$data['home_seo_title'] = $home_seo_title;

		$footer_menu1_title = Setting::findValueByKey('footer_menu1_title');
		if ($footer_menu1_title)
			$data['footer_menu1_title'] = $footer_menu1_title;

		$footer_menu2_title = Setting::findValueByKey('footer_menu2_title');
		if ($footer_menu2_title)
			$data['footer_menu2_title'] = $footer_menu2_title;

		$dcma_link = Setting::findValueByKey('dcma_link');
		if ($dcma_link)
			$data['dcma_link'] = $dcma_link;

		$gov_link = Setting::findValueByKey('gov_link');
		if ($gov_link)
			$data['gov_link'] = $gov_link;		

		$meta_title = Setting::findValueByKey('meta_title');
		if ($meta_title)
			$data['meta_title'] = $meta_title;

		$meta_keyword = Setting::findValueByKey('meta_keyword');
		if ($meta_keyword)
			$data['meta_keyword'] = $meta_keyword;

		$meta_description = Setting::findValueByKey('meta_description');
		if ($meta_description)
			$data['meta_description'] = $meta_description;

		$facebook_link = Setting::findValueByKey('facebook_link');
		if ($facebook_link)
			$data['facebook_link'] = $facebook_link;

		$zalo_link = Setting::findValueByKey('zalo_link');
		if ($zalo_link)
			$data['zalo_link'] = $zalo_link;

		$google_plus_link = Setting::findValueByKey('google_plus_link');
		if ($google_plus_link)
			$data['google_plus_link'] = $google_plus_link;

		$instagram_link = Setting::findValueByKey('instagram_link');
		if ($instagram_link)
			$data['instagram_link'] = $instagram_link;

		$contact_intro_text = Setting::findValueByKey('contact_intro_text');
		if ($contact_intro_text)
			$data['contact_intro_text'] = $contact_intro_text;

		$partner_intro_text = Setting::findValueByKey('partner_intro_text');
		if ($partner_intro_text)
			$data['partner_intro_text'] = $partner_intro_text;


		$show_room_1_image = Setting::findValueByKey('show_room_1_image');
		if ($show_room_1_image)
			$data['show_room_1_image'] = $show_room_1_image;

		$show_room_1_title = Setting::findValueByKey('show_room_1_title');
		if ($show_room_1_title)
			$data['show_room_1_title'] = $show_room_1_title;

		$show_room_1_address = Setting::findValueByKey('show_room_1_address');
		if ($show_room_1_address)
			$data['show_room_1_address'] = $show_room_1_address;

		$show_room_1_map_code = Setting::findValueByKey('show_room_1_map_code');
		if ($show_room_1_map_code)
			$data['show_room_1_map_code'] = $show_room_1_map_code;

		$show_room_2_image = Setting::findValueByKey('show_room_2_image');
		if ($show_room_2_image)
			$data['show_room_2_image'] = $show_room_2_image;

		$show_room_2_title = Setting::findValueByKey('show_room_2_title');
		if ($show_room_2_title)
			$data['show_room_2_title'] = $show_room_2_title;

		$show_room_2_address = Setting::findValueByKey('show_room_2_address');
		if ($show_room_2_address)
			$data['show_room_2_address'] = $show_room_2_address;		

		$show_room_2_map_code = Setting::findValueByKey('show_room_2_map_code');
		if ($show_room_2_map_code)
			$data['show_room_2_map_code'] = $show_room_2_map_code;																															
		
    	View::share($data);
    }	

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function sitemapBuilder()
	{
	    // Create Product sitemap
	    $sitemapProduct = App::make("sitemap");


	    //Create Post Sitemap
	    $sitemapCategories = App::make("sitemap");

	    $categories = Category::get();
	    $sitemapCategories->add(URL::to('san-pham-moi.html'), null, '0.8', 'weekly');
	    $sitemapCategories->add(URL::to('tin-tuc.html'), null, '0.8', 'weekly');
	    foreach ($categories as $category)
	    {	    	
	    	if ($category->type == 'post') {
	    		$url = 'tin-tuc/' . $category->slug . '.html';
	    	} elseif ($category->type == 'product') {
	    		$url = $category->slug . '.html';
	    	}
	        $sitemapCategories->add(URL::to($url), null, '0.8', 'weekly');
	    }

	    $sitemapCategories->store('xml','sitemap-category');


	    $sitemapPages = App::make("sitemap");
	    
	    $pages = Page::get();
	    foreach ($pages as $page)
	    {	    	
	    	$url = $page->slug . '.htm';
	        $sitemapPages->add(URL::to($url), null, '0.8', 'weekly');
	    }

	    $sitemapPages->store('xml','sitemap-pages');	    


	    $products = Product::orderBy('created_at', 'desc')->get();
	    foreach ($products as $product)
	    {
	        $sitemapProduct->add(URL::to($product->id . '-' . $product->slug), $product->created_at, 0.8, 'weekly');
	    }
	    $sitemapProduct->store('xml','sitemap-products');

	    //Create Post Sitemap
	    $sitemapPosts = App::make("sitemap");

	    $posts = Post::with('category')->get();
	    foreach ($posts as $post)
	    {	    	
	        $sitemapPosts->add(URL::to('tin-tuc/' . $post->id . '-' .$post->slug . '.htm'), null, '0.5', 'weekly');
	    }

	    $sitemapPosts->store('xml','sitemap-posts');

	    // create sitemap index
	    $sitemap = App::make ("sitemap");
	    
	    $sitemap->addSitemap(URL::to('sitemap-products.xml'));
	    $sitemap->addSitemap(URL::to('sitemap-posts.xml'));
	    $sitemap->addSitemap(URL::to('sitemap-category.xml'));
	    $sitemap->addSitemap(URL::to('sitemap-pages.xml'));

	    $sitemap->store('sitemapindex','sitemap');
	    Session::flash('success', 'Đã cập nhật Sitemap!');
	   	return redirect('/admin');		
	}

	public function reBuild()
	{	
		DB::table('categories')->delete();
		DB::table('products')->delete();
		DB::table('posts')->delete();
	}	
}
