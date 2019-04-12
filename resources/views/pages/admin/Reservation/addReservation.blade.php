@extends('layouts.app') 

@section('content')
    <div class="AddReservation">
        <div id="page-header">
            <div class="page-title">Add Reservation</div>
            <div class="page-buttons">
                <div class="button-content">
                    <a class="btn-floating btn-4 btn-small tooltipped" 
                        data-tooltip="Back" data-position="left" href="/">
                        <i class="material-icons">arrow_back</i>
                    </a>
                    <a class="btn-floating btn-4 btn-small tooltipped"
                        data-tooltip="Save" data-position="left" id="btn_save_res">
                        <i class="material-icons left">save</i>
                        Save
                    </a>
                </div>
            </div>
        </div>
        <div class="content p20 pt30">
            <div class="row">
                <div class="col s12 m6 pt20">
                    <div class="input-field col s12 m12">
                        <input placeholder="-" id="name" type="text" class="validate">
                        <label for="name">Guest Name</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <select id="valid_id_type">
                            <option value="" disabled selected>Choose Valid ID</option>
                            <option value="SSS">SSS</option>
                            <option value="Pag Ibig">Pag Ibig</option>
                            <option value="Phil Health">Phil Health</option>
                            <option value="Drivers License">Drivers License</option>
                            <option value="Voters ID">Voters ID</option>
                        </select>
                        <label>Select Valid ID</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input placeholder="-" id="valid_id" type="text" class="validate">
                        <label for="valid_id">ID Number</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <div class="select-content">
                            @include('partials.roomtypes')
                        </div>
                    </div>
                    <div class="input-field col s12 m6">
                        <input placeholder="-" id="mobile" type="text" class="validate">
                        <label for="mobile">Contact No.</label>
                    </div>
                    <div class="input-field col s12 m12">
                        <input placeholder="-" id="email" type="email" class="validate">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="col s12 m6 pt20">
                    <div class="input-field col s12 m12">
                        <input placeholder="-" id="compName" type="text">
                        <label for="compName">Company Name</label>
                    </div>
                    <div class="input-field col s12 m12">
                        <input placeholder="-" id="compAddress" type="text">
                        <label for="compAddress">Company Address</label>
                    </div>
                    <div class="input-field col s12 m12">
                        <input placeholder="-" id="checkinDate" type="text" class="datepicker validate">
                        <label for="checkinDate">Checkin Date</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input placeholder="-" id="adultsCount" type="number" class="validate">
                        <label for="adultsCount">Adults Count</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input placeholder="-" id="childCount" type="number" class="validate">
                        <label for="childCount">Children Count</label>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/AdminReservation/addReservation.js') }}"></script>
@stop