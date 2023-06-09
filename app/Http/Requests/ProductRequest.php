<?php 
namespace App\Http\Requests;

class ProductRequest extends Request
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
					'name'        => 'required',
					'sku'         => 'required|unique:products',
					'category_id' => 'required',
					'image'       => 'mimes:jpeg,jpg,bmp,png',
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'name'        => 'required',
					'sku'         => 'required|min:5',
					'category_id' => 'required',
					'image'       => 'mimes:jpeg,jpg,bmp,png',
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
            $validator->addRules(['images.*' => 'image']);
		}

		return $validator;
	}

}
