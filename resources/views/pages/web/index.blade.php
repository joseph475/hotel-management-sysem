@extends('layouts.web') 

@section('content')
    <div class="web-reservation">
        <div class="parallax-container">
            <div class="parallax"><img class="responsive-img" src='/images/bg1.jpg'></div>
        </div>
    </div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/BookNow/index.js') }}"></script>
@stop