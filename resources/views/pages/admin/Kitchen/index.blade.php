@extends('layouts.app')

@section('content')
<div class="row checkin-page">
    <div id="page-header">
        <div class="page-title" page-title="Manage Food Menu">Manage Food Menu</div>
        <div class="page-buttons">
            <div class="button-content">
                <a class="btn btn-1" href="/">
                    <i class="material-icons left">arrow_back</i>
                    Back
                </a>
                <a class="btn btn-1 modal-trigger" href="#AddMenuModal">
                    <i class="material-icons left">add</i>
                    Add Menu
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
                        <th>Menu</th>
                        <th>Servings</th>
                        <th>Remaining</th>
                        <th>Cost</th>
                        <th>Selling Price</th>
                        <th style="width:20%;">Action</th>
                    </tr>
                </thead>
                <tbody id="foodTable">
                    <!-- js generated -->
                </tbody>    
        </table>
    </div>
    <div class="right" id="pagination">
        <ul id="paginationUL">

        </ul>
    </div>

    <div id="AddMenuModal" class="modal bottom-sheet">
        <div class="modal-content">
            <div class="row">
                <div class="col s12 m12">
                    <h4>Add New Menu</h4>
                </div>
            </div>
            <form action="" id="addRoomForm">
                <div class="row mt20">
                    <div class="col s12 m12">
                        <input  placeholder="Menu" id="menu" type="text" class="validate">
                    </div>
                    <div class="col s12 m12">
                        <input  placeholder="Servings" id="servings" type="number" class="validate">
                    </div>
                    <div class="col s12 m12">
                        <input  placeholder="Cost" id="cost" type="number" class="validate">
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
    <script src="{{ asset('/js/pages/Kitchen/index.js') }}"></script>
@stop