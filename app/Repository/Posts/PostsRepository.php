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

        // file upload
        if($request->hasFile('cover_image')){

            // get filename with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            // get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // make image unique
            $imageToStore = $fileName.'_'.time().$extension;

            $path = $request->file('cover_image')->storeAs('public/cover_images', $imageToStore);

        }else{
            $imageToStore = 'noimage.jpg';
        }

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->priority = 0;
        $post->cover_image = $imageToStore;
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

        // file upload
        if($request->hasFile('cover_image')){

            // get filename with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            // get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // make image unique
            $imageToStore = $fileName.'_'.time().$extension;

            $path = $request->file('cover_image')->storeAs('public/cover_images', $imageToStore);

        }

        // create post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $imageToStore;
        }
        $post->save();
    }


    public function getDeletedBlogs(){

        $data = Post::archived()->get();

        return $data;



    }

}