<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Author;
use App\Genre;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book)
    {
        $this->authorize('index', Book::class);

        return view('back.book.index', ['books' => $book::paginate(10)]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Book::class);
        $authors = Author::pluck('name', 'id')->all();
        $genres = Genre::pluck('name', 'id')->all();

        return view('back.book.create', ['authors' => $authors, 'genres' => $genres]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required|string',
            'genre_id' => 'integer',
            'authors.*' => 'integer'
        ]);
        $book = Book::create($request->all());
        $file = $request->file('picture');

        if(!empty($file)) {
            $link = $request->file('picture')->store('images');
            $this->savePicture($book, $link);
        }


        /*$file = $request->file('picture');
        if(!empty($file)) {
            $link = $request->file('picture')->store('images');
            $book->picture()->create([
                'link' => $link,
                'title' => $request->img_title ?? "No title"
            ]);
        }*/
        $book->authors()->attach($request->authors);
        $book->save();

        return redirect()->route('book.index')->with('success', 'Le livre a bien été ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $this->authorize('view', Book::class);
        return view('back.book.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book, Genre $genres, Author $authors)
    {
        return view('back.book.edit', [
            'book' => $book,
            'genres' => $genres::all(),
            'authors' => $authors::all()
        ]);
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
        $book = Book::find($id);
        $book->update($request->all());

        $book->authors()->sync($request->authors);



        $file = $request->file('picture');
        if(!empty($file)) {
            if(count($book->picture) > 0) {
                Storage::disk('local')->delete($book->picture->link);
                $book->picture()->delete();
            }
            $link = $request->file('picture')->store('./');
            $this->savePicture($book, $link);
        }


        /*$file = $request->file('picture');
        if(!empty($file)) {
            $link = $request->file('picture')->store('./');
            $this->savePicture($book, $file, $link);
        }*/

        $book->save();

        return redirect()->route('book.index')->with('success', 'Le livre à bien été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index')->with('success', 'Le livre a bien été supprimé');
    }

    private function savePicture(Book $book, $link)
    {
        $book->picture()->create([
            'link' => $link,
            'title' => $request->img_title ?? "No title"
        ]);
    }
}
