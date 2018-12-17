@extends('layouts.app') 

@section('content')
    <div class="row roomTypeInnerPage">
        <div id="page-header">
            <div class="page-title">{{ $roomtype->type }}</div>
                <div class="page-buttons">
                <div class="button-content">
                    <a class="btn btn-1 submitRoomType">
                        <i class="material-icons left">save</i>Save
                    </a>
                    <a class="btn btn-1" href="/">
                        {!! ($roomtype->ispublished == 1) ? '<i class="material-icons left">swap_vert</i>Unpublish' : '<i class="material-icons left">swap_vert</i>Publish' !!}
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col m4 push-m8 s12">
                <div class="room-container pt10">
                    <ul class="collection">
                        <li class="collection-item"><i class="far fa-lg fa-money-bill-alt pr10"></i>Rate<span class="secondary-content">&#8369;{{ $roomtype->rate }}</span></li>
                        <li class="collection-item"><i class="far fa-lg fa-money-bill-alt pr10"></i>Rate/Hour <span class="secondary-content">&#8369;{{ $roomtype->rateperhour }}</span></li>
                        <li class="collection-item"><i class="fas fa-lg fa-users pr10"></i>Max Adult <span class="secondary-content">{{ $roomtype->maxAdult }}</span></li>
                        <li class="collection-item"><i class="fas fa-lg fa-users pr10"></i>Max Children <span class="secondary-content">{{ $roomtype->maxChildren }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="col m8 pull-m4 s12">
                <div class="image-container">
                    <form id="submitForm" action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="row mb0 desc">
                                <h6 class="mx0 my0 px10">Description</h6>
                                <input type="hidden" name="id" value="{{ $roomtype->id }}">
                                <div class="input-field col s12">
                                    <textarea class="p10" name="description" id="description" rows="10">{{ $roomtype->description }}</textarea>
                                </div>
                            </div>
                            <div class="file-field input-field mb10">
                                <div class="btn">
                                    <span>Upload</span>
                                    <input type="file" name="image[]" multiple>
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="Upload one or more files">
                                </div>
                            </div>
                            <table class="highlight z-depth-1 myTable">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Filename</th>
                                            <!-- <th>Uploaded</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="roomTypeTable">
                                        @foreach($room_images as $images)
                                            <tr>
                                                <td><img class="imgdisp responsive-img" src="{{url('/images/uploads/' . $images->filename)}}" alt=""></td>
                                                <td>{{ $images->filename }}</td>
                                                <!-- <td>{{ date('Y-m-d', strtotime($images->date_created)) }}</td> -->
                                                <td><a href="" class="btn btn-flat btn-2"><i class="far fa-trash-alt"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>    
                            </table>
                        </div>
                    </form>
                </div>    
            </div>
        </div>
    </div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/RoomTypes/roomtype.js') }}"></script>
@stop