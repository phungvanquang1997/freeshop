<?php namespace App\Http\Requests;

class ComplainRequest extends Request
{

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		switch($this->method())
		{
			case 'GET':
			case 'DELETE':
			{
				return [];
			}
			case 'POST':
			{
				return [
					'specie'        => 'required',
					'image'       => 'mimes:jpeg,jpg,bmp,png|max:10240',
					'content' => 'required',
					
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'specie'        => 'required',
					'image'       => 'mimes:jpeg,jpg,bmp,png',
					'content' => 'required',
				];
			}
			default:break;
		}

	}

	protected function getValidatorInstance()
	{
		$validator = parent::getValidatorInstance();

		if ($this->exists('images'))
		{
			$validator->each('images', ['image']);
		}

		return $validator;
	}

	public function attributes()
	{
		return [
			'specie' => 'Loại khiếu nại',
			'image' => 'Hình ảnh khiếu nại',
			'content' => 'Nội dung khiếu nại',
			
		];
	}

}
