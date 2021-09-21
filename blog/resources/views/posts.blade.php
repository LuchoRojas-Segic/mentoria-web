@extends('layout')

@section('banner')
    <h1>El súper Blog</h1>
@endsection

@section('content') 

    @if (count($posts) >0)
        @foreach($posts as $post)
            <article>
                <h1>
                    <a href="/post/<?= $post->slug?>">
                        {{ $post->title }}
                    </a>
                </h1>
                <p>
                    By <a href="#">{{ $posts->user->name }}</a> in
                    <a href="/category/{{$post->category->slug}}">
                    {{$post->category->name}}
                    </a>
                </p>
                <p><?= $post->resumen ?></p>
            </article>
        @endforeach
    @else
        I don't have any posts!
@endif
@endsection    
