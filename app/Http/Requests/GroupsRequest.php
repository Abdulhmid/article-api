<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupsRequest extends FormRequest
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
        $lastUrl = \GLobalHelper::lastUrl();

        if(!empty(\Request::segment(2))) :
            $rules['group_name']    = 'required|unique:groups,group_name,'.$lastUrl.',group_id';
        else :
            $rules['group_name']    = 'required|unique:groups,group_name';
        endif;

        return $rules;
    }
}
