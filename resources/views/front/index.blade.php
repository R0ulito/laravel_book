@extends('layouts.master')

@section('content')
    <h1>Tous les derniers livres publiés sur notre site</h1>
    {{$books->links()}}

    <ul class="list-group">
        @forelse($books as $book)
            <li class="list-group-item">
                <h2><a href="{{url('book', $book->id)}}">{{$book->title}}</a></h2>
                <div class="row mt-4">
                    @if(count($book->picture) > 0)
                        <img class="img-thumbnail col-sm-3 " src="{{asset('images/' . $book->picture->link)}}" alt="">
                    @endif
                    <span class="col-sm-6 offset-sm-1">{{$book->description}}</span>
                </div>
                <h2 class="mt-4">Auteur(s):</h2>
                <ul>
                    @forelse($book->authors as $author)
                        <li>{{$author->name}}</li>
                    @empty
                        <li>Aucun auteur</li>
                    @endforelse
                </ul>
            </li>
            @if(Auth::check())
                {{--{{dd(Auth::user()->elevation, Request::ip())}}--}}
                <li class="list-group-item">
                    <h4>Notez ce livre</h4>
                    @include('partials.note')
                </li>
            @endif
            @empty
                <p class="alert alert-warning">Désolé pour l'instant aucun livres n'ont été publiés sur le site</p>
        @endforelse

    </ul>

    <div class="mt-3 mb-2">
        {{$books->links()}}
    </div>
@endsection


@section('scripts')
    @parent
    <script>
        // $('input').hide()
        $('.far').on('click', function() {
            var selector = "#" + $(this).parent().attr('for');
            $(selector).attr('checked', true);
            $('form#note_form').submit();

        })
    </script>

@endsection