<?php 
namespace App\Http\Composers;

use Cart;
use App\Category;
use Illuminate\Contracts\View\View;
use App\Settingkkk;
use App\Setting;
use App\Menu;

class HeaderComposer
{

	public function compose(View $view)
	{
		$data = [];
		$logo = Setting::findValueByKey('site_logo');
		if ($logo)
			$data['logo'] = $logo;

		$hotline = Setting::findValueByKey('hotline');
		if ($hotline)
			$data['hotline'] = $hotline;

		$support_phone = Setting::findValueByKey('support_phone');
		if ($support_phone)
			$data['support_phone'] = $support_phone;

		$saler_phone = Setting::findValueByKey('saler_phone');
		if ($saler_phone)
			$data['saler_phone'] = $saler_phone;

		$working_time = Setting::findValueByKey('working_time');
		if ($working_time)
			$data['working_time'] = $working_time;

		$view->with($data);
	}
}

