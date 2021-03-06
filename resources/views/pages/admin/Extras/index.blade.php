@extends('layouts.app') 

@section('content')
    <div class="row rooms-page">
        <div id="page-header">
            <div class="page-title" page-title="Manage Extras">Manage Extras</div>
            <div class="page-buttons">
                <div class="button-content">
                    <a class="btn btn-1" href="/">
                        <i class="material-icons left">arrow_back</i>
                        Back
                    </a>
                    <a class="btn btn-1 modal-trigger addExtras" href="#AddExtrasModal">
                        <i class="material-icons left">add</i>
                        Add Extras
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
                            <th>Description</th>
                            <th>Price</th>
                            <th style="width:20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="extrasTable">
                        <!-- js generated -->
                    </tbody>    
            </table>
            <div class="right" id="pagination">
                <ul id="paginationUL">
    
                </ul>
            </div>   
        </div>
        
        
        <div id="AddExtrasModal" class="modal bottom-sheet">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12">
                        <h4>Add Extras</h4>
                    </div>
                </div>
                <form action="" id="addExtrasForm">
                    <div class="row mt20">
                        <div class="col s12 m12">
                            <input  placeholder="Description" id="description" type="text" class="validate">
                        </div>
                        <div class="col s12 m12">
                            <input  placeholder="Price" id="price" type="number" class="validate">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#!"  class="modal-close waves-effect waves-green btn btn-1 right">
                    Cancel
                </a>
                <button id="submit" class="modal-close waves-effect waves-green btn btn-1 right">
                    Save
                </button>
            </div>
        </div>
    </div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/Extras/index.js') }}"></script>
@stop