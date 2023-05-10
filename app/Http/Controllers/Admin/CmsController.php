<?php namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Input;

class CmsController extends AdminController {

	public function contact()
	{
		$query = Contact::orderBy('created_at', 'desc');
		if (Input::has('type'))
		{
			$query->where('type', Input::get('type'));
		}
		if (Input::has('name'))
		{
			$query->where('name', 'like', '%'.Input::get('name').'%');
		}
		if (Input::has('email'))
		{
			$query->where('email', 'like', '%'.Input::get('email').'%');
		}
		if (Input::has('phone'))
		{
			$query->where('phone', 'like', '%'.Input::get('phone').'%');
		}
		if (Input::has('content'))
		{
			$query->where('content', 'like', '%'.Input::get('content').'%');
		}
		$data['contacts'] = $query->get();
		return view('admin.pages.contact.list', $data);
	}

	public function show($id) {
		$contact = Contact::find($id);
		return view('admin.pages.contact.detail', ['contact' => $contact]);
	}

	public function faq()
	{
		return view('admin.pages.cms.faq');
	}

	public function terms()
	{
		return view('admin.pages.cms.terms');	
	}

	public function policy()
	{
		return view('admin.pages.cms.policy');			
	}

	public function refund()
	{
		return view('admin.pages.cms.refund');	
	}
}
