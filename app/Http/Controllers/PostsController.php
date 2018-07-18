<?php

namespace App\Http\Controllers;

use App\Repository\Posts\PostsRepository;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;


class PostsController extends Controller
{

    private $repo;
    private $user;

    // access control
    public function __construct(PostsRepository $postsRepository)
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->repo = $postsRepository;
//        $this->user =  \Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $post = DB::select(SELECT * FROM posts);
        // $post = Post::where('title', 'Post Two')->get();
        // $posts = Post::orderBy('created_at', 'desc')->get();
        // $posts = Post::orderBy('created_at', 'desc')->get();


        $posts = $this->repo->getAllBlogs();

        return view('posts.index')->with('posts', $posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = auth()->user()->id;
        return view('posts.create', compact('id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999',
        ]);

        // create post
        $this->repo->postBlog($request);

        return redirect('/posts')->with('success', 'Posts Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->repo->getOneBlog($id);

        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->repo->getOneBlog($id);
        //check correct user
        if (auth()->id() != $post->user_id) {
            return redirect('posts')->with('error', 'Unauthorized Page Access');
        }

        return view('posts.edit', ['id' => $id]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $this->repo->updateBlog($request, $id);

        return redirect('/posts')->with('success', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = $this->repo->getOneBlog($id);

        //check correct user
        if (auth()->id() != $post->user_id) {
            return redirect('posts')->with('error', 'Unauthorized Page Access');
        }

        if ($post->cover_image != 'noimage.jpg') {
            //delete image
            Storage::delete('public/cover_images/' . $post->cover_image);
        }
        $post->delete();

        return redirect('/posts')->with('success', 'Post Removed ');

    }
}
