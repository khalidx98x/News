<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return parent::success($categories);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), $this->rules('post'));
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }

        $categories = Category::create($request->all());
        return parent::success($categories);
    }

    public function update(Request $request, $id)
    {

        $validation = Validator::make($request->all(), $this->rules('post'));
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }

        $category = Category::findOrFail($id);
        $category->update($request->all());
        return parent::success($category);
    }

    
    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return parent::success($category);
    }

    public function status($id){
        $category = Category::findOrFail($id);
        $category->status ==1?$category->status =0 :$category->status =1;
        $category->save();
        return parent::success($category);
    }

    

    private function rules($method, $id = null)
    {
        $rules = [
            'name' => 'required|string'

        ];
        return $rules;
    }
}
