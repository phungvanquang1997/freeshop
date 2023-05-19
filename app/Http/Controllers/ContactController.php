<?php 
namespace App\Http\Controllers;

use App\Contact;
use App\Page;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Session;
use LaravelCaptcha\Facades\Captcha;

class ContactController extends BaseController {

	public function index()
	{
		$pages = Page::get();

		$data = [
			'pages' => $pages,
			'captcha' => Captcha::html()
		];		
		return view('web.pages.pages.contact', $data);
	}

	public function create(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email',
			'name' => 'required',
			'phone' => 'required',
			'content' => 'required',
			'captcha' => 'required|bone_captcha',
		]);

		$data = $request->all();
		$data['type'] = 1;

		$contact = Contact::create($data);
		if ($contact) {
			Session::flash('success', 'Gửi phản hồi thành công.');
			return redirect('/lien-he.html');
		}

		return redirect(URL::previous())
			->withInput()
			->withErrors([
				'message' => 'Can not send your comment!',
			]);
	}

	public function partner()
	{
		$pages = Page::get();

		$data = [
			'pages' => $pages,
			'captcha' => Captcha::html()
		];		
		return view('web.pages.pages.partner', $data);
	}

	public function createPartner(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email',
			'name' => 'required',
			'phone' => 'required',
			'content' => 'required',
			'captcha' => 'required|bone_captcha',
			'company' => 'required',
			'address' => 'required',
		]);
		$data = $request->all();
		$data['type'] = 2;

		$contact = Contact::create($data);
		if ($contact) {
			Session::flash('success', 'Gửi yêu cầu hợp tác thành công.');
			return redirect('/hop-tac-kinh-doanh.html');
		}

		return redirect(URL::previous())
			->withInput()
			->withErrors([
				'message' => 'Can not send your comment!',
			]);
	}

}
