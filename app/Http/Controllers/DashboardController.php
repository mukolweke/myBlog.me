<?php

namespace App\Http\Controllers;

use App\Post;
use App\Repository\User\UserRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $repo;

    // access control
    public function __construct(UserRepository $repository)
    {
        $this->middleware('auth');
        $this->repo = $repository;
    }


    public function index()
    {
        // get user logged-in id
        $user_id = auth()->user()->id;

        // pass to dashboard; since we have relationship we can get their post by
        return view('dashboard')->with('posts',$this->repo->findUser($user_id));
    }
}
