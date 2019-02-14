@extends('layouts.app') 

@section('content')
    <div class="row rooms-page">
        <div id="page-header">
            <div class="page-title">Manage Rooms</div>
            <div class="page-buttons">
                <div class="button-content">
                    <a class="btn btn-1" href="/">
                        <i class="material-icons left">arrow_back</i>
                        Back
                    </a>
                    <a class="btn btn-1 modal-trigger addRoom" href="#AddRoomModal">
                        <i class="material-icons left">add</i>
                        Add Room
                    </a>
                </div>
            </div>
        </div>
        <div class="filters">
            <div class="left-filter">
                <div class="search-content">
                    @include('partials.search')
                </div>
            </div>
            <div class="right-filter">
                <div class="select-content">
                    @include('partials.roomtypes')
                </div>
                <div class="select-content">
                    @include('partials.floors')
                </div>
            </div>
        </div>                   
        <div class="table-container">
            <table class="highlight z-depth-1 myTable">
                    <thead>
                        <tr>
                            <th>Room #</th>
                            <th>Type</th>
                            <th>Floor</th>
                            {{--  <th>Rate</th>
                            <th>Rate/Hour</th>  --}}
                            <th style="width:20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="roomTable">
                        <!-- js generated -->
                    </tbody>    
            </table>
        </div>
        <div class="right" id="pagination">
            <ul id="paginationUL">

            </ul>
        </div>   
        
        <div id="AddRoomModal" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12">
                        <h4>Add New Room</h4>
                    </div>
                </div>
                <form action="" id="addRoomForm">
                    <div class="row mt20">
                        <div class="col s12 m12">
                            <input  placeholder="Room No" id="roomNo" type="text" class="validate">
                        </div>
                        <div class="col s12 m12">
                            @include('partials.roomtypes')
                        </div>
                        <div class="col s12 m12">
                            @include('partials.floors')
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#!"  class="modal-close waves-effect waves-green btn btn-1 right">
                    Cancel
                </a>
                <button id="submit" class="modal-close waves-effect waves-green btn btn-1 right">
                    Save
                </button>
            </div>
        </div>
    </div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/Rooms/index.js') }}"></script>
@stop