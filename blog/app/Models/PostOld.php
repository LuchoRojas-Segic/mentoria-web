<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class PostOld
{
    public string $title;
    public string $resumen;
    public string $date;
    public string $slug;
    public string $body;

    public function __construct($title, $resumen, $date, $slug, $body)
    {
        $this->title = $title;
        $this->resumen = $resumen;
        $this->date = $date;        
        $this->slug = $slug; 
        $this->body = $body;
    }

    public static function createFromDocument($document)
    {
        return new self(
            $document->title,
            $document->resumen,
            $document->date,
            $document->slug,
            $document->body()
        );
    }

    public static function all()
    {
        //return File::files(resource_path("posts/"));
        /*$files = File::files(resource_path("posts/"));

        //sin arrow
        return array_map(function($file) {
            return $file->getContents();
        }, $files);

        //Con arrow
        return array_map(fn ($file) => $file->getContents(), $files);*/

        return collect(File::files(resource_path("posts/")))             
            ->map(fn ($file) => YamlFrontMatter::parseFile($file))                
            ->map(fn ($document) => Post::createFromDocument($document));  
    }

    public static function find($slug)
    {
        //return $slug;
        //dump and die and debug
        //dd($_SERVER);
        //ddd($_SERVER);

        //$path = __DIR__ . "/../resources/posts/$slug.html";
        //$path = resource_path("posts/$slug.html");

        //$post = static::all()->firstWhere('slug', $slug);
        //return $post;

        //cache()->remember("indice", "caducidad", "callback => lo que vamos a guardar")

        return cache()->remember("post.{$slug}", now()->addDays(1), fn ()=> static::all()->firstWhere('slug', $slug));
        //ddd($posts->firstWhere('slug', $slug));

        //if (!file_exists($path)) {
        /*if (!file_exists($path = resource_path("posts/$slug.html"))) {
            //Esto se utiliza en los controladores no en el modelo
            //abort(404);
            //return redirect('/');
            throw new ModelNotFoundException();
        }*/
        //Forma tradicional de hacerlo
        /*$post = cache()->remember("post.{$slug}", 5, function() use($path){
            var_dump('file_get_contents');
            return file_get_contents($path);
        });*/
        
        //Forma con arrow
        //$post = cache()->remember("post.{$slug}", 5, fn () => file_get_contents($path));
        //now()->addHours(3)
        //$post = cache()->remember("post.{$slug}", 5, fn () => file_get_contents($path));
        //return cache()->remember("post.{$slug}", 1000, fn () => file_get_contents($path));

        //  Esto se hace en los controladores no en el modelo
        /*return view('post', [
            //'post' => file_get_contents($path),
            'post' => $post,
        ]);*/

    }

}

