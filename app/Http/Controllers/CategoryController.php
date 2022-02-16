<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ['data'=>Category::all()];
    }


    public function store(Request $request)
    {
        $data = new Category();
        $data->cat_title = $request->cat_title;
        $data->cat_description = $request->cat_description;
        $data->save();
        return ['msg'=>'saved successfully'];
    }

    public function show(Category $category)
    {
        return ['data'=>$category];
    }


    public function update(Request $request, Category $category)
    {
        $category->cat_title = $request->cat_title;
        $category->cat_description = $request->cat_description;
        $category->save();
        return ['msg'=>'updated successfully'];
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return ['msg'=>'deleted successfully'];
    }
}
