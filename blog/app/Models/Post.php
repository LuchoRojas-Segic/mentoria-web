<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //traits es manera de agregar funcionalidad a una clase sin extender de ella
    use HasFactory;

    //public $fillable = ['title', 'resumen', 'body'];
    public $guarded = ['id']; //al menos debe tener el id
    public $with = ['category','author'];

    //Esta en la 2da forma de llamar a un slug, y se quita en la Route
    //Route::get('/post/{post}'
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeFilter($query, array $filters)
    {

        /*if (isset($filters['search'])){
            //agregar las condiciones de búsqueda
            //select * from posts where title like '%algo%'
            return $query->where('title', 'like', '%' . $filters['search'] . '%')
                ->orwhere('resumen', 'like', '%' . $filters['search'] . '%');
    
        }*/

        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query
                ->where('title', 'like', "%$search%")
                ->orwhere('resumen', 'like', "%$search%")
        );

        /*return $query->when(
            $filters['category'] ?? false,
            $query
                ->whereExists(function ($query) {
                    $query  
                        ->from('categories')
                        ->whereColumn('categories.id', 'pos.category_id')
                        ->where('categories.slug', $category);
                })
        );*/

        return $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) =>
                $query->whereHas('category', fn ($query)=>
                    $query->where('slug', $category))
        );

        /*return  $query->when(
            $filters['category'] ?? false,
            function($query, $category){
                $query->whereHas('category', function($query) use ($category){
                    $query->where('slug', $category);
                });
            }
        );*/

    }

    // hasOne, hasMany, belongsTo, belongsToMany ----- Relaciones en Laravel (relations)

    public function category()
    {                     //  \\App\Models\Category
        return $this->belongsTo(Category::class);
                             //(modelo que va a devolver esa relations)
    }

    //public function user() antes era user(), pero se cambia por author y se agrega la llave foranea 'user_id'
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
