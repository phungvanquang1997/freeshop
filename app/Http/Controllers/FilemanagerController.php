<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use View;
use App;
use DB;
use URL;
use FilemanagerLaravel;

class FilemanagerController extends Controller
{
    public function __construct()
    {

	}

	public function getConnectors()
	{
		$extraConfig = array('dir_filemanager'=>'/');
		$f = \FilemanagerLaravel::Filemanager($extraConfig);
		$f->connector_url = url('/').'/filemanager/connectors';
		$f->run();
	}

	public function getShow()
	{
		return view('vendor.filemanager-laravel.filemanager.index');
	}

	public function postConnectors()
	{
		$extraConfig = array('dir_filemanager'=>'/');
		$f = \FilemanagerLaravel::Filemanager($extraConfig);
		$f->connector_url = url('/').'/filemanager/connectors';
		$f->run();
	}	
}
