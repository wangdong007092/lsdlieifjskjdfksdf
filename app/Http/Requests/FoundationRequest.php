<?php namespace WangDong\Http\Requests;

use WangDong\Http\Requests\Request;

class FoundationRequest extends Request {

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
		return [
			'module_id' => 'required|integer',
            'action_id' => 'required|integer',
            'name' => 'required|max:32'
		];
	}

}
