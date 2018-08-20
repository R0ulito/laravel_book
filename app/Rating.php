<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $timestamps = false;

    protected $table = "book.rating";
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function getBookRatings(Book $book) {
        return $this->all()->where('book_id', $book->id)->pluck('rate');
    }
}
