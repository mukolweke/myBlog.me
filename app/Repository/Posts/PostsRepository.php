<?php
/**
 * Created by PhpStorm.
 * User: molukaka
 * Date: 11/07/2018
 * Time: 09:51
 */

namespace App\Repository\Posts;

use App\Post;

class PostsRepository {


    public function __construct(){}

    function getAllBlogs(){

        return  \App\Post::orderBy('created_at', 'desc')->get();

    }


    function postBlog($request){

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->priority = 0;
        $post->save();

    }

    function postTestBlog($data){

        $post = new Post();
        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->user_id = $data['user_id'];
        $post->priority = 0;

        return $post;

    }

    function getOneBlog($id){

        // get one post
        return Post::find($id);

    }

    function updateBlog($request,$id){

        // create post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
    }


    public function getDeletedBlogs(){

        $data = Post::archived()->get();

        return $data;



    }

}