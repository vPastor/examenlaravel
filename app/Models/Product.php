<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function scopeCategory($query, $input)
    {
        //TODO: Selecciona productos por categoria.
        return $query->where('category','=',$input);
    }
    public function scopeName($query, $input)
    {
        //TODO: Selecciona productos por nombre (parecido)
        return $query->where('name','=',$input);

    }
    public function scopeStock($query, $quantity, $id)
    {
        //TODO: Selecciona productos por cantidad disponible

    }
}
