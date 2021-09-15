<?php

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');

    //$posts = Post::all();
    //ddd($posts);

    /*$document = YamlFrontMatter::parseFile(
        resource_path('posts/my-first-post.html')
    );*/
    //ddd($document);
    //ddd($document->matter('title'));

    //$files = File::files(resource_path("posts/"));
    //$posts = [];

   //1ra forma tradicional de hacerlo
    /* foreach ($files as $file) {
        $document = YamlFrontMatter::parseFile($file);
        $posts[] = new Post(
            $document->title,
            $document->resumen,
            $document->date,
            $document->body()
        );
    }*/
    //ddd($documents);
    //ddd($posts);

    //2da forma tradicional de hacerlo con array_map
    /*$posts = array_map(function($file) { 
        $document = YamlFrontMatter::parseFile($file);
        return  new Post(
            $document->title,
            $document->resumen,
            $document->date,
            $document->body()
        );
    }, $files);*/

    //3ra forma tradicional de hacerlos con las Collection
    //$posts = collect(File::files(resource_path("posts/")))
                /*->map(function($file){
                    return YamlFrontMatter::parseFile($file);
                })
                    ->map(function($document){
                    //$document = YamlFrontMatter::parseFile($file);
                    return  new Post(
                        $document->title,
                        $document->resumen,
                        $document->date,
                        $document->body()
                    );
                });*/
                //Lo mismo de arriba pero con arrow
                //->map(fn ($file) => YamlFrontMatter::parseFile($file))                
                //->map(fn ($document) => Post::createFromDocument($document));

                $posts = cache()->rememberForever(
                    'posts.all', //Esto es el indice
                    fn () => Post::all()                  
                    /*collect(File::files(resource_path("posts/")))             
                        ->map(fn ($file) => YamlFrontMatter::parseFile($file))                
                        ->map(fn ($document) => Post::createFromDocument($document))*/                    
                );

    return view('posts', [
        //'posts' => Post::all()
        'posts' => $posts
    ]);
});

Route::get('/post/{post}', function ($slug) {
    return view('post', [
        'post' => Post::find($slug),
    ]);
})->where ('post','[A-Za-z\-_]+'); //Constrains con expresiones regulares

//Route::get('/', fn () => view('welcome'));
//Route::get('/', fn () => 'Hola SEGIC');
//Lo siguiente entregará un JSON
//Route::get('/', fn () => ['id' => 7, 'url' => 'http://www.segic.cl']);

