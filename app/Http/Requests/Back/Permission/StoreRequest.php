<?php

namespace App\Http\Requests\Back\Permission;

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
    //     $rules =[];

    //    if($this->getMethod()=='POST'){
    //     $rules+=[
    //         'name'=>'required|alpha_dash',

    //     ];
    //    }


    //    if($this->getMethod()=='PATCH'){

    //    }

    //    return $rules;

    return [
        'name'=>['required','alpha_dash']
    ];
    }
}
