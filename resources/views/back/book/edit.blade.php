@extends('layouts.master')

@section('content')
    <div class="row mt-2">
        <h2>Edition du livre: {{$book->title}}</h2>
    </div>

    <div class="row">
        <form action="{{route('book.update', ['book' => $book->id])}}" method="post" enctype="multipart/form-data">
            @method('patch')
            @csrf

            <div class="col-6">
                <div class="form-group">
                    <label for="title">Titre: </label>
                    <input class="form-control" type="text" name="title" id="title" value="{{$book->title}}">
                    @if($errors->has('title'))
                        <div class="alert alert-danger mt-1">{{$errors->first('title')}}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description">Description: </label>
                    <textarea class="form-control" name="description" id="description">{{$book->description}}</textarea>
                    @if($errors->has('description'))
                        <div class="alert alert-danger mt-1">{{$errors->first('description')}}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="genre">Genre: </label>
                    <select class="form-control" name="genre_id" id="genre">
                        <option value="0">Pas de genre</option>
                        @forelse($genres as $id => $genre)
                            <option value="{{$id}}" {{old('genre_id') == $id ? "selected" : ""}}>{{ucfirst($genre->name)}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>

                <div class="form-group">
                    <h2>Choississez un/des auteur(s)</h2>
                    @forelse($authors as $id => $author)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="{{$author->name}}" value="{{$author->id}}" name="authors[]" {{ $book->isChecked($author->id) === true ? 'checked' : ''  }}>
                            <label class="form-check-label" for="{{$author->name}}">{{$author->name}}</label>
                        </div>
                    @empty
                    @endforelse
                    @if($errors->has('authors.*'))
                        <div class="alert alert-danger mt-1">{{$errors->first('authors.*')}}</div>
                    @endif
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h2>Status</h2>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status" value="1" {{$book->status == "published" ? "checked" : ""}}>
                            Publié
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status" value="0" {{$book->status == "unpublished" ? "checked" : ""}}>
                            Dépublié
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <h2>Couverture du livre</h2>
                    <input class="form-control-file" type="file" name="picture">
                    @if($book->picture)
                        <div class="mt-3">
                            <p class="alert alert-info">Image actuelle</p>
                            <img src="{{asset('images/' . $book->picture->link)}}" alt="">
                        </div>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <button class="btn btn-success" type="submit">Valider le formulaire</button>
            </div>
            </form>
    </div>

    </form>
{{--@forelse($authors as $authorId)

@empty
@endforelse--}}
@endsection