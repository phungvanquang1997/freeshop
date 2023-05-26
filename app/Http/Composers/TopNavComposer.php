<?php 
namespace App\Http\Composers;

use App\Category;
use App\Menu;
use App\MenuItem;
use Illuminate\Contracts\View\View;
use Session;

class TopNavComposer
{

	public function compose(View $view)
	{
		$menu = Menu::where('position', Menu::POS_BOTTOM_LEFT)->where('status', Menu::STATUS_ACTIVE)->where('lang_id', Session('lang', 'vi'))->first();
		$html = '';
		$html_pc = '';
		if($menu) {
			$parents = $menu->menuItems()->where('parent_id', 0)->where('status', Menu::STATUS_ACTIVE)->orderBy('ordering', 'asc')->get();
			// Get categories.
			$categories = Category::query()->where('parent_id', 0)->productType()->orderBy('order', 'asc')->get();
			$html = $this->generateParentHtml($parents, $categories);
			$html_pc = $this->generateParentHtmlPC($parents, $categories);
		}
		$data['mainMenu'] = $html;
		$data['mainMenuPC'] = $html_pc;
		$view->with($data);
	}

	private function generateParentHtmlPC ($parents, $categories) {
		$html = '<ul class="nav navbar-nav category_menu_pc">';
		$html .= '<li>';
		$html .=   '<a class="cat_name" href="#">DANH MỤC SẢN PHẨM</a>';
		$html .=         '<ul class="bottom_sliding">';
		foreach ($categories as $cate) {
			$html .= '<li>';
			$html .=     '<a href="' . url($cate->slug . '.html') . '" >' . $cate->name . '</a>';
			if (!empty($cate->children)) {
				$html .= '<ul class="right_sliding">';
				foreach ($cate->children as $children) {
					$html .=    '<li><a href="' . url($children->slug . '.html') . '">' . $children->name . '</a></li>';
				}
				$html .= '</ul>';
			}
			$html .= '</li>';
		}
		$html .=         '</ul>';
		$html .= '</li>';
		foreach ($parents as $item) {
			$html .= '<li>';
            $html .= '<a class="item-haschild has-submenu" href="' . url($item->link) . '">' . $item->name . '</a>';
            $html .= '</li>';
		}
		$html .= '</ul>';
		return $html;
	}

	protected function generateParentHtml($parents = [], $categories)
	{
		$html = '';
		$html = '<ul class="nav navbar-nav category_menu_sp">';
		foreach ($categories as $key => $cate) {
			$children = null;
            $children = $cate->children;
            if (!empty($children)) {
				$html .= '<li class="">';
				$caret = '<span class="caret"></span>';
			} else {
				$html .= '<li>';
				$caret = '';
			}
            $html .= '<a class="item-haschild has-submenu" href="' . url($cate->slug . '.html') . '">' . $cate->name . $caret . '</a>';

            if (!empty($children)) {
            	$html .= $this->generateChildren($children);
            }
            $html .= '</li>';
		}
		$html .= '</ul>';
		return $html;
	}

	protected function generateChildren($children = [])
	{
		$html = '';
        $html .= '<ul class="dropdown-menu">';
        	foreach ($children as $value) {
            	$html .= '<li class=""><a href="' . url($value->slug . '.html') . '">'. $value->name .'</a>';
        		$html .= '</li>';
        	}
        $html .= '</ul>';
        return $html;
	}

}

