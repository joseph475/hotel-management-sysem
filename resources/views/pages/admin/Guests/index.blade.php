@extends('layouts.app') 

@section('content')
    <div class="row rooms-page">
        <div id="page-header">
            <div class="page-title" page-title="Guest Masterlist">Guest Masterlist</div>
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
            <div class="right-filter">
                <div class="input-field my0">
                    <a class="btn btn-2 printGuestlist" href="#"><i class="material-icons right">print</i>Print</a>
                </div>
            </div>
        </div>                   
        <div class="table-container">
            <table class="highlight z-depth-1 myTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Company Name</th>
                            <th>Room #</th>
                            <th style="width:15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="guestTable">
                        <!-- js generated -->
                    </tbody>    
            </table>
            <div class="right" id="pagination">
                <ul id="paginationUL">
    
                </ul>
            </div>  
        </div>
         
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/Guests/index.js') }}"></script>
@stop