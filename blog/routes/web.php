<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

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

    //$document = YamlFrontMatter::parseFile(
    //    resource_path('posts/my-first-post.html')
    //);
    //ddd($document);
    //ddd($document->matter('title'));
    //$files = File::files(resource_path("posts/"));
    //$posts = [];

    //1ra forma de realizar
    /*foreach($files as $file) {
        $document = YamlFrontMatter::parseFile($file);
        $posts[] = new Post(
            $document->title,
            $document->resumen,
            $document->date,
            $document->body()
        );
    }*/
    //ddd($posts);

    //2da forma de realizar
    /*$posts = array_map(function($file) {
        $document = YamlFrontMatter::parseFile($file);
        return new Post(
            $document->title,
            $document->resumen,
            $document->date,
            $document->body()
        );
    }, $files);*/

    //3ra forma de realizar
    /*$posts = collect(File::files(resource_path("posts/")))
                ->map(fn ($file) => YamlFrontMatter::parseFile($file))
                ->map(fn ($document) => Post::createFromDocuemnt($document));*/

    /*$posts = cache()->rememberForever('posts.all', function() {
        return collect(File::files(resource_path("posts/")))
        ->map(fn ($file) => YamlFrontMatter::parseFile($file))
        ->map(fn ($document) => Post::createFromDocuemnt($document));                       

    });*/
    //Con arrow
    $posts = cache()->rememberForever('posts.all', fn() => Post::all());
                     

    return view('posts', [
        //'posts' => Post::all()
        'posts' => $posts
    ]);
});

/*Route::get('/post', function () {
    //return view('welcome');
    return view('post');
});*/

//Route::get('/', fn ()  => view('welcome'));
//Route::get('/', fn ()  => 'Hola Segic');

//Lo siguiente entregará un JSON
//Route::get('/', fn ()  => [7, 'url' => 'http://segic.cl']);

Route::get('/post/{post}', function ($slug) {  
    return view('post', [
        'post' => Post::find($slug),
    ]);
    //Lo que viene abajo son Expresiones Regulares
    //Que son utilizadas en Contrain
})->where('post','[A-Za-z\_-]+');
