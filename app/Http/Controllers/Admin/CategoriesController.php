<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Category\StoreRequest;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //

   protected $page_name = 'Category Page';
   public function __construct(){
        $this->middleware('permission:index-category|all')->only('index');
        $this->middleware('permission:create-category|all')->only('create');
        $this->middleware('permission:update-category|all')->only('edit');
        $this->middleware('permission:delete-category|all')->only('destroy');
        $this->middleware('permission:status-category|all')->only('status');
   }

    public function index(){
        $categories = Category::all();
        return view('admin.category.index')->with([
            'page_name'=>$this->page_name,
            'categories'=>$categories
        ]);
    }

    public function create(){
        return view('admin.category.create')->with([
            'page_name'=>$this->page_name
        ]);
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.category.edit')->with([
            'category'=>$category,
            'page_name'=>$this->page_name
        ]);
    }





    public function store(StoreRequest $request){
        Category::create($request->all());
        return redirect()->route('category.index')->with('success','The Category has been created successfully !!');
    }



    public function update(StoreRequest $request , $id){
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('category.index')->with('success','The Category has been updated successfully !!');

    }

    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.index')->with('success','The Category has been deleted successfully !!');

    }

    public function status($id){
        $category = Category::findOrFail($id);
        $category->status ==1?$category->status =0 :$category->status =1;
        $category->save();
        return redirect()->route('category.index')->with('success','The Category status has been changed successfully !!');

    }

}
