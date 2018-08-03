@extends('layouts.master')

@section('content')

    <h2>{{$book->title}}</h2>
    <div class="text-center">
        <img src="{{asset('images/' . $book->picture->link)}}" alt="">
    </div>

    <h2>Description: </h2>
    <p>
        {{$book->description}}
    </p>

    <h2>Auteur(s): </h2>
    <ul>
        @forelse($book->authors as $author)
            <li><a href="{{action('FrontController@showBooksByAuthor', ['id' => $author->id])}}">{{$author->name}}</a></li>
            @empty
            Pas d'auteurs
        @endforelse
    </ul>




@endsection
    