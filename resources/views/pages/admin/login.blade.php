@extends('layouts.login')

@section('meta')
    {{-- <meta http-equiv="refresh" content="300" /> --}}
@stop

@section('content')
    <div class="row login-page">
        <center>
            <div class="section"></div>

            <h5 class="indigo-text">Please, login into your account</h5>
            <div class="section">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{{ Session::get('success') }}</li>
                        </ul>
                    </div>
                @endif
            </div>

            <div class="container">
                <div class="z-depth-1 grey lighten-4 row"
                    style="width:380px; display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

                    <form class="col s12" method="post" action="{{ route('member.login') }}">
                        @csrf
                        <div class='row'>
                            <div class='col s12'>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='email' name='email' id='email' />
                                <label for='email'>Enter your email</label>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='password' name='password' id='password' />
                                <label for='password'>Enter your password</label>
                            </div>
                            {{-- <label style='float: right;'>
                                <a class='pink-text' href='#!'><b>Forgot Password?</b></a>
                            </label> --}}
                        </div>

                        <br />
                        <center>
                            <div class='row'>
                                <button type='submit' name='btn_login'
                                    class='col s12 btn btn-large waves-effect indigo'>Login</button>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
            {{-- <a href="#!">Create account</a> --}}
        </center>
    </div>
@endsection

@section('pagejs')
    {{-- <script src="{{ asset('/js/pages/dashboard/index.js') }}"></script> --}}
@stop
