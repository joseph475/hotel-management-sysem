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
        
        <div class="table-container">
            <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                <li class="tab col s3"><a class="active" href="#daily">Daily Collection</a></li>
                <li class="tab col s3"><a href="#range">Date Range Filter</a></li>
                <li class="tab col s3"><a href="#ORnumber">OR #</a></li>
            </ul>
            <div id="daily" class="col s12 no-pad">
                <div class="col s12 m12 no-pad-mar">
                    <div class="card horizontal">
                        <div class="card-image">
                            <img class="peso-img" src="https://s3.amazonaws.com/static.graphemica.com/glyphs/i500s/000/012/505/original/20B1-500x500.png?1275331286">
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <p class="headline">Date: {{ date("M d, Y") }}</p>
                                <p class="headline total_collectionDaily">Collections: </p>
                            </div>
                            <div class="card-action">
                                <a href="#" class="btn btn-2 right printReport" report-type="daily"><i class="material-icons left">print</i>Preview</a>
                            </div>
                        </div>
                    </div>
                </div>   
                <table class="highlight z-depth-1 myTable">
                        <thead>
                            <tr>
                                <th width="20%">Or #</th>
                                <th width="30%">Collection</th>
                                <th width="30%">Date Collected</th> 
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="DailyTable">
                            <!-- js generated -->
                        </tbody>    
                </table>
            </div>
            <div class="right" id="pagination">
                <ul id="paginationUL">
    
                </ul>
            </div>
            <div id="range" class="col s12 no-pad">
                <div class="col s12 m12 no-pad-mar">
                    <div class="card-panel py10">
                        <div class="row no-mar">
                            <div class="input-field col s12 m3 mb2">
                                <i class="material-icons prefix">date_range</i>
                                <label for="fromdate">From</label>
                                <input type="text" id="fromdate" class="datepicker" value="{{ date("M d, Y") }}" placeholder="Date From">
                            </div>
                            <div class="input-field col s12 m3 mb2">
                                <i class="material-icons prefix">date_range</i>
                                <label for="todate">To</label>
                                <input type="text" id="todate" class="datepicker" value="{{ date("M d, Y") }}" placeholder="Date To">
                            </div>
                            <div class="input-field col s12 m3 mb2">
                               <a class="btn btn-2 filterlist" href="#"><i class="material-icons right">arrow_forward</i>Filter</a>
                            </div>
                        </div>
                    </div>
                    <div class="card horizontal">
                        <div class="card-image">
                            <img class="peso-img" src="https://s3.amazonaws.com/static.graphemica.com/glyphs/i500s/000/012/505/original/20B1-500x500.png?1275331286">
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <p class="headline datedisplay">From: {{ date("M d, Y") }} &nbsp; &nbsp; To: {{ date("M d, Y") }}</p>
                                <p class="headline total_collectionRange">Collections: </p>
                            </div>
                            <div class="card-action">
                                <a href="#" class="btn btn-2 right printReport" report-type="range"><i class="material-icons left">print</i>Preview</a>
                            </div>
                        </div>
                    </div>
                    <table class="highlight z-depth-1 myTable">
                        <thead>
                            <tr>
                                <th width="20%">Or #</th>
                                <th width="30%">Collection</th>
                                <th width="30%">Date Collected</th> 
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="RangeTable">
                            <!-- js generated -->
                        </tbody>    
                    </table>
                </div>
            </div>
            <div id="ORnumber" class="col s12 no-pad">
                 <div class="col s12 m12 no-pad-mar">
                    <div class="card-panel py10">
                        <div class="row no-mar">
                            <div class="input-field col s12 m4 mb2">
                                <input type="text" id="search" value="" placeholder="Search">
                            </div>
                            <div class="input-field col s12 m3 mb2">
                               <a class="btn btn-2 searchOR" href="#"><i class="material-icons right">search</i>Search</a>
                            </div>
                        </div>
                    </div>
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
            </div>
        </div> 
    </div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/CollectionsReport/index.js') }}"></script>
@stop