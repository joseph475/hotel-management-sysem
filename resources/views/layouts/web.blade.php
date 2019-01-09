<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/jquery-confirm.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/materialize.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}" />
    
</head>

<body>
    <div class="web">
        <header>
            @include('partials.web.header')
        </header>
        
        <main>  
            @yield('content')
        </main>

        <footer>
            @include('partials.web.footer')
        </footer>
    </div>
    <script>M.AutoInit();</script>
</body>

    
</html>