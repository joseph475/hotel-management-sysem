@extends('layouts.app')

@section('content')
<div class="row reservation-list">
    <div id="page-header">
        <div class="page-title">Pending Reservations List</div>
        <div class="page-buttons">
            <div class="button-content">
                <a class="btn btn-1" href="/">
                    <i class="material-icons left">arrow_back</i>
                    Back
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