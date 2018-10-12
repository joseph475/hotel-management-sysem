<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="{{ url('/css/jquery-confirm.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/materialize.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}" />
</head>

<body>
    <header>
        @include('partials.header')
    </header>

         @include('partials.sidenav')

    <main>  
        @yield('content')
        <div id="dimScreen"></div>
    </main>

    <footer>
        @include('partials.footer')
    </footer>
    
    <script>M.AutoInit();</script>
</body>

    
</html>