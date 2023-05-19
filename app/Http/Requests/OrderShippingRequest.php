<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class OrderShippingRequest extends Request
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
		switch ($this->method())
		{
			case 'GET':
			case 'DELETE':
			{
				return [];
			}
			case 'POST':
			{
				//$valid['transport_type'] = 'required';
				$item = $this->get('item');
				foreach ($item as $key => $value) {
					$valid['item.'.$key.'.transport_code'] = 'required';
					$valid['item.'.$key.'.weight'] = 'required';
				}
				return $valid;
			}
			case 'PUT':
			case 'PATCH':
			{
				//$valid['transport_type'] = 'required';
				$item = $this->get('item');
				foreach ($item as $key => $value) {
					$valid['item.'.$key.'.transport_code'] = 'required';
					$valid['item.'.$key.'.weight'] = 'required';
				}
				return $valid;
			}
			default:
				break;
		}
	}

	public function attributes()
	{
		//$attrs['transport_type'] = 'Hình thức vận chuyển';
		foreach($this->get('item') as $k => $v) {
			$attrs['item.'.$k.'.transport_code'] = 'Mã vận đơn';
			$attrs['item.'.$k.'.weight'] = 'Trọng lượng';
		}
		return $attrs;
	}

}
