@extends('layouts.app') 

@section('content')
    <div class="row room-page">
        <div id="page-header">
            <div class="page-title">Room {{ $roomNo }} Inventory</div>
            <div class="page-buttons">
                <div class="button-content">
                    <a class="btn btn-1" href="/">
                        <i class="material-icons left">arrow_back</i>
                        Back
                    </a>
                    <a class="btn btn-1 modal-trigger" href="#AddInventoryModal">
                        <i class="material-icons left">add</i>
                        Add Item
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="table-container">
                <table class="highlight z-depth-1 myTable">
                        <thead>
                            <tr>
                                <th width="40%;">Description</th>
                                <th style="text-align:center;" width="15%;">Good</th>
                                <th style="text-align:center;" width="15%;">Damaged</th>
                                <th style="text-align:center;" width="15%;">Missing</th>
                                <th style="width:15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="inventoryTable">
                            @foreach($inventory as $item)
                                <tr>
                                    <td>{{ $item->description }}</td>
                                    <td style="text-align:center;">{{ $item->good }}</td>
                                    <td style="text-align:center;">{{ $item->damaged }}</td>
                                    <td style="text-align:center;">{{ $item->missing }}</td>
                                    <td><a href="#" class="btn btn-flat btn-2 tooltipped" data-tooltip="Edit"><i class="far fa-edit"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>    
                </table>
            </div>
            <div class="right" id="pagination">
                <ul id="paginationUL">

                </ul>
            </div>   
        </div>
        <div id="AddInventoryModal" class="modal bottom-sheet">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12">
                        <h4>Add New Item</h4>
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
    <script src="{{ asset('/js/pages/Rooms/inventory.js') }}"></script>
@stop