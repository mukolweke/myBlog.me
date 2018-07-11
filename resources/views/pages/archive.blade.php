@extends('layouts.app')

@section('content')

    <h1>Archive Posts</h1>

    @if(count($posts)>0)
        @foreach($posts as $post)

            <div class="well">

                <h3>{{$post->title}}</h3>
                <p>{{$post->body}}</p>
                <small>Written on <strong>{{$post->created_at}}</strong> and Deleted on <strong>{{$post->deleted_at }}</strong> by {{$post->user->name}}</small>

            </div>

        @endforeach

    @else
        <p>No Posts Found</p>
    @endif

@endsection