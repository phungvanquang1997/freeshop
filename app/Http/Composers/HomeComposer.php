<?php 
namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use App\Setting;

class HomeComposer
{

	public function compose(View $view)
	{
		$data = [];

		$home_seo_content = Setting::findValueByKey('home_seo_content');
		if ($home_seo_content)
			$data['home_seo_content'] = $home_seo_content;

		$view->with($data);
	}
}

