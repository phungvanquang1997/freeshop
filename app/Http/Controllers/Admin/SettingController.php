<?php 
namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\Setting;
use Illuminate\Http\Request;
use Input;
use Route;
use Session;
use Validator;
use App\Helpers\ImageManager;

class SettingController extends AdminController
{

	public function index()
	{
		
	}

	public function create()
	{
		
	}

	public function store(SettingRequest $request)
	{
		
	}

	public function show($id)
	{
		//
	}

	public function edit()
	{
		$setting = Setting::get();
		$settings = [];
		foreach ($setting as $item) {
			$settings[$item->key] = $item->value;
		}
		$data['settings'] = $settings;
		$data['lang'] = Session('lang');
		return view('admin.pages.setting.edit', $data);
	}

	public function update(Request $request)
	{		
		$this->validate($request, [
			'site_logo' => 'mimes:jpeg,jpg,bmp,png|max:10240',
			'sub_logo' => 'mimes:jpeg,jpg,bmp,png|max:10240',
		],[
			'site_logo.mimes' => 'Định dạng ảnh không đúng',
			'site_logo.max' => 'Dung lượng ảnh lớn hơn 10240Kb',
			'sub_logo.mimes' => 'Định dạng ảnh không đúng',
			'sub_logo.max' => 'Dung lượng ảnh lớn hơn 10240Kb',
		]);
		$args = $request->all();
		foreach ($args as $key => $value) {
			if ($key != '_token' && $key != '_method') {
				$item = Setting::findByKey($key);
				if ($item) {
					$item->update(['value' => $value]);	
				} else {
					$item = Setting::create([
						'key' => $key,
						'name' => $key,
						'value' => $value,
					]);				
				}
				if ($key == 'site_logo' && $request->hasFile('site_logo')) {
					$image = $request->file('site_logo');

					//upload images
					$fileName = ImageManager::upload($image, 'banner');

					//insert to database
					$item->update(['value' => $fileName]);
				} 
				if ($key == 'sub_logo' && $request->hasFile('sub_logo')) {
					$image = $request->file('sub_logo');

					//upload images
					$fileName = ImageManager::upload($image, 'banner');

					//insert to database
					$item->update(['value' => $fileName]);
				}

				if ($key == 'show_room_1_image' && $request->hasFile('show_room_1_image')) {
					$image = $request->file('show_room_1_image');

					//upload images
					$fileName = ImageManager::upload($image, 'banner');

					//insert to database
					$item->update(['value' => $fileName]);
				}
				if ($key == 'show_room_2_image' && $request->hasFile('show_room_2_image')) {
					$image = $request->file('show_room_2_image');

					//upload images
					$fileName = ImageManager::upload($image, 'banner');

					//insert to database
					$item->update(['value' => $fileName]);
				}				

			}
		}

		Session::flash('success', 'Cài đặt thành công.');

		return redirect('admin/setting');
	}

	public function destroy($id)
	{
		
	}
}
