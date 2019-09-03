@extends('layouts.app') 

@section('content')
    <div class="row collections-page">
        <div id="page-header">
            <div class="page-title">Collections Report</div>
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
                <div class="select-content">
                    <label for="fromdate">From</label>
                    <input type="text" id="fromdate" class="datepicker" value="{{ date("M d, Y") }}" placeholder="Date From">
                </div>
                <div class="select-content">
                    <label for="todate">To</label>
                    <input type="text" id="todate" class="datepicker" value="{{ date("M d, Y") }}" placeholder="Date To">
                </div>
            </div>
        </div>                   
        <div class="table-container">
            <table class="highlight z-depth-1 myTable">
                    <thead>
                        <tr>
                            <th width="20%">Or #</th>
                            <th width="30%">Collection</th>
                            <th width="30%">Date Collected</th> 
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="ORTable">
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
    <script src="{{ asset('/js/pages/Collection/index.js') }}"></script>
@stop