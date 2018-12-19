@extends('layouts.app')

@section('content')
<div class="row checkin-page">
    <div id="page-header">
        <div class="page-title">Check in</div>
        <div class="page-buttons">
            <div class="button-content">
                <a class="btn btn-1" href="/">
                    <i class="material-icons left">arrow_back</i>
                    Back
                </a>
                <a class="btn btn-1" id="submitCheckin">
                    <i class="material-icons left">exit_to_app</i>
                    Check Out
                </a>
            </div>
        </div>
    </div>
    
    <div class="row content z-depth-1">
        <div class="col s12 m6 first-col">
            <div class="page-header-2">
                <div class="page-title-2">Checkin Status</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pagejs')
<script src="{{ asset('/js/pages/Checkin/index.js') }}"></script>
@stop