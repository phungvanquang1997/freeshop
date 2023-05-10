<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Comment;
use Illuminate\Http\Request;
use Session;
use Auth;

class CommentController extends BaseController {

    public function __construct()
    {        
        parent::__construct();
    }
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$data = [
			'post_id' => $request->get('post_id'),
			'name' => $request->get('comment_name'),
			'content' => $request->get('comment_content'),
			'email' => $request->get('comment_email'),
			'star' => $request->get('comment_rating'),
			'status' => 0,
		];
		if (!Auth::guest()) {
			$data['user_id'] = Auth::Id();
		}
		$comment = Comment::create($data);
		return json_encode($comment);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$order = Order::find($id);
		if ($order) {
			$items = $order->items()->get();
			
			return view('pages.account.order.details', compact('order', 'items'));	
		}
		
		return abort(404);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$order = Order::findOrFail($id);

		if ($order) $order->delete();

		Session::flash('success', 'Bạn đã xóa đơn hàng!');

		return redirect('tai-khoan/don-hang.html');
	}

	public function status()
	{
		return view('pages.order-status.index');
	}

	public function getStatus(Request $request)
	{
		$this->validate($request, ['email' => 'required|email']);

		$data['orders'] = Order::where('email', $request->get('email'))->get();
		$data['old_email'] = $request->get('email');
		
		return view('pages.order-status.details', $data);
	}

}
