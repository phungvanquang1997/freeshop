<?php 
namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Requests;
use Input;
use Route;
use Session;
use Validator;
use Illuminate\Http\Request;

class CommentController extends AdminController
{
	public function index()
	{
		$query = Comment::orderBy('created_at', 'desc');
		if (request()->has('status'))
		{
			$query->where('status', request()->get('status'));
		}
		if (request()->has('product'))
		{
			$query->where('post_id', request()->get('product'));
		}
		if (request()->has('name'))
		{
			$query->where('name', 'like', '%'.request()->get('name').'%');
		}
		if (request()->has('email'))
		{
			$query->where('email', 'like', '%'.request()->get('email').'%');
		}
		if (request()->has('content'))
		{
			$query->where('content', 'like', '%'.request()->get('content').'%');
		}
		$data['comments'] = $query->get();
		return view('admin.pages.comment.list', $data);
	}

	public function create()
	{
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		
	}

	public function show($id) {
	}

	public function edit($id) 
	{
		
	}

	public function update(Request $request, $id)
	{
		$comment = Comment::find($id);
		$data['status'] = $comment->status == 1 ? 0 : 1;

		if ($comment->update($data)) {
			Session::flash('success', 'Cập nhật thành công');
		} else {
			Session::flash('danger', 'Lỗi: vui lòng thao tác lại');
		}
		return redirect('/admin/comment');
	}

	public function destroy($id)
	{

		$comment = Comment::findOrFail($id);

		if ($comment) {
			if($comment->delete()) {
				Session::flash('success', 'Bạn đã xóa thành công!');
			}
		}
		return redirect()->back();
	}	

}
