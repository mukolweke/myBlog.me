<?php

namespace App\Http\Controllers;

use App\Post;
use App\Repository\Posts\PostsRepository;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    private $repo;
    private $user;


    // access control
    public function __construct(PostsRepository $postsRepository)
    {
        $this->repo = $postsRepository;

    }

    //index page
    public function index(){


        return view('pages.index');

    }

    //about page

    /**
     *
     */
    public function archive(){

        $posts = $this->repo->getDeletedBlogs();

        return view('pages.archive',['posts'=>$posts]);

    }

}
