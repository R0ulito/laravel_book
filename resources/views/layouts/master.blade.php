<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>

<body>

<div class="container-fluid">
    @include('partials.menu')
    <div class="row">
        <div class="col-md-8">
            @yield('content')
        </div>
        <div class="col-md-4">
            {{--  include conditionnel si le partial existe il s'inclue sinon rien ne se passe (pas d'erreur) include conditionnel --}}
            @includeIf('partials.sidebar')
        </div>
    </div>
</div>


@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@show
</body>
</html>