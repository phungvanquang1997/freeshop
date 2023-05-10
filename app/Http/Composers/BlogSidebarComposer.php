<?php 
namespace App\Http\Composers;

use App\Blog;
use App\Category;
use Illuminate\Contracts\View\View;
use Session;
use Config;

class BlogSidebarComposer
{

	public function compose(View $view)
	{
		$data['categories'] = Category::newsType()->where('lang_id', Session('lang', Config::get('app.locale')))->orderBy('name')->get();

		$data['specialList'] = Blog::special()->where('lang_id', Session('lang', Config::get('app.locale')))->orderBy('created_at')->get();

		$view->with($data);
	}

}

