<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Rating;

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

    public function users(){
        return $this->belongsToMany(User::class, 'rating')->withPivot('rate');
    }
    public function isChecked(int $checkedId){
        if($this->authors){
            foreach($this->authors()->pluck('id') as $id ){
                if($checkedId === $id) return true;
            }
        }

        return false;
    }

    public function getTotalRatings() {
        return Rating::all()->where('book_id', '=', $this->id)->sum('rate');
//        return ;
    }

    public function getAverageRating() {
        $total = $this->getTotalRatings();
        $result = 0;
        if($total > 0) {
            $count = Rating::all()->where('book_id', '=', $this->id);
            $result = $total / count($count);
        }
        return round($result, 1);

    }
}
