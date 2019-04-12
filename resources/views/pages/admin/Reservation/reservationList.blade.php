@extends('layouts.app')

@section('content')
<div class="row checkin-page">
    <div id="page-header">
        <div class="page-title">Reservation List</div>
        <div class="page-buttons">
            <div class="button-content">
                <a class="btn-floating btn-4 btn-small tooltipped" 
                    data-tooltip="Back" data-position="left" href="/">
                    <i class="material-icons">arrow_back</i>
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
    </div>        
    <div class="table-container">
        <table class="highlight z-depth-1 myTable">
                <thead>
                    <tr>
                        <th>Guest Name</th>
                        <th>Personal ID</th>
                        <th>RoomType</th>
                        <th>Contact</th>
                        <th>Checkin Date</th>
                        <th style="width:15%;">Action</th>
                    </tr>
                </thead>
                <tbody id="ReservationListTable">
                    <!-- js generated -->
                </tbody>    
        </table>
    </div>
    <div class="right" id="pagination">
        <ul id="paginationUL">

        </ul>
    </div>

    <div id="AddMenuModal" class="modal modal-fixed-footer">
        <div class="modal-content">
            <div class="row">
                <div class="col s12 m12">
                    <h4>Add New Menu</h4>
                </div>
            </div>
            <form action="" id="addRoomForm">
                <div class="row mt20">
                    <div class="col s12 m12">
                        <input  placeholder="Menu" id="menu" type="text" class="validate">
                    </div>
                    <div class="col s12 m12">
                        <input  placeholder="Servings" id="servings" type="number" class="validate">
                    </div>
                    <div class="col s12 m12">
                        <input  placeholder="Cost" id="cost" type="number" class="validate">
                    </div>
                    <div class="col s12 m12">
                        <input  placeholder="Price" id="price" type="number" class="validate">
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

    <div id="RoomList" class="modal bottom-sheet">
        <div class="modal-content">
            <ul class="collection with-header" id="roomListUl">
                {{--  js generated  --}}
            </ul>
        </div>
    </div>
</div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/AdminReservation/reservationList.js') }}"></script>
@stop