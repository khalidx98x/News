<?php

namespace App\Http\Requests\Back\Author;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
        $rules =[
            'name'=>'required',
            'roles'=>'required',
            'roles.*'=>'required'

        ];


        if($this->getMethod()=='POST'){
         $rules+=[
             'email'=>'required|email|unique:users',
             'password'=>'required',

         ];
        }


        if($this->getMethod()=='PATCH'){
            $rules+=[
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($this->author),
                ],

            ];
        }

        return $rules;

    }
}
