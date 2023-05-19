<?php 
namespace App\Http\Composers;

use Cart;
use App\Category;
use Illuminate\Contracts\View\View;
use App\Settingkkk;
use App\Setting;
use App\Menu;

class HeadComposer
{

	public function compose(View $view)
	{
		$data = [];
		
		$meta_title = Setting::findValueByKey('meta_title');
		if ($meta_title)
			$data['meta_title'] = $meta_title;

		$meta_keyword = Setting::findValueByKey('meta_keyword');
		if ($meta_keyword)
			$data['meta_keyword'] = $meta_keyword;

		$meta_description = Setting::findValueByKey('meta_description');
		if ($meta_description)
			$data['meta_description'] = $meta_description;

		$view->with($data);
	}
}

