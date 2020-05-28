<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{


    public function index()
    {

        $permissions = Permission::orderBy('created_at', 'desc')->get();
        return parent::success($permissions);
    }

    public function store(Request $request)
    {

        $validation = Validator::make($request->all(), $this->rules('post'));
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }

        $permissions = Permission::create(['name' => $request->name]);
        return parent::success($permissions);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), $this->rules('post'));
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }

        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        return parent::success($permission);
    }


    public function destroy($id)
    {
        $permissions=Permission::whereId($id)->delete();
        return parent::success($permissions);
    }

    private function rules($method, $id = null)
    {
        return [
            'name' => ['required', 'alpha_dash']
        ];
    }
}
