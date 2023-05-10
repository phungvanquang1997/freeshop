<?php 
namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Session;

class AuthController extends Controller
{

	public function index()
	{
		return view('admin.pages.login');
	}

	public function login(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email', 'password' => 'required'
		]);

		$user = User::where('email', $request->get('email'))->first();

		if ($user) {
			if ($user->id && $user->is_admin && $user->status == 1 && password_verify($request->get('password'), $user->password)) {
					Auth::login($user);
					dd(1);
					return redirect('/admin');
				}
			if ($user->status == 0) {
				Session::flash('success', 'Tài khoản hiện tại đang bị khóa');
			}
		}		
        dd(2);
		return redirect('/admin/auth')
			->withInput($request->only('email', 'remember'))
			->withErrors([
				'name' => $this->getFailedLoginMessage(),
			]);
	}

	public function logout()
	{
		Auth::logout();

		return redirect('/admin/auth');
	}

	protected function getFailedLoginMessage()
	{
		return 'Username or password is wrong!';
	}

}