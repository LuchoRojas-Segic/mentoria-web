<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest('published_at') //Ordenamiento
        ->with(['category','author']);

        if (request('search')){
        //agregar las condiciones de búsqueda
        //select * from posts where title like '%algo%'
        $posts->where('title', 'like', '%' . request('search') . '%')
            ->orwhere('resumen', 'like', '%' . request('search') . '%');

        }
        return view('posts', [
        //'posts' => Post::all()
        //'posts' => $posts
        'posts' => $posts->get(), //get => ejecutar
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