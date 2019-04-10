@extends('layouts.app')

@section('content')
<div class="row dashboard-page">
    <div id="page-header">
        <div class="page-title">Dashboard</div>
        <div class="legends">
            <ul class="z-depth-1">
                <li><i class="small material-icons">brightness_1</i>Available</li>
                <li><i class="small material-icons">brightness_1</i>Occupied</li>
                <li><i class="small material-icons">brightness_1</i>Reserved</li>
                <li><i class="small material-icons">brightness_1</i>Cleaning</li>
                <li><i class="small material-icons">brightness_1</i>Maintenance</li>
                <li><i class="small material-icons">brightness_1</i>For Checkout</li>
            </ul>
            <i class="small material-icons menu tooltipped" data-position="left"  data-tooltip="Legends">more_vert</i>
        </div>
    </div>
    <div class="content">
        <div class="col s12 m3 push-m9 mb15">
            <ul class="collapsible expandable">
                <li class="active">
                    <div class="collapsible-header"><i class="material-icons">event_available</i>Available Room Types</div>
                    <div class="collapsible-body">
                        <ul>
                            <li>Available<span class="new badge grey darken-2" data-badge-caption="">4</span></li>
                            <li>Occupied<span class="new badge grey darken-2" data-badge-caption="">5</span></li>
                            <li>Reserved<span class="new badge grey darken-2" data-badge-caption="">6</span></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col s12 m9 pull-m3">
            <div class="cards-container">
                <div class="col m4 s12">
                    <div class="card-panel white cvacant hoverable">
                        <div class="cardlabel">
                            <i class="far fa-check-circle"></i> 
                            <h5>Available</h5>
                        </div>
                        <h4>30</h4>
                    </div> 
                </div>
                <div class="col m4 s12">
                    <div class="card-panel white creserved hoverable">
                        <div class="cardlabel">
                            <i class="far fa-address-card"></i>
                            <h5>Reserved</h5>
                        </div>
                        <h4>30</h4>
                    </div>
                </div>
                <div class="col m4 s12">
                    <div class="card-panel white ccheckout hoverable">
                        <div class="cardlabel">
                            <i class="far fa-bell"></i>
                            <h5>Checkout</h5>
                        </div>
                        <h4>30</h4>
                    </div>
                </div>    
            </div>
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