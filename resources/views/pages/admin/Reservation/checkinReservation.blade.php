@extends('layouts.app')

@section('content')
<div class="row">
    <div id="page-header">
        <div class="page-title" page-title="Checkin Reservation">Checkin Reservations</div>
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
                    <th>Room No</th>
                    <th>RoomType</th>
                    <th>Duration</th>
                    <th>Contact</th>
                    <th style="width:15%;">Action</th>
                </tr>
            </thead>
            <tbody id="ReservationListTable">
                <!-- js generated -->
            </tbody>    
        </table>
        <div class="right" id="pagination">
            <ul id="paginationUL">
    
            </ul>
        </div>
    </div>
    
</div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/AdminReservation/checkinReservation.js') }}"></script>
@stop