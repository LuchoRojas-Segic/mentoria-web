<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory; //es un trait, el cual agrega funcionalidad a una clase
 
    // hasOne, hasMany, belongsTo, belongsToMany
    public function posts()
    {
        return $this->HasMany(Post::class);
    }
}
