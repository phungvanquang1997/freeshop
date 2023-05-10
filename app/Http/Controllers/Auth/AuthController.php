<?php 
namespace App\Http\Controllers\Auth;

use App\Helpers\Gmail;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Session;
use App\Setting;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar $registrar
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	public function postRegister(Request $request)
	{
		$validator = $this->registrar->validator($request->all());
		$site_name = Setting::findValueByKey('site_name') != null ? Setting::findValueByKey('site_name') : '';
		if ($request->get('inlaw') == null || (int) $request->get('inlaw') == 0) {
			Session::flash('warning', 'Bạn phải đồng ý với quy định của ' . $site_name);
			return redirect('/tai-khoan.html')->withErrors($validator)->withInput();
		}
		if ($validator->fails())
		{	
			$errorsText = '';
			foreach($validator->messages()->all() as $er) {
				$errorsText .= $er . '<br/>';
			}
			Session::flash('error', $errorsText);
			$this->throwValidationException(
				$request, $validator
			);
		}
		
		if ($user = $this->registrar->create($request->all())) {
			//send welcome email
			Gmail::sendWelcome(['to' => $request->get('email'), 'name' => $request->get('name'), 'auth_token' => $user->auth_token, 'password' => $request->get('password'), 'site_name' => $site_name]);

			Session::flash('success', 'Chúc mừng bạn đăng ký tài khoản thành công! Vui lòng kiểm tra email để kích hoạt tài khoản!');
		}

		return redirect('/');
	}
}
