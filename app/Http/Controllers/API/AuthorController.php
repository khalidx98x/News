<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;



class AuthorController extends Controller
{



    public function index()
    {
        $authors = User::where('type', '2')->get(); // type 2 is author and type 1 is admin
        return parent::success($authors);
    }


    public function store(Request $request)
    {

        $validation = Validator::make($request->all(), $this->rules('post'));
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }

        $data = $request->except(['password', 'roles']);
        $data['password'] = Hash::make($request->password);
        $data['type'] = 2;
        $author = User::create($data);
        $author->syncRoles($request->roles);

        return parent::success($author);
    }


    public function update(Request $request, $id)
    {

        $validation = Validator::make($request->all(), $this->rules('patch',$id));
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }

        $author = User::findOrFail($id);
        $data = $request->except(['password']);
        if (isset($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $author->update($data);
        $author->syncRoles($request->roles);

        return parent::success($author);
    }


    public function destroy($id)
    {

        try {
            $role = User::findOrFail($id);
            $role->syncRoles([]);
            $role->delete();
            return $this->success($role);
        } catch (\Exception $exception) {
            return parent::error('user not found');
        }
    }




    private function rules($method, $id = null)
    {
        $rules = [
            'name' => 'required',
            'roles' => 'required',
            'roles.*' => 'required'
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
