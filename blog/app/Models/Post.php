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

    // hasOne, hasMany, belongsTo, belongsToMany ----- Relaciones en Laravel (relations)

    public function category()
    {                       //  \\App\Models\Category
        return $this->belongsTo(Category::class);
    }
}
