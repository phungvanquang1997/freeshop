<?php 
namespace App\Http\Controllers\Admin;

use App\Helpers\Fee;
use Illuminate\Http\Request;

use App\User;
use DB;
use Input;
use Session;
use Validator;
use Hash;
use Auth;
use App\Helpers\Gmail;
use App\Order;

class UserController extends AdminController
{

	public function index()
	{
		$query = User::query();

		if (Input::has('is_admin') && Input::get('is_admin') == User::IS_ADMIN) {
			$query->where('is_admin', User::IS_ADMIN);
			if(Auth::user()->group != User::IS_ADMINISTRATOR) {
				Session::flash('error', 'Bạn không có quyền truy cập');
				return redirect('admin/user');
			}
		} else {
			$query->where('is_admin', '<>', User::IS_ADMIN);
		}
		
		if (Input::has('status')) {
			$query->where('status', Input::get('status'));
		}

		if (Input::has('user_name'))
		{
			$query->where('users.name', 'like', '%'.Input::get('user_name').'%');
		}

		if (Input::has('user_email'))
		{
			$query->where('users.email', 'like', '%'.Input::get('user_email').'%');
		}

		$data['users'] = $query->orderBy('created_at', 'desc')->get();

		return view('admin.pages.user.list', $data);
	}

	public function show($id)
	{
		$user = User::findOrFail($id);
		if (!$user)
			return redirect('admin/user');

		$query = Order::query();
		$query->where('user_id', $id);
		if (Input::has('orderId') && Input::get('orderId') != '')
		{
			$query->where('id', '=', Input::get('orderId'));
		}

		if (Input::has('status') && Input::get('status') != '')
		{
			$query->where('status', Input::get('status'));
		}

		if (Input::has('date')) {
			$date = explode('-', Input::get('date'));
			$date[0] = str_replace('/', '-', $date[0]);
			if (isset($date[1])) {
				$date[1] = str_replace('/', '-', $date[1]);					
				$query->whereDate('created_at', '>=', date('Y-m-d', strtotime(trim($date[0]))));
				$query->whereDate('created_at', '<=', date('Y-m-d', strtotime(trim($date[1]))));
			}
		}

		$orders = $query->orderBy('created_at', 'desc')->get();


		$totalAmount = Order::where('user_id', $id)->selectRaw("sum(total_amount) as total_amount")->get()->first(); 		
		$totalPaymented = Order::where('user_id', $id)->where('status', Order::ORDER_SUCCESS)->selectRaw("sum(total_amount) as total_amount")->get()->first(); 

		$data = [
			'user'          => $user,
			'orders'        => $orders,
			'totalAmount' => $totalAmount->total_amount,
			'totalPaymented' => $totalPaymented->total_amount,
		];

		return view('admin.pages.user.details', $data);
	}

	public function profile($id)
	{
		$user = User::findOrFail($id);
		if (!$user)
			return redirect('admin/user');
		if ($user->id != Auth::user()->id) {
			Session::flash('error', 'Truy nhập không hợp lệ.');
			return redirect('admin');
		}
		$data = [
			'user' => $user,
		];

		return view('admin.pages.user.details', $data);
	}

	public function create()
	{
		$groups = User::$groups;
		unset($groups[0]);
		$data = [
			'groups' => $groups,
		];
		return view('admin.pages.user.create', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::findOrFail($id);
		if (!$user)
			return redirect('admin/user');
		$groups = User::$groups;
		unset($groups[0]);
		$data = [
			'user' => $user,
			'groups' =>$groups,
		];
		return view('admin.pages.user.edit', $data);
	}

	/**
	 * @param Requests $request
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update(Request $request, $id)
	{
		$user = User::findOrFail((int) $id);
		if (!$user)
			return redirect('admin/user');

		$data = $request->all();

		if ($user->update($data)) {
			Session::flash('success', 'Cập nhật thông tin thành công!');
		}

		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::findOrFail($id);
		if (!$user)
			return redirect('admin/user');

		if ($user->id == Auth::user()->id) {
			Session::flash('success', 'Không thể tự xóa tài khoản');
			return redirect()->back();
		}
		if ($user->id == Auth::user()->id && Auth::user()->group == 1) {
			Session::flash('success', 'Không thể xóa tài khoản Administrator.');
			return redirect()->back();
		}
		if ( $user->group == 1) {
			Session::flash('success', 'Không thể xóa tài khoản cao hơn.');
			return redirect()->back();
		}

		if ($user->delete()) {
			Session::flash('success', 'Xóa tài khoản người dùng thành công!');
		}

		return redirect('admin/user');
	}

	public function changePassword($id) {

		$user = User::findOrFail($id);
		if (!$user)
			return redirect('admin/user');
		$data = [
			'user' => $user,
		];
		return view('admin.pages.user.changepassword', $data);
	}

	public function putPassword(Request $request, $id) 
	{
		$user = User::findOrFail($id);
		if (!$user)
			return redirect('admin/user');
		$data['user'] = $user;

		Validator::extend('checkpass', function($field,$value,$parameters){
			return password_verify($value, $parameters[0]);
		});
		$validator = Validator::make($request->all(), [
			'current_password' => 'required|checkpass:' . $user->password,
			'password' => 'required|confirmed|min:6',
			], ['checkpass' => 'Mật khẩu hiện tại không đúng']);
		
	    if ($validator->fails()) {
	    	return redirect('admin/user/change-password/' . $id)->withErrors($validator);
		}

		$password = Hash::make($request->get('password'));
		if($user->update(['password' => $password])) {
			Session::flash('success', 'Đổi mật khẩu thành công!');
		} else {
			Session::flash('danger', 'Đổi mật khẩu thất bại!');
		}
		return redirect('admin/user/' . $user->id);
	}

	public function putStatus(Request $request, $id)
	{
		$user = User::findOrFail((int) $id);
		if (!$user)
			return redirect('admin/user');
		if ($user->id == Auth::user()->id) {
			Session::flash('success', 'Không thể tự vô hiệu tài khoản');
			return redirect()->back();
		}
		if ($user->id == Auth::user()->id && Auth::user()->group == 1) {
			Session::flash('success', 'Không thể vô hiệu tài khoản Administrator');
			return redirect()->back();
		}

		$data = $request->all();

		if ($user->update($data)) {
			Session::flash('success', 'Thay đổi trạng thái thành công!');
		} else {
			Session::flash('danger', 'Thay đổi trạng thái thất bại!');
		}

		return redirect()->back();
	}
}
