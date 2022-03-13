@extends('layouts.app') 

@section('content')
    <div class="row rooms-page">
        <div id="page-header">
            <div class="page-title" page-title="Upcoming Checkouts">Upcoming Checkouts</div>
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
                            <th>Room #</th>
                            <th>Guest</th>
                            <th>Contact</th>
                            <th>Checkout Date</th>
                            <th>Time</th>
                            <th style="width:10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="CheckoutTable">
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
    <script src="{{ asset('/js/pages/UpcomingCheckout/index.js') }}"></script>
@stop