<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{


    
    public function store(Request $request){

        $validation = Validator::make($request->all(), $this->rules('post'));
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }

        $user=User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'type'=>2,
        ]);

        return parent::success($user);
    }

    
    private function rules($method, $id = null)
    {
        $rules = [
            'name' => 'required',
        ];

        if ($method == 'post') {
            $rules += [
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ];
        }

        if ($method == 'patch') {

            $rules += [
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($id),
                ],
            ];
        }

        return $rules;
    }

}
