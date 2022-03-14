@extends('layouts.app') 

@section('content')
    <div class="row">
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
        <div id="UpdateModal" class="modal bottom-sheet">
            <div class="row mb0">
                <div class="col s12 m12">
                    <div class="input-field col s12 mt25">
                        <input id="key" type="text" class="validate">
                        <label for="key"></label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="modal-close waves-effect waves-green btn btn-1 right">
                    Cancel
                </a>
                <button id="submit" class="waves-effect waves-green btn btn-1 right">
                    Save
                </button>
            </div>
        </div>
    </div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/HotelInfo/index.js') }}"></script>
@stop