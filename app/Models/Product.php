<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =['description','stock'];

    public function categories(){
        // Un producto pertenece a una categoría.
        // Para armar la vista pasamos la clave foránea y el id.
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
