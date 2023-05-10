<?php 
namespace App\Http\Controllers\Admin;

use App\Coupons;
use App\Helpers\CString;
use Session;
use Validator;
use Illuminate\Http\Request;

class CouponsController extends AdminController
{
	public function index()
	{
		$data['coupons'] = Coupons::all();

		return view('admin.pages.coupons.list', $data);
	}

	public function create()
	{
		$coupon = new Coupons();
		$status = Coupons::$status;
		if ($status) {
			foreach ($status as $key => $value) {
				$status[$key] = trans($value);
			}
		}
		$data['status'] = $status;
		$data['types'] = Coupons::$types;
		$data['coupon'] = $coupon;

		return view('admin.pages.coupons.create', $data);
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
			'status' => 'required',
			'num' => 'required',
			'num_per_user' => 'required',
			'type' => 'required',
			'date_range' => 'required',
			'value' => 'required',
			'voucher' => 'sometimes|unique:coupons|min:6',
		],[
			'name.required' => 'Tên là trường bắt buộc',
			'status.required' => 'Trạng thái là trường bắt buộc',
			'num.required' => 'Số lần khuyến mại là trường bắt buộc',
			'num_per_user.required' => 'Số lần/ khách hàng là trường bắt buộc',
			'type.required' => 'Loại khuyến mại là trường bắt buộc',
			'date_range.required' => 'Thời gian hiệu lực là trường bắt buộc',
			'value.required' => 'Giá trị là trường bắt buộc',
			'voucher.unique' => 'Mã khuyến mãi đã tồn tại, chọn một mã khác hoặc sinh tự động',
			'voucher.min' => 'Mã khuyến mại phải có 6 ký tự',
		]);

		$coupons = $request->all();
		$dateRange = $coupons['date_range'];
		$date = explode('-', $dateRange);
		if (!isset($date[0]) || !isset($date[1])) {
			$validator->errors()->add('date_range', 'Chưa chọn đúng thời gian hiệu lực');
		}

	    if ($validator->fails()) {
	    	return redirect('admin/coupons/create')->withErrors($validator)->withInput();;
		}
		
		if (!isset($coupons['voucher']) || $coupons['voucher'] == '') {
			$coupons['voucher'] = CString::unique_random($table='coupons', $col = 'voucher', $lenght = 6);
		}
		$coupons['num_used'] = 0;
		$date[0] = str_replace('/', '-', $date[0]);
		$date[1] = str_replace('/', '-', $date[1]);
		$coupons['start_date'] = date('Y-m-d', strtotime($date[0]));
		$coupons['end_date'] = date('Y-m-d', strtotime(trim($date[1])));

		if (Coupons::create($coupons)) {
			Session::flash('success', 'Tạo khuyến mại thành công');
		} else {
			Session::flash('danger', 'Lỗi: vui lòng thao tác lại');
		}
		return redirect('/admin/coupons');
	}

	public function show($id) {
		$coupons = Coupons::findOrFail($id);

		$data['coupons'] = $coupons;
		return view('admin.pages.coupons.details', $data);
	}

	public function edit($id) 
	{
		$coupon = Coupons::findOrFail($id);
		$date_range = date('d/m/Y', strtotime($coupon->start_date)) . ' - ' . date('d/m/Y', strtotime($coupon->end_date));
		$status = Coupons::$status;
		if ($status) {
			foreach ($status as $key => $value) {
				$status[$key] = trans($value);
			}
		}
		$data['status'] = $status;
		$data['types'] = Coupons::$types;
		$data['coupon'] = $coupon;
		$data['date_range'] = $date_range;
		return view('admin.pages.coupons.edit', $data);
	}

	public function update(Request $request, $id)
	{
		$coupons = Coupons::find($id);
		if(!$coupons) {
			return redirect('admin/coupons');
		}
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'status' => 'required',
			'num' => 'required',
			'num_per_user' => 'required',
			'type' => 'required',
			'date_range' => 'required',
			'voucher' => 'sometimes|unique:coupons|min:6',
		],[
			'name.required' => 'Tên trình đơn là trường bắt buộc',
			'status.required' => 'Trạng thái là trường bắt buộc',
			'num.required' => 'Số lần khuyến mại là trường bắt buộc',
			'num_per_user.required' => 'Số lần/ khách hàng là trường bắt buộc',
			'type.required' => 'Loại khuyến mại là trường bắt buộc',
			'date_range.required' => 'Thời gian hiệu lực là trường bắt buộc',
			'voucher.unique' => 'Mã khuyến mãi đã tồn tại, chọn một mã khác hoặc sinh tự động',
			'voucher.min' => 'Mã khuyến mại phải có 6 ký tự',
		]);

		$data = $request->all();
		$dateRange = $data['date_range'];
		$date = explode('-', $dateRange);
		if (!isset($date[0]) || !isset($date[1])) {
			$validator->errors()->add('date_range', 'Chưa chọn đúng thời gian hiệu lực');
		}

	    if ($validator->fails()) {
	    	return redirect('admin/coupons/create')->withErrors($validator)->withInput();;
		}
		
		if (!isset($data['voucher']) || $data['voucher'] == '') {
			$data['voucher'] = CString::unique_random($table='coupons', $col = 'voucher', $lenght = 6);
		}
		
		$date[0] = str_replace('/', '-', $date[0]);
		$date[1] = str_replace('/', '-', $date[1]);
		$data['start_date'] = date('Y-m-d', strtotime($date[0]));
		$data['end_date'] = date('Y-m-d', strtotime(trim($date[1])));

		if ($coupons->update($data)) {
			Session::flash('success', 'Cập nhật trình đơn thành công');
		} else {
			Session::flash('danger', 'Lỗi: vui lòng thao tác lại');
		}
		return redirect('/admin/coupons');
	}

	public function destroy($id)
	{

		$coupons = Coupons::findOrFail($id);

		if ($coupons) {
			if($coupons->delete()) {
				Session::flash('success', 'Bạn đã xóa thành công!');
			}
		}
		return redirect()->back();
	}	

}
