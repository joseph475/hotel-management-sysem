@extends('layouts.web') 

@section('content')
    <div class="web-reservation mb10">
        <div class="parallax-container">
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
                                    <span class="card-title white-text">Reservation Form</span>
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
<<<<<<< HEAD
                                        <div class="input-field col m3 s12">
=======
                                        <div class="input-field col m4 s12">
>>>>>>> d4027dcabbacced20e1699bf9736a9fd57430f2c
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
    </div>
    <div class="section white">
        <div class="container">
            <div class="row">
                @foreach($roomTypes as $type)
                    <div class="col s12 m4">
                        <div class="card">
                            <div class="card-image">
                                <img src="<?php echo '/images/' . $type->img ?>">
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
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/BookNow/index.js') }}"></script>
@stop