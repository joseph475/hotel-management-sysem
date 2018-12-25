@extends('layouts.app') 

@section('content')
    <div class="row rooms-page">
        <div id="page-header">
            <div class="page-title">Hotel Settings</div>
            <div class="page-buttons">
                <div class="button-content">
                    <a class="btn btn-1" href="/">
                        <i class="material-icons left">arrow_back</i>
                        Back
                    </a>
                </div>
            </div>
        </div>
        <div class="table-container">
            <table class="highlight z-depth-1 myTable">
                    <thead>
                        <tr>
                            <th style="width:30%">Name</th>
                            <th style="width:45%">Value</th>
                            <th style="width:25%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="hotelInfoTable">
                        <!-- js generated -->
                    </tbody>    
            </table>
        </div>
    </div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/HotelInfo/index.js') }}"></script>
@stop