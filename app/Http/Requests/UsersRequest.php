<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'group_id' => 'required',
            'photo'  => 'max:2000|mimes:jpeg,gif,png'
        ];

        $lastUrl = \GLobalHelper::lastUrl();

        if(!empty(\Request::segment(2))) :
            $rules['username'] = 'required|unique:users,username,'.$lastUrl;
            $rules['password'] = 'confirmed';
            $rules['email'] = 'required|email|unique:users,email,'.$lastUrl;
        else :
            $rules['username'] = 'required|unique:users,username';
            $rules['password'] = 'required|confirmed';
            $rules['email'] = 'required|email|unique:users,email';
        endif;

        return $rules;
    }
}
