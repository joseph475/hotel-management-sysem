@extends('layouts.app') 

@section('content')
    <div class="row collections-page">
        <div id="page-header">
            <div class="page-title">Inventory Status Report</div>
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
            <div id="daily" class="col s12 no-pad">
                <div class="col s12 m12 no-pad-mar">
                    <div class="card horizontal">
                        <div class="card-stacked">
                            <div class="card-content">
                                <div class="row mb0">
                                    <form class="col s12">
                                      <div class="row">
                                        <div class="input-field col s12 m4">
                                          <input placeholder="Input Room No" id="roomNo" type="text" class="validate">
                                          <label for="roomNo">Room #</label>
                                          <a href="#" class="btn btn-2 printReport" report-type="per-room"><i class="material-icons left">print</i>Print</a>
                                        </div>
                                      </div>
                                      <div class="row mb0">
                                        <div class="input-field col s12 m4">
                                          <a href="#" class="btn btn-2 printReport" report-type="all-room"><i class="material-icons left">print</i>Print All</a>
                                        </div>
                                      </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div> 
    </div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/InventoryStatus/index.js') }}"></script>
@stop