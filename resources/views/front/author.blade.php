@extends('layouts.master')

@section('content')
    <h2>Liste des livres de l'auteur {{$author->name}}</h2>
    <ul>
    @forelse($books as $book)
        <li>{{$book->title}}</li>
        @empty
        <li>Pas de livres pour cet auteur</li>
    @endforelse

    </ul>


@endsection