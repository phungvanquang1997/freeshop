<?php 
namespace App\Http\Composers;

use App\Blog;
use Illuminate\Contracts\View\View;
use Input;
use Route;

class AdvHomeFrontComposer
{

	public function compose(View $view)
	{
		$blog = Blog::where('special', 1)->orderBy('created_at', 'desc')->first();
		if($blog) {
			$data['blog_adv'] = $blog;
		} else {
			$data['blog_adv'] = null;
		}
		
		$view->with($data);
	}

}
