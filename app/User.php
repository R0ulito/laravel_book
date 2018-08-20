<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'elevation'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class,'rating')->withPivot('rate');
    }

    public function isAdmin()
    {
        return $this->elevation === "admin";
    }

    public function rate():int{
        $rate = 0 ;
        foreach($this->books as $book )
            $rate+=$book->pivot->rate ;

        return $rate;
    }

    public function ratings(){
        return $this->hasMany(Rating::class);
    }

    public function hasRate(int $bookId) {
        foreach( $this->ratings as $rating){
            if($rating->book_id === $bookId) return true;
        }
        return false;
    }
}
