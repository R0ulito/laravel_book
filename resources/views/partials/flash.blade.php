@if(Session::has('success'))
    <div class="alert alert-success mt-4">
        <p>{{Session::get('success')}}</p>
    </div>
@endif

@if(Session::has('message'))
    <div class="alert alert-danger mt4">
        <p>{{Session::get('message')}}</p>
    </div>
    {{--<script>
        alert('{{Session::get('message')}}');
    </script>--}}
@endif