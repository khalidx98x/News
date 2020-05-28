<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Back\Permission\StoreRequest;

class PermissionController extends Controller
{
    //

    public function __construct()
    {

        $this->middleware(['permission:index-permissions|all'])->only('index');
        $this->middleware(['permission:create-permissions|all'])->only('create');
        $this->middleware(['permission:update-permissions|all'])->only('edit');
        $this->middleware(['permission:delete_permissions|all'])->only('destroy');


    }

    public function index(){

        $page_title = 'Permission';
        $permissions = Permission::orderBy('created_at','desc')->get();

        return view('admin.permission.index')->with([
            'page_title'=>$page_title,
            'permissions'=>$permissions
        ]);
    }


    public function create(){
        return view('admin.permission.create');
    }


    public function store(StoreRequest $request){
        Permission::create(['name'=>$request->name]);
        return redirect()->route('permission.index')->with('success','The Permission has been created successfully !!');
    }

    public function edit($id){
        $permission = Permission::findOrFail($id);

        return view('admin.permission.edit')->with([
            'permission'=>$permission
        ]);

    }

    public function update(StoreRequest $request,$id){
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        return redirect()->route('permission.index')->with('success','The Permission has been updated successfully !!');

    }


    public function destroy($id){
        Permission::whereId($id)->delete();
        return redirect()->route('permission.index')->with('success','The Permission has been deleted successfully !!');

    }
}
