<?php namespace WangDong\Http\Requests;

use WangDong\Http\Requests\Request;

class GroupRequest extends Request {

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
            'name' => 'required|max:16',
            'permission_code' => 'integer'
		];
	}

}
