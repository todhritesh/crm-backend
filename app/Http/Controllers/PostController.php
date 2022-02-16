<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post::with('category')->get();
        if($data->isEmpty()){
            return response()->json([
                'message'=>'not found',
            ],404);
        }

        return response()->json([
            'data'=>$data,
        ],200);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'=>'required',
            'content'=>'required',
            'author'=>'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=>'validation error',
                'error'=>$validator->errors(),
            ],403);
        }

        $data = new Post();
        $data->title = $request->title;
        $data->content = $request->content;
        $data->category_id = $request->category_id;
        $data->author = $request->author;
        $saved = $data->save();

        if($saved){
            return response()->json([
                'message'=>'data saved successfully',
            ],200);
        }

        return response()->json([
            'message'=>'unable to save'
        ],500);

    }


    public function show(Post $post)
    {
        return ['data'=>$post];
    }


    public function update(Request $request, Post $post)
    {
        // return 43;
        return request();
        $validator = Validator::make($request->all(),[
            'title'=>'required',
            'content'=>'required',
            'author'=>'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=>'validation error',
                'error'=>$validator->errors(),
            ],403);
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->author = $request->author;
        $updated = $post->save();
        if($updated){
            return response()->json([
                'message0'=>'updated successfully',
            ],200);
        }
        return response()->json([
            'message0'=>'unable to update',
        ],500);
    }


    public function destroy(Post $post)
    {
        $post->delete();
        return ['msg'=>'deleted successfully'];
    }
}
