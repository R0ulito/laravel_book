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