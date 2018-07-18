<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
    // get all records return in json format

    public function index()
    {

        $post = Post::all();

        return response()->json($post);

    }

    public function store(Request $request)
    {
        $input = $request->all();
        $post = Post::create($input);
//        $post = new Post();
//
//        $post = $request->get('title');
//        $post = $request->get('body');
//
//        $post->save();

        return response()->json($post);

    }


    public function edit($id)
    {

        $post = Post::find($id);

        return response()->json($post);

    }
}
