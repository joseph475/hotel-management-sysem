@extends('layouts.app') 

@section('content')
    <div class="row room-page">
        <div id="page-header">
            <div class="page-title">Room {{ $data->roomNo }}</div>

            <div class="page-buttons">
                <div class="button-content">
                    <a class="btn btn-1" href="/">
                        {!! ($data->ispublished == 1) ? '<i class="material-icons left">swap_vert</i>Unpublish' : '<i class="material-icons left">swap_vert</i>Publish' !!}
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col m4 push-m8 s12">
                <div class="room-container pt10">
                    <ul class="collection">
                        <li class="collection-item">Type <span class="secondary-content">{{ $data->type }}</span></li>
                        <li class="collection-item">Floor <span class="secondary-content">{{ $data->floor }}</span></li>
                        <li class="collection-item">Rate <span class="secondary-content">{{ $data->rate }}</span></li>
                        <li class="collection-item">Rate/Hour <span class="secondary-content">{{ $data->rateperhour }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="col m8 pull-m4 s12">
                <div class="image-container">
                    <form action="#">
                        <div class="file-field input-field">
                            <div class="btn btn-1">
                                <span><i class="material-icons left">file_upload</i>Upload</span>
                                {{--  <input type="file" multiple>  --}}
                                <input id="fileupload" type="file" name="files[]" data-url="server/php/" multiple>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Upload one or more Images">
                            </div>
                        </div>
                    </form>
                </div>                 
            </div>
        </div>
    </div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/Rooms/room.js') }}"></script>
@stop