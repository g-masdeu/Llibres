<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // Propietats de l'objecte Book
    protected $fillable = [
        'title',
        'author',
        'summary',
        'publication_date',
        'price', 
        'image',
        'min_age',
        'category_id'
    ];

    protected $dates = [
        'publication_date'
    ]; 

    // Claus foranes
    //Clau 1 - N
    public function category() {
        return $this->belongsTo(Category::class);
    }
    
    //Clau N - 1
    public function reviews() {
        return $this->hasMany(Review::class);
    }
    
}
