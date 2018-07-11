<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{


    //index page
    public function index(){

        return view('pages.index');

    }

    //about page
    public function about(){

        return view('pages.about');

    }

}
