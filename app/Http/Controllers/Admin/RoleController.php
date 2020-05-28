<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Back\Role\StoreRequest;

class RoleController extends Controller
{
    //


    public function index(){
        $page_title = 'Role Page';
        $roles = Role::all();

        return view('admin.role.index')->with([
            'page_title'=>$page_title,
            'roles'=>$roles
        ]);
    }



    public function create(){
        $page_name = 'Role Page';
        $permissions = Permission::all();
        return view('admin.role.create')->with([
            'page_name'=>$page_name,
            'permissions'=>$permissions
            ]);
    }


    public function edit($id){
        $page_name = 'Edit Role';
        $role = Role::findOrFail($id);
        $selectedPermissions = $role->permissions()->get()->pluck('id')->toArray();
        $permissions = Permission::all();
        return view('admin.role.edit')->with([
            'role'=>$role,
            'page_name'=>$page_name,
            'selectedPermissions'=>$selectedPermissions,
            'permissions'=>$permissions
            ]);


    }


    public function store(StoreRequest $request){
        $role = Role::create(['name'=>$request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('role.index')->with('success','The role has been created successfully');

    }


    public function update(StoreRequest $request , $id){
        $role = Role::findOrFail($id);
        $role->update(['name'=>$request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('role.index')->with('success','The role has been updated successfully');



    }


    public function destroy($id){
        $role = Role::findOrFail($id);
        $role->syncPermissions([]);
        $role->delete();

        return redirect()->route('role.index')->with('success','The role has been deleted successfully');

    }
}
