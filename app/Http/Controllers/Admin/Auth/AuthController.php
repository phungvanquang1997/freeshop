<?php 
namespace App\Http\Controllers\Admin\Auth;

use App\Helpers\Gmail;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Session;

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

		//$this->middleware('guest', ['except' => 'getLogout']);
	}

	public function postRegister(Request $request)
	{
		$validator = $this->registrar->validator($request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}
		$data = $request->all();
		$data['is_admin'] = (int) 1;

		if ($this->registrar->create($data)) {
			Session::flash('success', 'Đăng ký tài khoản quản trị viên thành công!');
		}

		return redirect('admin/user');
	}
}
