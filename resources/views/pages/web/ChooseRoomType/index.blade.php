@extends('layouts.web') 

@section('content')
    <div class="web-RoomTypes">
       <div class="container">
            <div class="row">
                <div class="col s12 m12">
                    <ul class="collapsible mt40">
                        @foreach($roomtypes as $roomtype)
                            <li class="chooseRoomsLi">
                                <div class="collapsible-header roomType-header">
                                    <i class="material-icons">hotel</i>
                                    {{ $roomtype->type }}
                                    <span class="new badge blue lighten-1 tooltipped" data-tooltip="Available" data-badge-caption="">4
                                    </span>
                                </div>
                                <div class="collapsible-body grey lighten-3">
                                    <div class="row mb0">
                                        <div class="col s12 m6">
                                            <span>
                                                <img style="height:270px; width:100%;" class="responsive-img materialboxed z-depth-1 mb20" src="<?php echo ($roomtype->img != "") ? '/images/' . $roomtype->img : "" ?>" alt="">
                                            </span>
                                            <div class="row mb0">
                                                @foreach($room_images as $image)
                                                    @if($image->roomtype_id == $roomtype->id)
                                                        <div class="col s4 m4">
                                                            <div class="image-container" style="height:80px;">
                                                                <img style="height:80px; width:100%;" class="responsive-img materialboxed z-depth-1 img-list" 
                                                                src="<?php echo ($image->filename != "") ? '/images/uploads/' . $image->filename : "" ?>" alt="">
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col s12 m6">
                                            <div class="title_book mb20">
                                                <h5 class="my0">{{ isset($roomtype->description) ? "Room Info" : "" }}</h5>
                                                <a href="" class="btn waves-effect waves-light btn-1 btn-flat white-text hoverable btn_booknow">
                                                    <i class="material-icons right">send</i>
                                                    Book Now
                                                </a>
                                            </div>
                                            
                                            <div class="room_desc">
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