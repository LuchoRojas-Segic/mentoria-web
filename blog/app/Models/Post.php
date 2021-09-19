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
}
