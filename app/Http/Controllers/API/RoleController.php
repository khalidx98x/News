<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return parent::success($roles);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), $this->rules('post'));
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return parent::success($role);
    }

    public function update(Request $request , $id){
        $role = Role::findOrFail($id);
        $role->update(['name'=>$request->name]);
        $role->syncPermissions($request->permissions);

        return parent::success($role);
    }

    public function destroy($id){
        $role = Role::findOrFail($id);
        $role->syncPermissions([]);
        $role->delete();

        return parent::success($role);

    }

    private function rules($method, $id = null)
    {
        return [
            'name'=>['required'],
            'permissions' => 'required|array',
            'permissions.*' => 'required|string'
        ];
    }
}
