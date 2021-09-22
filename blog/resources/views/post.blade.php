@extends('layout')

@section('content') 
    <p>
        By <a href="#">{{ $post->author->name }}</a> in
        <a href="/category/{{$post->category->slug}}">
        {{$post->category->name}}
        </a>
    </p>
    <article>
        <p>{{ $post->body }}</p>
    </article>
    <a href="/">Go Back</a>
@endsection