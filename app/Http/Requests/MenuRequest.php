<?php namespace App\Http\Requests;

use Auth;

class MenuRequest extends Request
{

	public function authorize()
	{
		return Auth::user()->is_admin ? true : false;
	}

	public function rules()
	{
		switch ($this->method())
		{
			case 'GET':
			case 'DELETE':
			{
				return [];
			}
			case 'POST':
			{
				return [];
			}
			case 'PUT':
			case 'PATCH':
			{
				return ['name' => 'required'];
			}
			default: break;
		}
	}

}
