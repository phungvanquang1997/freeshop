<?php 
namespace App\Http\Composers;

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
		if($menu) {
			$parents = $menu->menuItems()->where('parent_id', 0)->where('status', Menu::STATUS_CATEGORY)->orderBy('ordering', 'asc')->get();
			$html = $this->generateParentHtml($parents);
		}
		$data['mainMenu'] = $html;
		$view->with($data);
	}

	protected function generateParentHtml($parents = [])
	{
		$html = '';
		$html = '<ul class="nav navbar-nav category_menu_sp">';
		foreach ($parents as $key => $item) {
			$children = null;
            $children = MenuItem::getChildren($item->id, false);
            if ($children != null) {
				$html .= '<li class="">';
				$caret = '<span class="caret"></span>';
			} else {
				$html .= '<li>';
				$caret = '';
			}

            $html .= '<a class="item-haschild has-submenu" href="' . url($item->link) . '">' . $item->name . $caret . '</a>';
			
            
            if ($children != null) {
            	$html .= $this->generateChildren($children);
            }
            $html .= '</li>';
		}
		$html .= '</ul>';
		// pc version screen

		$html .= '<ul class="nav navbar-nav category_menu_pc">';
		$html .= '<li>';
		$html .= '<a class="cat_name" href="#">DANH MỤC SẢN PHẨM</a>';
		$html .= '<ul class="right_sliding">';
		foreach ($parents as $key => $item) {
			$html .= '<li><a href="' . url($item->link) . '" >' . $item->name . '</a></li>';
		}
		$html .= '</ul>';
		$html .= '</li>';
		$html .= '</ul>';
		return $html;
	}

	protected function generateChildren($children = [])
	{
		$html = '';
        $html .= '<ul class="dropdown-menu">';
        	foreach ($children as $key => $value) {        		
        		$children = null;
            	$children = MenuItem::getChildren($value->id, false);

	            if ($children != null) {
					$caret = '<span class="caret"></span>';
				} else {
					$caret = '';
				}

            	$html .= '<li class=""><a href="' . url($value->link) . '">'. $value->name . $caret .'</a>';

            	if ($children != null) {
        			$html .= $this->generateChildren($children);
        		}
        		$html .= '</li>';
        	}
           
        $html .= '</ul>';
        return $html;
	}

}

