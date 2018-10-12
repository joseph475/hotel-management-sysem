@extends('layouts.app')

@section('content')
<div class="row checkin-page">
    <div id="page-header">
        <div class="page-title">Check in</div>
        <div class="page-buttons">
            <div class="button-content">
                <a class="btn btn-1" id="submitCheckin">
                    <i class="material-icons left">send</i>
                    Check in
                </a>
            </div>
        </div>
    </div>
    
    <div class="row content z-depth-1">
        <div class="col s12 m6 first-col">
            <div class="page-header-2">
                <div class="page-title-2">Guest Information</div>
            </div>
            <div class="row">
                <div class="input-field col s12 m12">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="name" type="text" class="validate">
                    <label for="name">Guest Name</label>
                </div>
                <div class="input-field col s12 m12">
                    <i class="material-icons prefix">phone</i>
                    <input id="contact" type="text" class="validate">
                    <label for="contact">Contact</label>
                </div>
                <div class="input-field col s12 m12">
                    <i class="material-icons prefix">business</i>
                    <input id="compName" type="text" class="validate">
                    <label for="compName">Company Name</label>
                </div>
                <div class="input-field col s12 m12">
                    <i class="material-icons prefix">location_on</i>
                    <input id="compAdress" type="text" class="validate">
                    <label for="compAdress">Company Adress</label>
                </div>
            </div>
            <div class="page-header-2">
                <div class="page-title-2">Checkin Details</div>
            </div>
            <div class="row">
                <div class="input-field col s12 m12">
                    <i class="material-icons prefix">event</i>
                    <input id="checkoutdate" type="text" class="datepicker">
                    <label for="checkoutdate">Checkout Date</label>
                    <span class="helper-text" data-error="wrong"></span>
                </div>
                <div class="input-field col s12 m12">
                    <i class="material-icons prefix">people</i>
                    <input id="maxAdult" type="number" class="validate">
                    <label for="maxAdult">Max Adult</label>
                    <span class="helper-text" data-error="wrong"></span>
                </div>
                <div class="input-field col s12 m12">
                    <i class="material-icons prefix">people</i>
                    <input id="maxChildren" type="text" class="validate">
                    <label for="maxChildren">Max Children</label>
                    <span class="helper-text" data-error="wrong"></span>
                </div>
            </div>
        </div>

        <div class="col s12 m6 second-col">
            <div class="page-header-2">
                <div class="page-title-2">Room Information</div>
            </div>
            <div class="row">
                <div class="input-field col s12 m12">
                    <i class="material-icons prefix">location_on</i>
                    <input id="roomNo" type="text" class="validate" disabled>
                    <label for="roomNo">Room No</label>
                </div>
                <div class="input-field col s12 m12">
                    <i class="material-icons prefix">hotel</i>
                    <input id="roomType" type="text" class="validate" disabled>
                    <label for="roomType">Room Type</label>
                </div>
                <div class="input-field col s12 m12">
                    <i class="material-icons prefix">swap_vert</i>
                    <input id="floor" type="text" class="validate" disabled>
                    <label for="floor">Floor</label>
                </div>
                <div class="input-field col s12 m12">
                    <i class="material-icons prefix">attach_money</i>
                    <input id="rate" type="text" class="validate" disabled>
                    <label for="rate">Rate</label>
                </div>
                <div class="input-field col s12 m12">
                    <i class="material-icons prefix">attach_money</i>
                    <input id="rateperhour" type="text" class="validate" disabled>
                    <label for="rateperhour">Rate per Hour</label>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pagejs')
<script src="{{ asset('/js/pages/checkin/index.js') }}"></script>
@stop