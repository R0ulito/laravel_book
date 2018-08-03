<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Book;
use App\Genre;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
//        view()->composer('partials.menu', function($view){
//            $genres = Genre::pluck('name', 'id')->all();
//            $view->with('genres', $genres);
//        });
    }

    public function showBooksByAuthor(int $id){
        $author = Author::find($id);
        $books = Author::find($id)->books()->paginate(5);

        return view('front.author', ['books' => $books, 'author' => $author]);
    }

    public function showBooksByGenre(Genre $genre)
    {
        $books = $genre->books;
        return view('front.genre', ['books' => $books, 'genre' => $genre]);
    }
    public function index()
    {
        $ratings = DB::select('select * from ratings');
        $books = Book::published()->paginate(5);
        return view('front.index', ['books' => $books, 'ratings' => $ratings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $book = Book::find($id);
        return view('front.show', ['book' => $book]);

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
