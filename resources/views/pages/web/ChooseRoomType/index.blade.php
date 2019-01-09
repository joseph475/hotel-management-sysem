@extends('layouts.web') 

@section('content')
    <div class="web-RoomTypes">
       <div class="container">
            <div class="row">
                <div class="col s12 m12">
                    <ul class="collapsible mt40">
                        @foreach($roomtypes as $roomtype)
                            <li class="chooseRoomsLi">
                                <div class="collapsible-header">
                                    <i class="material-icons">hotel</i>
                                    {{ $roomtype->type }}
                                    <span class="new badge blue lighten-1 tooltipped" data-tooltip="Available" data-badge-caption="">4
                                    </span>
                                </div>
                                <div class="collapsible-body grey lighten-3">
                                    <div class="row">
                                        <div class="col s12 m6">
                                            <span>
                                                <img class="responsive-img materialboxed z-depth-1" src="<?php echo ($roomtype->img != "") ? '/images/' . $roomtype->img : "" ?>" alt="">
                                            </span>
                                        </div>
                                        <div class="col s12 m6">
                                            <h5>{{ isset($roomtype->description) ? "Amenities" : "" }}</h5>
                                            <div>
                                                <?php echo isset($roomtype->description) ? $roomtype->description : ""; ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
       </div>
    </div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/ChooseRooms/index.js') }}"></script>
@stop