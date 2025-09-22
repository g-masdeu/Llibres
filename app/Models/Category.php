<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Propietats de l'objecte category
    protected $fillable = [
        'name'
    ]; 

    // Clau foràna 
    public function books() {
        return $this->hasMany(Book::class);
    }
}
