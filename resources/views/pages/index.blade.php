@extends('layouts.app')

@section('content')

    <div class="jumbotron text-center">
        <h1>myBlog.me</h1>
        <p>You can Register and create Blogs, view Blogs</p>
        @if(Auth::guest())
        <p><a href="/login" class="btn btn-primary btn-lg" role="button">Login</a> <a href="/register" role="button" class="btn btn-success btn-lg">Register </a></p>
        @endif
    </div>

@endsection