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

    //Esta en la 2da forma de llamar a un slug, y se quita en la Route
    //Route::get('/post/{post}'
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeFilter($query)
    {
        if (request('search')){
            //agregar las condiciones de búsqueda
            //select * from posts where title like '%algo%'
            return $query->where('title', 'like', '%' . request('search') . '%')
                ->orwhere('resumen', 'like', '%' . request('search') . '%');
    
        }
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
