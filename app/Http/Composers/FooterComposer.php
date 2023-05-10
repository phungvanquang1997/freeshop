<?php 
namespace App\Http\Composers;

use App\Menu;
use App\MenuItem;
use Illuminate\Contracts\View\View;
use App\Setting;

class FooterComposer
{

	public function compose(View $view)
	{
		$menuLeft = Menu::where('position', Menu::POS_BOTTOM_LEFT)->where('status', Menu::STATUS_ACTIVE)->where('lang_id', Session('lang', 'vi'))->first();
		$html = '';
		if ($menuLeft) {
			$parents = $menuLeft->menuItems()->where('parent_id', 0)->where('status', Menu::STATUS_ACTIVE)->orderBy('ordering', 'asc')->get();
			$html = $this->generateParentHtml($parents);
		}
		$data['footer_menu_left'] = $html;

		$menuRight = Menu::where('position', Menu::POS_BOTTOM_RIGHT)->where('status', Menu::STATUS_ACTIVE)->where('lang_id', Session('lang', 'vi'))->first();
		$html = '';
		if ($menuRight) {
			$parents = $menuRight->menuItems()->where('parent_id', 0)->where('status', Menu::STATUS_ACTIVE)->orderBy('ordering', 'asc')->get();
			$html = $this->generateParentHtml($parents);
		}
		$data['footer_menu_right'] = $html;
		/*
		$menuMiddle = Menu::where('position', Menu::POS_BOTTOM_MIDDLE)->where('status', Menu::STATUS_ACTIVE)->where('lang_id', Session('lang', 'vi'))->first();
		$html = '';
		if ($menuMiddle) {
			$parents = $menuMiddle->menuItems()->where('parent_id', 0)->orderBy('ordering', 'asc')->get();
			$html = $this->generateParentHtml($parents);
		}
		$data['footer_menu_middle'] = $html;
		*/

		$sub_logo = Setting::findValueByKey('sub_logo');
		if ($sub_logo)
			$data['sub_logo'] = $sub_logo;

		$home_seo_content = Setting::findValueByKey('home_seo_content');
		if ($home_seo_content)
			$data['home_seo_content'] = $home_seo_content;

		$company_address = Setting::findValueByKey('company_address');
		if ($company_address)
			$data['company_address'] = $company_address;

		$support_phone = Setting::findValueByKey('support_phone');
		if ($support_phone)
			$data['support_phone'] = $support_phone;

		$working_time = Setting::findValueByKey('working_time');
		if ($working_time)
			$data['working_time'] = $working_time;

		$facebook_link = Setting::findValueByKey('facebook_link');
		if ($facebook_link)
			$data['facebook_link'] = $facebook_link;

		$google_plus_link = Setting::findValueByKey('google_plus_link');
		if ($google_plus_link)
			$data['google_plus_link'] = $google_plus_link;

		$instagram_link = Setting::findValueByKey('instagram_link');
		if ($instagram_link)
			$data['instagram_link'] = $instagram_link;

		$zalo_link = Setting::findValueByKey('zalo_link');
		if ($zalo_link)
			$data['zalo_link'] = $zalo_link;

		$view->with($data);
	}

	protected function generateParentHtml($parents = [])
	{
		$html = '';
		$html .= '<ul>';
		foreach ($parents as $key => $item) {
			$html .= '<li>';
                $html .= '<a href="' . url($item->link) . '" title="'. $item->name.'">' . $item->name . '</a>';
            $html .= '</li>';
		}
		$html .= '</ul>';
		return $html;
	}
}

