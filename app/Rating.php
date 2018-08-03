<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $primaryKey = ['book_id', 'user_id'];

    public function getIncrementing()
    {
      return false;
    }

    protected function setKeysForSaveQuery(Builder $query)
    {
        return $query->where('book_id', $this->getAttribute('book_id'))
                ->where('user_id', $this->getAttribute('user_id'));
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function book() {
        return $this->belongsTo(Book::class);
    }
}
