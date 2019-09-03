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
                    <i class="material-icons left">send</i>
                    Check in
                </a>
            </div>
        </div>
    </div>
    
    <div class="row content">
        <div class="col s12 m6 first-col">
            <div class="input-field col s12 m12">
                <p>
                    <label class="mr20">
                        <input id="rdo-personal" class="with-gap" name="group1" type="radio" checked />
                        <span>Personal</span>
                    </label>
                    <label>
                        <input id="rdo-company" class="with-gap" name="group1" type="radio" />
                        <span>Charge to Company</span>
                    </label>
                </p>
            </div>
            <div class="input-field col s12 m12">
                <i class="material-icons prefix">account_circle</i>
                <input id="name" type="text" class="validate">
                <label for="name">Guest Name</label>
            </div>
            <div class="input-field col s12 m12">
                <i class="material-icons prefix">phone</i>
                <input id="contact" type="text">
                <label for="contact">Contact</label>
            </div>
            <div class="input-field col s12 m12">
                <i class="material-icons prefix">email</i>
                <input id="email" type="email" class="validate">
                <label for="email">Email</label>
            </div>
            <div class="input-field col s12 m12 comp_name_cont">
                <i class="material-icons prefix">business</i>
                <input id="compName" type="text" class="validate">
                <label for="compName">Company Name</label>
            </div>
            <div class="input-field col s12 m12 comp_name_address">
                <i class="material-icons prefix">location_on</i>
                <input id="compAdress" type="text" class="validate">
                <label for="compAdress">Company Adress</label>
            </div>
            <div class="input-field col s12 m12">
                <i class="material-icons prefix">people</i>
                <input id="adultsCount" value="1" type="number" class="validate">
                <label for="adultsCount">Adults Count</label>
                <span class="helper-text" data-error="wrong"></span>
            </div>
            <div class="input-field col s12 m12">
                <i class="material-icons prefix">people</i>
                <input id="childrenCount" value="0" type="number" class="validate">
                <label for="childrenCount">Children Count</label>
                <span class="helper-text" data-error="wrong"></span>
            </div>
        </div>

        <div class="col s12 m6 second-col">
            <div class="input-field col s12 m12">
                <i class="material-icons prefix">location_on</i>
                <input id="room_id" type="hidden" value="{{ $data['room']['room_id'] }}">
                <input id="roomNo" type="text" value="{{ $data['room']['roomNo'] }}" class="validate" disabled>
                <label for="roomNo">Room No</label>
            </div>
            <div class="input-field col s12 m12">
                <i class="material-icons prefix">hotel</i>
                <input id="roomType" data-type_id="{{ $data['room']['roomtype_id'] }}" type="text" value="{{ $data['room']['type'] }}" class="validate" disabled>
                <label for="roomType">Room Type</label>
            </div>
            <div class="input-field col s12 m12">
                <i class="material-icons prefix">swap_vert</i>
                <input id="floor" type="text" value="{{ $data['room']['floor'] }}" class="validate" disabled>
                <label for="floor">Floor</label>
            </div>
             <div class="input-field col s12 m12">
                <i class="material-icons prefix">access_time</i>
                <select id="duration">
                    {{--  js generated  --}}
                </select>
                <label for="duration">Duration</label>
            </div>
        </div>
    </div>
    {{--  <div id="ChooseHoursModal" class="modal bottom-sheet">
        <div class="modal-content">
            <div class="row">
                <div class="col m12 s12">
                    <h4>Choose No. of Hours</h4>
                </div>    
            </div>
            @foreach($data['roomRate'] as $rates)
                <p class="pl11">
                    <label class="mr20">
                        <input id="roomRate" name="roomRate" data-id="{{ $rates['id'] }}" value="{{ $rates['hours'] }}" class="with-gap" name="group3" type="radio" checked/>
                        <span class="mr10">Hours: {{ $rates['hours'] }}</span>
                        <span>Rate: &#8369 {{ $rates['rate'] }}</span>
                    </label>
                </p>
            @endforeach
        </div>
        <div class="modal-footer">
            <a href="#!"  class="modal-close waves-effect waves-green btn btn-1">
                Cancel
            </a>
            <button class="modal-close waves-effect waves-green btn btn-1 conf_select_hours">
                Confirm
            </button>
        </div>
    </div>  --}}
</div>
@endsection

@section('pagejs')
<script src="{{ asset('/js/pages/Checkin/index.js') }}"></script>
@stop