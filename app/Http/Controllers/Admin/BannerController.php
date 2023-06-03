<?php 
namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Http\Requests;
use Input;
use Route;
use Session;
use Validator;
use Illuminate\Http\Request;
use App\BannerItem;
use App\Helpers\ImageManager;

class BannerController extends AdminController
{
	public function index()
	{
		$data['banners'] = Banner::where('lang_id', $this->lang_id)->get();

		return view('admin.pages.banner.list', $data);
	}

	public function create()
	{
		$status = Banner::$status;
		$banner = new Banner();

		if ($status) {
			foreach ($status as $key => $value) {
				$status[$key] = trans($value);
			}
		}

		$data['banner'] = $banner;
		$data['status'] = $status;		
		return view('admin.pages.banner.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$rules =  [
			'name' => 'required',
			'name.required' => 'Tên quảng cáo là trường bắt buộc',
	    ];
		$request->validate($rules);

	    // if ($validator->fails()) {
	    // 	return redirect('admin/banner/create')->withErrors($validator)->withInput();
		// }

		$banner = $request->all();
		$banner['lang_id'] = $this->lang_id;
		if (Banner::create($banner)) {
			Session::flash('success', 'Tạo quảng cáo thành công');
		} else {
			Session::flash('danger', 'Lỗi: vui lòng thao tác lại');
		}

		return redirect('/admin/banner');
	}

	public function show($id) {
		$banner = Banner::findOrFail($id);
		$items = $banner->bannerItems()->get();
		$data['bannerItems'] = $items;
		$data['banner'] = $banner;
		return view('admin.pages.banner.details', $data);
	}

	public function edit($id) 
	{
		$banner = Banner::findOrFail($id);
		$status = Banner::$status;
		if ($status) {
			foreach ($status as $key => $value) {
				$status[$key] = trans($value);
			}
		}
		$data['status'] = $status;
		$data['banner'] = $banner;
		return view('admin.pages.banner.edit', $data);
	}

	public function update(Request $request, $id)
	{
		$banner = Banner::find($id);
		if(!$banner) {
			return redirect('admin/banner');
		}
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'status' => 'required',
		],[
			'name.required' => 'Tên quảng cáo là trường bắt buộc',
			'status.required' => 'Trạng thái là trường bắt buộc'
		]);

	    if ($validator->fails()) {
	    	return redirect('admin/banner/' . $id . '/edit')->withErrors($validator)->withInput();
		}
		
		$data = $request->all();
		if ($banner->update($data)) {
			Session::flash('success', 'Cập nhật quảng cáo thành công');
		} else {
			Session::flash('danger', 'Lỗi: vui lòng thao tác lại');
		}
		return redirect('/admin/banner');
	}

	public function createItem($bannerId)
	{
		$banner = Banner::findOrFail($bannerId);
		$status = Banner::$status;
		$bannerItem = new BannerItem();

		if ($status) {
			foreach ($status as $key => $value) {
				$status[$key] = trans($value);
			}
		}
		$data = [];

		$data['banner'] = $banner;
		$data['bannerItem'] = $bannerItem;
		$data['status'] = $status;
		return view('admin.pages.banner.create_item', $data);
	}

	public function itemStore(Request $request, $bannerId)
	{
		$this->validate($request, [
			'name' => 'required',
			'status' => 'required',
			'link' => 'required',
	    ],[
			'name.required' => 'Tên quảng cáo là trường bắt buộc',
			'status.required' => 'Trạng thái là trường bắt buộc',
			'link.required' => 'Đường dẫn tĩnh là trường bắt buộc',
	    ]);

		$bannerItem = $request->all();
		if ($request->hasFile('image')) {
			$filename = ImageManager::upload($request->file('image'), 'banner');
			$bannerItem['image'] = $filename;
		}

		$bannerItem['banner_id'] =  $bannerId;
		$bannerItem['lang_id'] = $this->lang_id;

		if (BannerItem::create($bannerItem)) {
			Session::flash('success', 'Tạo thành công');
		} else {
			Session::flash('danger', 'Lỗi: vui lòng thao tác lại');
		}
		return redirect('admin/banner/' . $bannerId);
	}

	public function editItem($id)
	{
		$bannerItem = BannerItem::find($id);
		if(!$bannerItem) {
			return redirect('admin/banner');
		}

		$data['bannerItem'] = $bannerItem;
		$status = Banner::$status;
		if ($status) {
			foreach ($status as $key => $value) {
				$status[$key] = trans($value);
			}
		}
		$data['status'] = $status;
		return view('admin.pages.banner.edit_item', $data);
	}

	public function updateItem(Request $request, $id)
	{
		$bannerItem = BannerItem::find($id);
		if(!$bannerItem) {
			return redirect('admin/banner');
		}

		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'status' => 'required',
			'link' => 'required',
		],[
			'name.required' => 'Tên quảng cáo là trường bắt buộc',
			'status.required' => 'Trạng thái là trường bắt buộc',
			'link.required' => 'Đường dẫn tĩnh là trường bắt buộc',
		]);

	    if ($validator->fails()) {
	    	return redirect('admin/banner/item-update/' . $id)->withErrors($validator)->withInput();
		}

		$args = $request->all();

		if ($request->hasFile('image')) {
			$filename = ImageManager::upload($request->file('image'), 'banner');
			$args['image'] = $filename;
		}

		if ($bannerItem->update($args)) {
			Session::flash('success', 'Cập nhật trình đơn thành công');
		} else {
			Session::flash('danger', 'Lỗi: vui lòng thao tác lại');
		}
		return redirect('admin/banner/' . $bannerItem->banner_id);
	}

	public function destroy($id)
	{

		$banner = Banner::findOrFail($id);

		if ($banner) {
			if($banner->delete()) {
				Session::flash('success', 'Bạn đã xóa quảng cáo thành công!');
			} elseif ($banner->statusInactive()) {
				Session::flash('success', 'Bạn đã xóa quảng cáo thành công!');
			}
		}
		return redirect()->back();
	}	

	public function deleteItem($id)
	{

		$bannerItem = BannerItem::findOrFail($id);

		if ($bannerItem) {
			if($bannerItem->delete()) {
				Session::flash('success', 'Bạn đã xóa quảng cáo thành công!');
			} elseif ($bannerItem->statusInactive()) {
				Session::flash('success', 'Bạn đã xóa quảng cáo thành công!');
			}
		}
		return redirect()->back();
	}

}
