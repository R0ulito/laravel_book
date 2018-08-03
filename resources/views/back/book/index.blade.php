@extends('layouts.master')

@section('content')
    @include('partials.flash')

    <a class="btn btn-info mt-3 mb-3" href="{{route('book.create')}}">Ajouter un livre</a>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Auteurs</th>
            <th scope="col">Genre</th>
            <th scope="col">Date de publication</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col" class="text-center">Edition</th>
            <th scope="col" class="text-center">Show</th>
            <th scope="col" class="text-center">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($books as $book)
            <tr>
                <td><a href="{{route('book.edit', ['id' =>$book->id])}}">{{$book->title}}</a></td>
                <td>
                    @foreach($book->authors as $author)
                        @if($loop->last)
                            {{$author->name}}
                        @else
                            {{$author->name . ','}}
                        @endif
                    @endforeach
                </td>
                <td>
                    @if(isset($book->genre->name))
                        {{ucfirst($book->genre->name)}}
                    @else
                        Pas de genre
                    @endif
                </td>
                <td>{{date_format($book->created_at, 'd/m/Y à H:i:s')}}</td>
                <td class="text-center">
                    @if($book->status == "published")
                        <i class="fas fa-traffic-light fa-lg text-success"></i>
                    @else
                        <i class="fas fa-traffic-light fa-lg text-danger"></i>
                    @endif
                </td>
                <td class="text-center">
                @can('update', $book)
                        <a href="{{route('book.edit', ['id' =>$book->id])}}">
                            <i class="fas fa-edit fa-lg"></i>
                        </a>
                @endcan
                @cannot('update', $book)
                    <i class="fas fa-ban fa-lg text-warning"></i>
                @endcannot
                </td>

                <td class="text-center">
                    @can('view', $book)
                        <a href="{{route('book.show', ['id' => $book->id])}}">
                            <i class="fas fa-eye fa-lg"></i>
                        </a>
                    @endcan
                    @cannot('view', $book)
                        <i class="fas fa-ban fa-lg text-warning"></i>
                    @endcannot
                </td>
                    <td class="text-center">
                        @can('delete', $book)
                            <form class="delete" action="{{route('book.destroy', ['id' => $book->id])}}" method="post">
                                @method('delete')
                                @csrf
                                <i class="deleteButton fas fa-trash fa-lg text-danger"></i>
                            </form>
                        @endcan
                        @cannot('delete', $book)
                            <i class="fas fa-ban fa-lg text-warning"></i>
                        @endcannot
                    </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$books->links()}}
@endsection

@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
@endsection