<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    protected $fillable = [
        'title', 'description', 'genre_id', 'status'
    ];

    public function setGenreIdAttribute($value){
        if ($value == 0) {
            $this->attributes['genre_id'] = null;
        } else {
            $this->attributes['genre_id'] = $value;
        }
    }

    public function scopePublished($query) {
        return $query->where('status', 'published');

    }

    public function setStatusAttribute($value) {
        if($value == 0) {
            $this->attributes['status'] = "unpublished";
        } else {
            $this->attributes['status'] = "published";
        }
    }
    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    public function authors() {
        return $this->belongsToMany(Author::class);
    }

    public function picture() {
        return $this->hasOne(Picture::class);
    }

    public function ratingBookUser() {
        return $this->hasMany(Rating::class);
    }

    public function isChecked(int $checkedId){
        if($this->authors){
            foreach($this->authors()->pluck('id') as $id ){
                if($checkedId === $id) return true;
            }
        }

        return false;
    }

    public function getAverageRating(Book $book) {
        $notes = DB::select('select avg(note) from ratings where book_id = ?', [$book->id]);
        return $notes;
    }
}
