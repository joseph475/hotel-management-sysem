@extends('layouts.app') 

@section('content')
    <div class="row roomtypes-page">
        <div id="page-header">
            <div class="page-title">Manage Room Types</div>
            <div class="page-buttons">
                <div class="button-content">
                    <a class="btn-floating btn-4 btn-small tooltipped" data-tooltip="Back" data-position="left" href="/">
                        <i class="material-icons">arrow_back</i>
                    </a>
                    <a class="btn-floating btn-4 btn-small tooltipped modal-trigger addRoomType" data-tooltip="Add Room Type" data-position="left" href="#AddRoomTypeModal">
                        <i class="material-icons left">add</i>
                        Add Room Type
                    </a>
                </div>
            </div>
        </div>
                    
        <div class="table-container">
            <table class="highlight z-depth-1 myTable">
                    <thead>
                        <tr>
                            <th style="width:40%">Type</th>
                            {{--  <th style="width:13%">Daily Rate</th>  --}}
                            {{--  <th style="width:12%">Penalty Rate/Hour</th>  --}}
                            <th style="width:20%">Max Adult</th>
                            <th style="width:20%">Max Children</th>
                            <th style="width:20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="roomTypeTable">
                        <!-- js generated -->
                    </tbody>    
            </table>
        </div>
        <div class="right" id="pagination">
            <ul id="paginationUL">

            </ul>
        </div>   
        
        <div id="AddRoomTypeModal" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <div class="col m12 s12">
                        <h4>Add New Room Type</h4>
                    </div>    
                </div>
                    <form action="" id="addRoomTypeForm">
                        <div class="row mt20">
                            <div class="col s12 m12">
                                <input  placeholder="Room Type" id="roomType" type="text" class="validate">
                            </div>
                            {{--  <div class="col s12 m12">
                                <input  placeholder="Daily Rate" id="rate" type="number" class="validate">
                            </div>  --}}
                            {{--  <div class="col s12 m12">
                                <input  placeholder="Penalty Rate per Hour" id="rateperhour" type="number" class="validate">
                            </div>  --}}
                            <div class="col s12 m12">
                                <input  placeholder="Max Adult" id="maxAdult" type="number" class="validate">
                            </div>
                            <div class="col s12 m12">
                                <input  placeholder="Max Children" id="maxChildren" type="number" class="validate">
                            </div>
                            <div class="col s12 m12">
                                <textarea class="p10 mt20 validate" id="description" rows="10" placeholder="Description"></textarea>
                            </div>
                        </div>
                    </form>
            </div>
            <div class="modal-footer">
                <a href="#!"  class="modal-close waves-effect waves-green btn btn-1">
                    Cancel
                </a>
                <button id="submit" class="modal-close waves-effect waves-green btn btn-1">
                    Save
                </button>
            </div>
        </div>
    </div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/RoomTypes/index.js') }}"></script>
@stop