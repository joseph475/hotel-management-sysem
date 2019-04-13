@extends('layouts.app')

@section('content')
<div class="row">
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
    </div>
    <div class="right" id="pagination">
        <ul id="paginationUL">

        </ul>
    </div>
</div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/AdminReservation/checkinReservation.js') }}"></script>
@stop