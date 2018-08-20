@if(Auth::user()->id)
    @foreach($book->users as $user)
        @if(Auth::user()->id === $user->pivot->user_id)
            <div class="alert alert-info">
                Tu as déjà voté pour ce livre
            </div>
            @php $half = false @endphp
            @for($i = 1; $i<=5; $i++)
                @if($i <= $rating)
                    <i style="color:gold;" class="fas fa-star fa-lg"></i>
                @elseif(explode('.', $rating)[1] && $half === false)
                    <i style="color:gold;" class="fas fa-star-half fa-lg"></i>
                    @php $half = true @endphp
                    @else
                    <i style="color:gold;" class="far fa-star-alt fa-lg"></i>
                @endif
            @endfor
        @endif
    @endforeach

    @if(Auth::user() and Auth::user()->canRate($book->id))
        <p>je peux plus voter</p>
    @endif
@endif

<form action="{{route('rate', ['id' => $book->id])}}" method="post" id="note_form">
    @csrf

    <div class="form-check-inline mr-0">
        <input type="radio" class="form-check-input d-none note_1" data-note="1" name="notes" id="note_1" value="1">
        <label for="note_1" class="form-check-label">
            <i class="far fa-star fa-lg"></i>
        </label>
    </div>
    <div class="form-check-inline mr-0">
        <input type="radio" class="form-check-input d-none note_2" data-note="2" name="notes" id="note_2" value="2">
        <label for="note_2" class="form-check-label">
            <i class="far fa-star fa-lg"></i>
        </label>
    </div>
    <div class="form-check-inline mr-0">
        <input type="radio" class="form-check-input d-none note_3" data-note="3" name="notes" id="note_3" value="3">
        <label for="note_3" class="form-check-label">
            <i class="far fa-star fa-lg"></i>
        </label>
    </div>
    <div class="form-check-inline mr-0">
        <input type="radio" class="form-check-input d-none note_4" data-note="4" name="notes" id="note_4" value="4">
        <label for="note_4" class="form-check-label">
            <i class="far fa-star fa-lg"></i>
        </label>
    </div>
    <div class="form-check-inline mr-0">
        <input type="radio" class="form-check-input d-none note_5" data-note="5" name="notes" id="note_5" value="5">
        <label for="note_5" class="form-check-label">
            <i class="far fa-star fa-lg"></i>
        </label>
    </div>
</form>



