@extends('layouts.master')

@section('content')

    <div class="row mt-5">
        <div class="col">
            <h2>{{$book->title}}</h2>
            <p>
                <strong>Genre: </strong> {{$book->genre->name}}
            </p>
            <p>
                <strong>Date de création: </strong> {{$book->created_at}}
            </p>
            <p>
                <strong>Date de mise à jour: </strong> {{$book->updated_at}}
            </p>
            <p>
                <strong>Status: </strong> TODO
            </p>

            @if(count($book->authors) >1)
                <h3>Les auteurs</h3>
            @else
                <h3>L'auteur</h3>
            @endif
            <ul>
                @foreach($book->authors as $author)
                    <li>{{$author->name}}</li>
                @endforeach
            </ul>
        </div>
        <div class="col">
            <h2>Image de couverture</h2>
            @if(is_object($book->picture))
                <img src="{{asset('images/' . $book->picture->link)}}" alt="">
            @else
                <img src="" alt="Pas d'image">
            @endif
        </div>

    </div>


@endsection