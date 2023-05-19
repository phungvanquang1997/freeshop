<?php 
namespace App\Http\Controllers;

use App\Helpers\Currency;
use App\Helpers\Fee;
use App\Helpers\Gmail;
use App\Http\Requests;

use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Session;
use URL;
use Validator;
use App\Setting;
use Hash;
use App\Province;


class AccountController extends Controller
{

	use AuthenticatesAndRegistersUsers;

	protected $loginPath = '/';

	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	public function index()
	{

		if (!Auth::guest() && Auth::user()->is_admin != 1)
		{
			return redirect('tai-khoan/ho-so.html');
		}

		return view('web.pages.account.signup');
	}

	public function login(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'p_email' => 'required|email',
			'p_password' => 'required',
		],[
			'p_email.required' => 'Bạn phải điền email',
			'p_email.email' => 'Email không đúng định dạng',
			'p_password.required' => 'Bạn phải điền mật khẩu',
		]);

	    if ($validator->fails()) {
	    	$errors = $validator->messages()->all();
	    	Session::flash('warning', $errors[0]);
	    	return redirect('/')->withErrors($validator)->withInput();
		}
		$data = [
			'email' => $request->get('p_email'),
			'password' => $request->get('p_password'),
		];
		$credentials = $data;
		$user = User::where('email', $request->get('p_email'))->first();
		if ($user && $user->status == 0) {
			Session::flash('warning', 'Tài khoản chưa được kích hoạt. Vui lòng kiểm tra email và kích hoạt tài khoản.');
			return redirect()->back();
		}

		if ($this->auth->attempt($credentials, $request->has('remember')))
		{
			Session::flash('success', "Chào mừng quay trở lại, " . Auth::user()->name);

			return redirect('/');
		}

		Session::flash('error', 'Tài khoản hoặc mật khẩu không đúng');
		return redirect()->back()
			->withInput($request->only('p_email', 'remember'))
			->withErrors([
				'email' => $this->getFailedLoginMessage(),
			]);
	}

	public function logout()
	{
		Auth::logout();

		return redirect('/');
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
	 */
	public function profile()
	{
		if (Auth::guest())
		{
			return redirect('tai-khoan.html');
		}

		return view('web.pages.account.profile');
	}

	public function order()
	{
		if (Auth::guest())
		{
			return redirect('tai-khoan.html');
		}

		$user = User::find(Auth::id());

		$orders = $user->orders()->orderBy('created_at', 'desc')->get();

		$data = [
			'orders' => $orders,
		];

		return view('web.pages.account.order', $data);
	}

	public function update(Request $request)
	{
		if (Auth::guest())
		{
			return redirect('tai-khoan.html');
		}

		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
			'phone' => 'required',
			'address' => 'required',
			'province_id' => 'required',
			'district_id' => 'required',
		],[
			'email.required' => 'Bạn phải điền email',
			'email.email' => 'Email không đúng định dạng',
			'phone.required' => 'Bạn phải điền số điện thoại',
			'province_id.required' => 'Bạn phải chọn Tỉnh/ TP',
			'district_id.required' => 'Bạn phải chọn Huyện/ Quận',
		]);

		if ($validator->fails()) {
	    	$errors = $validator->messages()->all();
	    	Session::flash('warning', $errors[0]);
	    	return redirect('/tai-khoan/ho-so.html')->withErrors($validator)->withInput();
		}

		if (Auth::user()->password)
		{
			$this->validate($request, [
				'email' => 'required|email', 'name' => 'required',
			]);
		}

		$data = array (
			'phone'   => trim($request->get('phone')),
			'address' => trim($request->get('address')),
			'name' => trim($request->get('name')),
			'province_id' => trim($request->get('province_id')),
			'district_id' => trim($request->get('district_id')),
		);

		if (Auth::user()->password)
		{
			$email = trim($request->get('email'));
			if ($email != Auth::user()->email)
			{
				$user = User::where('email', $email)->first();
				if ($user)
				{
					return redirect('/tai-khoan/ho-so.html')->withErrors([
						'email' => 'Địa chỉ mail này đã tồn tại.'
					]);
				}
				$data['email'] = $email;
			}
			$data['name'] = trim($request->get('name'));
		}

		$user = User::find(Auth::id());
		if ($user->update($data)) {
			Session::flash('success', 'Cập nhật thành công!');
		} else {
			Session::flash('danger', 'Cập nhật thất bại!');
		}

		return redirect('tai-khoan/ho-so.html');
	}

	public function paymentHistories($data_id = null)
	{
		if (Auth::guest())
		{
			return redirect('tai-khoan.html');
		}

		$user = User::find(Auth::id());

		$payments = $user->paymentHistories($data_id);

		$data = [
			'payments' => $payments,
		];

		return view('web.pages.account.payment', $data);
	}

	public function withdrawLogs($id = null)
	{
		if (Auth::guest())
		{
			return redirect('tai-khoan.html');
		}

		$user = User::find(Auth::id());

		$withdraws = $user->withdrawLogs();

		$data = [
			'withdraws' => $withdraws,
		];

		return view('web.pages.account.withdraw', $data);
	}

	public function verify($auth_token)
	{
		if ($auth_token) {
			$user = User::where('auth_token', $auth_token)->first();
			if(!$user) {
				return redirect('/');
			}
			if ($user->update(['status' => (int) 1])) {
				$this->auth->login($user);
				$data['user'] = $user;
				$support_phone = Setting::findValueByKey('support_phone');
				$data['support_phone'] = $support_phone;
				return view('web.pages.account.verify', $data);
			}
		}
		return redirect('/');
	}


	public function complain($id = 0)
	{
		if (Auth::guest())
		{
			return redirect('tai-khoan.html');
		}

		$user = User::find(Auth::id());

		$query = $user->complains()->where('status', '<>', Complain::STATUS_INACTIVE)->orderBy('updated_at', 'desc')->orderBy('created_at', 'desc')->paginate(15);

		$data = [
			'complains' => $query,
		];
		$data['species'] = Complain::$species;
		if ($id != 0) {
			$data['defaultDetailId'] = $id;
		} else {
			$data['defaultDetailId'] = 0;
		}
		return view('web.pages.account.complain', $data);
	}

	public function orderTransportCode($id)
	{
		if (Auth::guest())
		{
			return redirect('tai-khoan.html');
		}
		$order = OrderShipping::find($id);
		if (!$order) {
			return redirect('tai-khoan/don-hang.html');
		}
		if($order->user_id != Auth::user()->id) {
			Session::flash('error', 'Truy nhập không hợp lệ.');
			return redirect('/');
		}
		$packages = $order->packages()->where('type', OrderShippingPackage::TYPE_ORIGIN)->get();
		$extra= $order->packages()->where('type', OrderShippingPackage::TYPE_EXTRA)->get();
		
		if($packages) {
			foreach ($packages as $key => $value) {
				$packages[$key]->items = $value->items()->get();
			}
		}
		$data['packages'] = $packages;
		$data['order'] = $order;
		$data['extra'] = $extra;
		return view('web.pages.account.order_transport_code', $data);
	}

	public function changePassword()
	{
		return view('web.pages.account.password');
	}

	public function postPassword(Request $request)
	{
		$user = Auth::user();
		if (Auth::guest())
			return redirect('tai-khoan.html');

		Validator::extend('checkpass', function($field,$value,$parameters){
			return password_verify($value, $parameters[0]);
		});
		$validator = Validator::make($request->all(), [
			'current_password' => 'required|checkpass:' . $user->password,
			'password' => 'required|confirmed|min:6',
			], ['checkpass' => 'Mật khẩu hiện tại không đúng']);
		
	    if ($validator->fails()) {
	    	return redirect('tai-khoan/thay-doi-mat-khau.html')->withErrors($validator);
		}

		$password = Hash::make($request->get('password'));
		if($user->update(['password' => $password])) {
			Session::flash('success', 'Đổi mật khẩu thành công!');
		} else {
			Session::flash('danger', 'Đổi mật khẩu thất bại!');
		}
		return redirect('tai-khoan/thay-doi-mat-khau.html');
	}

	public function getDistricts(Request $request)
	{
		$id = $request->get('id');
		$province = Province::find($id);
		$districts = $province->districts()->get();
		$html = '';
		foreach ($districts as $item) {
			$html .= '<option value="'. $item->id .'">' . $item->name . '</option>';
		}
		echo $html;
	}


}
