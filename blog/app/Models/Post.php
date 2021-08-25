<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post 
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

    public static function createFromDocuemnt($document)
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
        //Devuelve una info de los archivos
        //return File::files(resource_path("posts/"));
        //$files = File::files(resource_path("posts/"));
        //return array_map(fn($file) => $file->getContents(), $files);    

        return collect(File::files(resource_path("posts/")))
                    ->map(fn ($file) => YamlFrontMatter::parseFile($file))
                    ->map(fn ($document) => Post::createFromDocuemnt($document));
    }

    public static function find($slug)
    {
        //$path = __DIR__ . "/../resources/posts/$slug.html";
        //$path = resource_path("posts/{$slug}.html");

        //return __DIR__;
        //los dd y ddd son paea DEPURAR
        //dump and die
        //dd($slug);
        //dump and die and debug
        //ddd($slug);  

        //$post = static::all()->firstWhere('slug',$slug);
        //return $post;

        //cache()->remember("indice", "caducidad", callback => lo que vamos a guardar)
        return cache()->remember("post.{$slug}",now()->addDays(1), fn () => static::all()->firstWhere('slug',$slug));
        
        //if(!file_exists($path)) {
         //if(!file_exists( $path = resource_path("posts/{$slug}.html"))) {
            //return redirect('/');
         //   throw new ModelNotFoundException();            
        //}
    //Para refrescar el CACHE de una página
        /*$post = cache()->remember("post.{slug}", 5, function() use($path) {
            var_dump('file_get_contents');
            return file_get_contents($path);
        });*/
        //Otra forma de hacerlo con Arrow
        //now()->addDays(3)
        //return cache()->remember("post.{$slug}", 1000, fn() => file_get_contents($path));
    
    //

    }
}