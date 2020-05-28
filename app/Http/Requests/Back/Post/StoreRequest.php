<?php

namespace App\Http\Requests\Back\Post;

use Illuminate\Foundation\Http\FormRequest;

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
          'title'=>'required',
          'category_id'=>'required',
          'short_description'=>'required',
          'description'=>'required'

      ];


        if($this->getMethod()=='POST'){
            $rules+=[
                'image'=>'required|image'
            ];
           }


           return $rules;
    }
}
