<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Book;
use App\Rating;
use App\User;

class RatingController extends Controller
{
    public function addRating(Request $request, Book $book) {
        if(DB::select('select * from ratings where user_id = ? and book_id = ? ', [$request->user()->id, $book->id])){
            return redirect('/')->with('message', 'Vous avez déjà voté pour ce livre');
        } else {
            DB::table('ratings')->insert([
                "note" => $request->notes,
                "book_id" => $book->id,
                "user_id" => $request->user()->id
            ]);
        }

    }
}
