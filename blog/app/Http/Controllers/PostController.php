<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        return view('posts', [
        //'posts' => Post::all()
        //'posts' => $posts
            'posts' => Post::latest('published_at') //Ordenamiento
            ->with(['category','author'])->filter()->get(), //get => ejecutar
            'categories' => Category::all()
        ]);
    }
    public function show(Post $post)
    {
        return view('post', [
            //'post' => Post::findOrFail($id),
            'post' => $post,
        ]);
    }

}
