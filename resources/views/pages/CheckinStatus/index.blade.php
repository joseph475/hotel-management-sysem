@extends('layouts.app')

@section('content')
<div class="row checkin-page">
    <div id="page-header">
        <div class="page-title">Room# {{ $data->roomNo }}</div>
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

    </div>
</div>
@endsection

@section('pagejs')
<script src="{{ asset('/js/pages/Checkin/index.js') }}"></script>
@stop