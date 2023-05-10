<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Config;
use Session;
use App\User;

class AdminController extends Controller
{

	public function __construct()
	{
		//$this->middleware('auth.admin');
		//$this->middleware('auth.permission');
		$this->lang_id = Session('lang', Config::get('app.locale'));
	}
}
