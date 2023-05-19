<?php namespace App\Http\Controllers\Admin;

use App\Menu;
use App\Http\Requests;
use App\Http\Requests\MenuRequest;
use Input;
use Route;
use Session;
use Validator;
use Illuminate\Http\Request;
use App\MenuItem;

class MenuController extends AdminController
{
	public function index()
	{
		$data['menus'] = Menu::where('lang_id', $this->lang_id)->get();

		return view('admin.pages.menus.list', $data);
	}

	public function create()
	{
		$status = Menu::$status;
		$menu = new Menu();
		if ($status) {
			foreach ($status as $key => $value) {
				$status[$key] = trans($value);
			}
		}
		$data['status'] = $status;
		$data['menu'] = $menu;
		return view('admin.pages.menus.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',
		],[
			'name.required' => 'Tên trình đơn là trường bắt buộc',
		]);

	    if ($validator->fails()) {
	    	return redirect('admin/menu/create')->withErrors($validator)->withInput();;
		}
		
		$menu = $request->all();
		$menu['lang_id'] = $this->lang_id;
		if (Menu::create($menu)) {
			Session::flash('success', 'Tạo trình đơn thành công');
		} else {
			Session::flash('danger', 'Lỗi: vui lòng thao tác lại');
		}
		return redirect('/admin/menu');
	}

	public function show($id) {
		$menu = Menu::findOrFail($id);
		$items = $menu->menuItems()->where('parent_id', 0)->orderBy('ordering', 'asc')->get();
		$data['menuItems'] = $items;
		$data['menu'] = $menu;
		return view('admin.pages.menus.details', $data);
	}

	public function edit($id) 
	{
		$menu = Menu::findOrFail($id);
		
		$status = Menu::$status;
		if ($status) {
			foreach ($status as $key => $value) {
				$status[$key] = trans($value);
			}
		}
		$data['status'] = $status;
		$data['menu'] = $menu;
		
		return view('admin.pages.menus.edit', $data);
	}

	public function update(Request $request, $id)
	{
		$menu = Menu::find($id);
		if(!$menu) {
			return redirect('admin/menu');
		}
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'status' => 'required',
		],[
			'name.required' => 'Tên trình đơn là trường bắt buộc',
			'status.required' => 'Trạng thái là trường bắt buộc'
		]);

	    if ($validator->fails()) {
	    	return redirect('admin/menu/' . $id . '/edit')->withErrors($validator)->withInput();;
		}
		
		$data = $request->all();
		if ($menu->update($data)) {
			Session::flash('success', 'Cập nhật trình đơn thành công');
		} else {
			Session::flash('danger', 'Lỗi: vui lòng thao tác lại');
		}
		return redirect('/admin/menu');
	}

	public function createItem($menu_id)
	{
		$menu = Menu::findOrFail($menu_id);
		$menuItemOption = MenuItem::getParentOption($menu->id);
		$status = Menu::$status;
		$menuItem = new MenuItem();
		if ($status) {
			foreach ($status as $key => $value) {
				$status[$key] = trans($value);
			}
		}
		$data = ['menu' => $menu, 'menuItemOption' => $menuItemOption];
		$data['status'] = $status;
		$data['menuItem'] = $menuItem;
		return view('admin.pages.menus.create_item', $data);
	}

	public function itemStore(Request $request, $menu_id)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'link' => 'required',
		],[
			'name.required' => 'Tên trình đơn là trường bắt buộc',
			'link.required' => 'Đường dẫn tĩnh là trường bắt buộc',
		]);

	    if ($validator->fails()) {
	    	return redirect('admin/menu/item-create/' . $menu_id)->withErrors($validator)->withInput();;
		}
		
		$menuItem = $request->all();
		$menuItem['menu_id'] =  $menu_id;
		$menuItem['lang_id'] = $this->lang_id;
		if (MenuItem::create($menuItem)) {
			Session::flash('success', 'Tạo trình đơn thành công');
		} else {
			Session::flash('danger', 'Lỗi: vui lòng thao tác lại');
		}
		return redirect('admin/menu/' . $menu_id);
	}

	public function editItem($id)
	{
		$menuItem = MenuItem::find($id);
		if(!$menuItem) {
			return redirect('admin/menu');
		}
		$menuItemOption = MenuItem::getParentOption($menuItem->menu_id, 0, $menuItem->parent_id);
		$data['menuItem'] = $menuItem;
		$data['menuItemOption'] = $menuItemOption;
		$status = Menu::$status;
		if ($status) {
			foreach ($status as $key => $value) {
				$status[$key] = trans($value);
			}
		}
		$data['status'] = $status;
		return view('admin.pages.menus.edit_item', $data);
	}

	public function updateItem(Request $request, $id)
	{
		$menuItem = MenuItem::find($id);
		if(!$menuItem) {
			return redirect('admin/menu');
		}

		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'status' => 'required',
			'link' => 'required',
		],[
			'name.required' => 'Tên trình đơn là trường bắt buộc',
			'status.required' => 'Trạng thái là trường bắt buộc',
			'link.required' => 'Đường dẫn tĩnh là trường bắt buộc',
		]);

	    if ($validator->fails()) {
	    	return redirect('admin/menu/item-update/' . $menu_id)->withErrors($validator)->withInput();;
		}
		
		if ($menuItem->update($request->all())) {
			Session::flash('success', 'Cập nhật trình đơn thành công');
		} else {
			Session::flash('danger', 'Lỗi: vui lòng thao tác lại');
		}
		return redirect('admin/menu/' . $menuItem->menu_id);
	}

	public function destroy($id)
	{

		$menu = Menu::findOrFail($id);

		if ($menu) {
			if($menu->delete()) {
				Session::flash('success', 'Bạn đã xóa menu thành công!');
			} elseif ($order->statusInactive()) {
				Session::flash('success', 'Bạn đã xóa menu thành công!');
			}
		}
		return redirect()->back();
	}	

	public function deleteItem($id)
	{

		$menuItem = MenuItem::findOrFail($id);

		if ($menuItem) {
			if($menuItem->delete()) {
				Session::flash('success', 'Bạn đã xóa menu thành công!');
			} elseif ($order->statusInactive()) {
				Session::flash('success', 'Bạn đã xóa menu thành công!');
			}
		}
		return redirect()->back();
	}

}
