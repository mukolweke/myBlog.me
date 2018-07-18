<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        $post = new Post();

        $post = $request->get('title');
        $post = $request->get('body');

        $post->save();

        return response()->json($post);

    }
}
