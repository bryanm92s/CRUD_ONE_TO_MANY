<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable =['description'];

    // La vamos a relacionar con products
    public function products(){
        // Una categoría tiene muchos productos.
        return $this->hasMany(Product::class);
    }
}
