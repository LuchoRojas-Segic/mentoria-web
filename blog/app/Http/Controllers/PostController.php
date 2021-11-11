<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        return Post::latest('published_at') //Ordenamiento
        ->filter(request(['search', 'category']))
        //->get();
        ->paginate(5);

        /*return view('posts', [
        //'posts' => Post::all()
        //'posts' => $posts
            'posts' => Post::latest('published_at') //Ordenamiento
            ->filter(request(['search', 'category']))
            ->get(), //get => ejecutar
            'categories' => Category::all(),
            'currentCategory' => 
                request('category') !== null ? Category::where('slug', request('category'))->first() : null,
        ]);*/
    }
    public function show(Post $post)
    {
        return view('post', [
            //'post' => Post::findOrFail($id),
            'post' => $post,
        ]);
    }

}
