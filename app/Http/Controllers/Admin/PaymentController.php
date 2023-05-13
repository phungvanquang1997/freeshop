<?php namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\Payment;
use Illuminate\Http\Request;
use Input;
use Route;
use Session;
use Auth;
use App\User;

class PaymentController extends AdminController
{

	public function index()
	{
		$query = Payment::query();
		$query->select('payments.*', 'users.name AS user_name', 'users.email AS user_email');
		if (request()->has('type'))
		{
			$query->where('type', request()->get('type'));
		}
		if (request()->has('user_name'))
		{
			$query->where('users.name', 'like', '%'.request()->get('user_name').'%');
		}
		$query->join('users', 'users.id', '=', 'payments.user_id');
		$data['payments'] = $query->orderBy('created_at', 'desc')->get();
		return view('admin.pages.payment.list', $data);
	}

	public function create()
	{
		
	}

	public function store(PaymentRequest $request)
	{
		
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		
	}

	public function update($id, PaymentRequest $request)
	{
		
	}

	public function destroy($id)
	{
		if (Auth::user()->group == User::IS_ADMINISTRATOR) {
			$payment = Payment::findOrFail($id);

			if ($payment->delete()) {
				Session::flash('success', 'Xóa thành công.');
			}
		} else {
			Session::flash('error', 'Không có quyền thực hiện thao tác này.');
		}

		return redirect('admin/payment');
	}
	
}
