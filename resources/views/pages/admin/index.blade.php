@extends('layouts.app')

@section('meta')
    {{-- <meta http-equiv="refresh" content="300" /> --}}
@stop

@section('content')
<div class="row dashboard-page">
    <div id="page-header">
        <div class="page-title" page-title="Dashboard">Dashboard</div>
        <div class="page-buttons">
            <div class="button-content">
                
                <div class="legends">
                    <ul class="z-depth-1">
                        <li><i class="small material-icons">brightness_1</i>Available</li>
                        <li><i class="small material-icons">brightness_1</i>Occupied</li>
                        <li><i class="small material-icons">brightness_1</i>Reserved</li>
                        <li><i class="small material-icons">brightness_1</i>Cleaning</li>
                        <li><i class="small material-icons">brightness_1</i>Maintenance</li>
                    </ul>
                    <i id="change-views" class="small material-icons menu tooltipped mr10" data-position="left"  data-tooltip="Change View">layers</i>
                    <i id="show-legends" class="small material-icons menu tooltipped" data-position="left"  data-tooltip="Legends">more_vert</i>
                    
                </div>
                {{--  <a class="btn btn-1" href=".">
                    <i class="material-icons">refresh</i>
                </a>  --}}
            </div>
            
        </div>
        
    </div>
    <div class="content">
        <div class="col s12 m3 push-m9 mb15">
            <div class="search-content">
                @include('partials.search')
            </div>
            <ul class="collapsible expandable mb15">
                <li class="active">
                    <div class="collapsible-header"><i class="material-icons">event_available</i>Available Rooms</div>
                    <div class="collapsible-body">
                        <ul id="availableTypes">
                            {{--  js generated  --}}
                        </ul>
                    </div>
                </li>
            </ul>
            {{--  <div class="row cards-container hide-on-small-only">
                <div class="col m12 s12">
                    <div class="card-panel white ccleaning hoverable">
                        <div class="cardlabel">
                            <i class="material-icons">delete_sweep</i>
                            <h5>On Cleaning</h5>
                        </div>
                        <h4 id="cleaningCount">0</h4>
                    </div>
                    <div class="card-panel white cmaintenance hoverable">
                        <div class="cardlabel">
                            <i class="material-icons">launch</i>
                            <h5>On Maintenance</h5>
                        </div>
                        <h4 id="maintenanceCount">0</h4>
                    </div>
                </div>
            </div>  --}}
        </div>
        <div class="col s12 m9 pull-m3">
            <div class="row cards-container">
                <div class="col m4 s12">
                    <div class="card-panel cvacant hoverable" data-filter="Vacant">
                        <div class="cardlabel">
                            <i class="far fa-check-circle"></i> 
                            <h5>Vacant</h5>
                        </div>
                        <h4 id="vacantCount">0</h4>
                    </div> 
                </div>
                <div class="col m4 s12">
                    <div class="card-panel coccupied hoverable" data-filter="Occupied">
                        <div class="cardlabel">
                            <i class="far fa-times-circle"></i> 
                            <h5>Occupied</h5>
                        </div>
                        <h4 id="occupiedCount">0</h4>
                    </div>
                </div>  
                <div class="col m4 s12">
                    <div class="card-panel creserved hoverable" data-filter="Reserved">
                        <div class="cardlabel">
                            <i class="far fa-address-card"></i>
                            <h5>Reserved</h5>
                        </div>
                        <h4 id="reservedCount">0</h4>
                    </div>
                </div>
            </div>
            <div class="row" id="room-cards">
                <!-- Displays Each Rooms using JS-->
            </div>
            <div class="right" id="pagination"><ul id="paginationUL"></ul></div>
        </div>
        
    </div>

</div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/dashboard/index.js') }}"></script>
@stop