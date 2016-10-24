<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title'  => 'required',
            'tagline'  => 'required',
            'tag'  => '',
            'status'  => 'required',
            'meta_title'  => 'max:70',
            'meta_keyword'  => '',
            'meta_description'  => 'max:160',
            'photo'     => 'max:2000|mimes:jpeg,gif,png'
        ];

        $lastUrl = \GLobalHelper::lastUrl();

        if(!empty(\Request::segment(2))) :
        else :
        endif;

        return $rules;
    }
}
