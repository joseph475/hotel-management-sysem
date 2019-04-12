@extends('layouts.app')

@section('content')
<div class="row checkin-page">
    <div id="page-header">
        <div class="page-title">Room Management</div>
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
                            <th>Room #</th>
                            <th>Status</th>
                            <th style="width:50%;">Change Status</th>
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
</div>
@endsection

@section('pagejs')
<script src="{{ asset('/js/pages/roomManagement/index.js') }}"></script>
@stop