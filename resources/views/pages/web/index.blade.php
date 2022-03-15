@extends('layouts.web') 

@section('content')
    <div class="web-reservation" id="fullpage">
        <div class="section first-section">
            <div class="container px20 first-page">
                <br><br>
                <h1 class="teal-text header center text-lighten-1">{{ isset($variables['hotel'])? $variables['hotel'] : 'Hotel' }}</h1>
                <div class="row center">
                    <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
                </div>
                <div class="row center">
                    <div class="col s12 m12">
                        <div class="card web-tr-card">
                            <div class="card-content white-text">
                                <!-- <span class="card-title white-text">Reservation Form</span> -->
                                <div class="row">
                                    <div class="input-field col m4 s12">
                                        <label class="white-text" for="checkin_date">Checkin Date </label>
                                        <input placeholder="Checkin Date" id="checkin_date" type="date">
                                    </div>
                                    {{--  <div class="input-field col m2 s12">
                                        <input placeholder="Checkout Date" id="checkout_date" type="date">
                                    </div>  --}}
                                    <div class="input-field col m4 s12">
                                        <select id="roomType">
                                            <option value="" disabled selected>Room Type</option>
                                            @foreach($roomTypeList as $typelist)
                                                <option value="{{ $typelist->id }}"  data-maxChildren="{{ $typelist->maxChildren }}" data-maxAdult="{{ $typelist->maxAdult }}" >{{ $typelist->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-field col m2 s12">
                                        <select id="adult_count" class="validate">
                                            <option value="" disabled selected>Adult (18+)</option>
                                        </select>
                                    </div>
                                    <div class="input-field col m2 s12">
                                        <select id="child_count">
                                            <option value="" disabled selected>Children (0-17)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row center mb0">
                                    <!-- <a data-target="reservation_modal" class="btn modal-trigger btn-large waves-effect waves-light blue lighten-1 hoverable btn_bookNow">Book Now</a> -->
                                    <a class="btn btn-large waves-effect waves-light blue lighten-1 hoverable btn_bookNow">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
            </div>
        </div>

        <div class="section second-section">
            <div class="container px20 second-page">
                <div class="row">
                    @foreach($roomTypes as $type)
                        <div class="col m4 s12">
                            <div class="card room-cards">
                                <div class="card-image">
                                    <img src="<?php echo '/images/uploads/' . $type->img ?>" alt="/images/bg1.jpg">
                                    <span class="card-title"><?php echo $type->type; ?></span>
                                    <a class="btn-floating halfway-fab waves-effect waves-light blue hoverable tooltipped" data-tooltip="View Details"><i class="material-icons">forward</i></a>
                                </div>
                                <div class="card-content">
                                    <p><?php echo (strlen($type->description) > 100)? substr($type->description, 0, 100) . '...' : $type->description ?></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="section third-section">
            <div class="container px20 third-page">
                <div class="row">
                    <div class="col m4 s12">
                        <div class="card card-2 center">
                            <div class="card-content">
                                <span class="card-title">
                                    <h4 class="mt0">Accomodation</h4>
                                </span>
                                <p>I am a very simple card. I am good at containing small bits of information.
                                I am convenient because I require little markup to use effectively.</p>
                            </div>
                            <div class="card-action">
                                <a href="{{ url('/ChooseRoom') }}" class="btn waves-effect waves-light btn-1 hoverable">View Rooms
                                    <i class="material-icons right">forward</i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col m4 s12">
                        <div class="card card-2 center">
                            <div class="card-content">
                                <span class="card-title">
                                    <h4 class="mt0">Facilities</h4>
                                </span>
                                <p>I am a very simple card. I am good at containing small bits of information.
                                I am convenient because I require little markup to use effectively.</p>
                            </div>
                            <div class="card-action">
                                <a href="{{ url('/ChooseRoom') }}" class="btn waves-effect waves-light btn-1 hoverable">View Facilities
                                    <i class="material-icons right">forward</i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col m4 s12">
                        <div class="card card-2 center">
                            <div class="card-content">
                                <span class="card-title">
                                    <h4 class="mt0">Location</h4>
                                </span>
                                <p>
                                    {{ isset($variables['hotel'])? $variables['hotel'] : 'Hotel' }} is located at
                                    {{ isset($variables['address'])? $variables['address'] : 'address' }}
                                </p>
                            </div>
                            <div class="card-action">
                                <a href="{{ url('/ChooseRoom') }}" class="btn waves-effect waves-light btn-1 hoverable">View Location
                                    <i class="material-icons right">forward</i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>        
        <div class="section fourth-section">
            <div class="container px20 fourth-page">
                <br><br>
                <h1 class="teal-text header center text-lighten-2">Contact Us</h1>
                <div class="row center">
                    <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
                </div>
                <br><br>
            </div>
        </div>

    
        <div id="reservation_modal" class="modal">
            <div class="modal-content">
                <h4>Guest Details</h4>
                <div class="input-field col s12 mt30 mb20">
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
                <div class="input-field col s12">
                    <input id="guest_name" type="text" class="validate">
                    <label for="guest_name">Guest Name</label>
                </div>  
                <div class="input-field col s12">
                    <input id="guest_id_type" type="text" class="validate">
                    <label for="guest_id_type">Government ID Type</label>
                </div>
                <div class="input-field col s12">
                    <input id="guest_id" type="text" class="validate">
                    <label for="guest_id">ID Number</label>
                </div>
                <div class="input-field col s12 comp_name_cont">
                    <input id="compName" type="text" class="validate">
                    <label for="compName">Company Name</label>
                </div>
                <div class="input-field col s12 comp_name_address">
                    <input id="compAddress" type="text" class="validate">
                    <label for="compAddress">Company Address</label>
                </div>
                <div class="input-field col s12">
                    <input id="contact" type="text" class="validate">
                    <label for="contact">Contact</label>
                </div>
                <div class="input-field col s12">
                    <input id="email" type="email" class="validate">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="modal-footer">
                <a class="waves-effect waves-green btn btn-1 cancel_res">Cancel</a>
                <a class="waves-effect waves-green btn btn-1 book_res">Reserve</a>
            </div>
        </div>
    </div>
    
@endsection

@section('pagejs')
    <script>
        new fullpage('#fullpage', {
            autoScrolling:true,
            scrollHorizontally: false,
            anchors:['Reservation', 'Room_Types','Facilities', 'Contact_Us'],
            sectionsColor : ['#385170', '#385170', '#c0c0c0', '#1e1e1e'],
            navigation: true,
            controlArrows: false,
            scrollOverflow: true,
            navigationTooltips: ['Reservation', 'Room Types','Facilities', 'Contact Us'],
            scrollingSpeed: 1200,
            verticalCentered: true
        });
        fullpage_api.setAllowScrolling(true);
    </script>
    <script src="{{ asset('/js/pages/WebReservation/index.js') }}"></script>
@stop