@extends('layouts.app') 

@section('content')
    <div class="row room-page">
        <div id="page-header">
            <div class="page-title">{{ $data->type }}</div>
                <div class="page-buttons">
                <div class="button-content">
                    <a class="btn btn-1" href="/">
                        <i class="material-icons left">save</i>Save
                    </a>
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
                        <li class="collection-item"><i class="far fa-lg fa-money-bill-alt pr10"></i>Rate<span class="secondary-content">&#8369;{{ $data->rate }}</span></li>
                        <li class="collection-item"><i class="far fa-lg fa-money-bill-alt pr10"></i>Rate/Hour <span class="secondary-content">&#8369;{{ $data->rateperhour }}</span></li>
                        <li class="collection-item"><i class="fas fa-lg fa-users pr10"></i>Max Adult <span class="secondary-content">{{ $data->maxAdult }}</span></li>
                        <li class="collection-item"><i class="fas fa-lg fa-users pr10"></i>Max Children <span class="secondary-content">{{ $data->maxChildren }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="col m8 pull-m4 s12">
                <div class="image-container p20">
                    <div class="row mb0">
                        <form class="col s12">
                            <div class="row mb0">
                                <h6 class="mx0 my0 px10">Description</h6>
                                <div class="input-field col s12">
                                    <textarea class="p10" id="description" rows="10" style="height:auto;"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <form action="#">
                        <div class="file-field input-field">
                            <div class="btn btn-1">
                                <span><i class="material-icons left">file_upload</i>Upload</span>
                                <input type="file" multiple>
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
    <script src="{{ asset('/js/pages/RoomTypes/roomtype.js') }}"></script>
@stop