<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersRequest extends FormRequest
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
        return [
            'fullname' => 'required',
            'lastname' => 'required',
            'email' => 'email|unique:users,email,'.$this->route('user'),
            'role_id' => 'required',
			'profile_pic' => 'image|mimes:jpg,jpeg,bmp,png',
        ];
    }
}
