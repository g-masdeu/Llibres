<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //Propietats de l'objecte review
    protected $fillable = [
        'rating', 
        'review',
        'user_id',
        'book_id'
    ];


    //Claus forànes
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function book() {
        return $this->belongsTo(Book::class);
    }
    
}
