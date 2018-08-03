@extends('layouts.master')

@section('content')
    <h2>Liste des livres pour le genre: {{ucfirst($genre->name)}}</h2>
    <ul>
        @forelse($books as $book)
            <li>{{$book->title}}</li>

        @empty
        <p>Pas de livres répertoriés pour ce genre</p>

        @endforelse

    </ul>

@endsection

