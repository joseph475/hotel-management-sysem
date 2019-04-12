@extends('layouts.app') 

@section('content')
    <div class="row rooms-page">
        <div id="page-header">
            <div class="page-title">Guests Masterlist</div>
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
        </div>
        <div class="right" id="pagination">
            <ul id="paginationUL">

            </ul>
        </div>   
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/Guests/index.js') }}"></script>
@stop