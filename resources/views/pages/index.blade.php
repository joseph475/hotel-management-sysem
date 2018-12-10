@extends('layouts.app')

@section('content')
<div class="row dashboard-page">
    <div id="page-header">
        <div class="page-title">Dashboard</div>
    </div>
    <div class="content">
        <div class="col s12 m3 push-m9 mb15">
            <ul class="collapsible expandable">
                <li>
                    <div class="collapsible-header"><i class="material-icons">search</i>Search</div>
                    <div class="collapsible-body">

                    </div>
                </li>
                <li class="active">
                    <div class="collapsible-header"><i class="material-icons">hotel</i>Rooms</div>
                    <div class="collapsible-body">
                        <ul>
                            <li>Single</li>
                            <li>Double</li>
                            <li>Triple</li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">event_available</i>Available</div>
                    <div class="collapsible-body">

                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">exit_to_app</i>Checking Out</div>
                    <div class="collapsible-body">
                        
                    </div>
                </li>
            </ul>
        </div>
        <div class="col s12 m9 pull-m3">
            <div id="room-cards">
                <!-- Displays Each Rooms using JS-->
            </div>
        </div>
        
    </div>

</div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/dashboard/index.js') }}"></script>
@stop