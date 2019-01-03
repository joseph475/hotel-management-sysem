@extends('layouts.web') 

@section('content')
    <div class="web-reservation">
        <div class="parallax-container par1">
            <div class="section no-pad-bot">
                <div class="container">
                    <br><br>
                    <h1 class="teal-text header center text-lighten-2">{{ isset($variables['hotel'])? $variables['hotel'] : 'Hotel' }}</h1>
                    <div class="row center">
                        <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
                    </div>
                    <div class="row center">
                        <div class="col s12 m12">
                            <div class="card web-tr-card">
                                <div class="card-content white-text">
                                    <!-- <span class="card-title white-text">Reservation Form</span> -->
                                    <div class="row">
                                        <div class="input-field col m2 s12">
                                            <input placeholder="Date" id="checkin_date" type="text" class="datepicker">
                                        </div>
                                        <div class="input-field col m3 s12">
                                            <select>
                                                <option value="" disabled selected>Adult (18+)</option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                                <option value="3">Option 3</option>
                                            </select>
                                        </div>
                                        <div class="input-field col m3 s12">
                                            <select>
                                                <option value="" disabled selected>Children (0-17)</option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                                <option value="3">Option 3</option>
                                            </select>
                                        </div>
                                        <div class="input-field col m4 s12">
                                            <select>
                                                <option value="" disabled selected>Room Type</option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                                <option value="3">Option 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row center mb0">
                                        <a href="#" id="download-button" class="btn-large waves-effect waves-light blue lighten-1 hoverable">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                </div>
            </div>
            <div class="parallax">
                <img class="responsive-img" src='/images/bg3.jpg'>
            </div>
        </div>

        <div class="section white pt30 z-depth-1">
            <div class="container">
                <div class="row">
                    @foreach($roomTypes as $type)
                        <div class="col s12 m4">
                            <div class="card">
                                <div class="card-image">
                                    <img src="<?php echo '/images/' . $type->img ?>" alt="/images/bg1.jpg">
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

        <div class="parallax-container par2">
            <div class="section no-pad-bot">
                <div class="container">
                    <br><br>
                    <h1 class="teal-text header center text-lighten-2">Contact Us</h1>
                    <div class="row center">
                        <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
                    </div>
                    <br><br>
                </div>
            </div>
            <div class="parallax">
                <img class="responsive-img" src='/images/bg6.jpg'>
            </div>
        </div>

        <div class="section white z-depth-1">
            <div class="container">
                <div class="row">
                    <div class="col s12 m4">
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
                    <div class="col s12 m4">
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
                    <div class="col s12 m4">
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

    </div>
    
@endsection

@section('pagejs')
    <!-- <script src="{{ asset('/js/pages/BookNow/index.js') }}"></script> -->
@stop