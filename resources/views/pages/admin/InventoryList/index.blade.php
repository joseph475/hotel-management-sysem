@extends('layouts.app') 

@section('content')
    <div class="row rooms-page">
        <div id="page-header">
            <div class="page-title" page-title="Manage Inventory List">Manage Inventory List</div>
            <div class="page-buttons">
                <div class="button-content">
                    <a class="btn btn-1" href="/">
                        <i class="material-icons left">arrow_back</i>
                        Back
                    </a>
                    <a class="btn btn-1 modal-trigger addInventoryItem" href="#AddInventoryItemModal">
                        <i class="material-icons left">add</i>
                        Add Inventory Item
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
                            <th style="width:20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="inventoryTable">
                        <!-- js generated -->
                    </tbody>    
            </table>
        </div>
        <div class="right" id="pagination">
            <ul id="paginationUL">

            </ul>
        </div>   
        
        <div id="AddInventoryItemModal" class="modal bottom-sheet">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12">
                        <h4>Add Inventory Item</h4>
                    </div>
                </div>
                <form action="" id="addExtrasForm">
                    <div class="row mt20">
                        <div class="col s12 m12">
                            <input  placeholder="Description" id="description" type="text" class="validate">
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
    <script src="{{ asset('/js/pages/InventoryList/index.js') }}"></script>
@stop