@extends('layouts.app') 

@section('content')
    <div class="row room-page">
        <div id="page-header">
            <div class="page-title">Room {{ $roomNo }} Inventory</div>
            <div class="page-buttons">
                <div class="button-content">
                    <a class="btn btn-1" href="/">
                        <i class="material-icons left">arrow_back</i>
                        Back
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="table-container">
                <table class="highlight z-depth-1 myTable">
                        <thead>
                            <tr>
                                <th width="40%;">Description</th>
                                <th style="text-align:center;" width="15%;">Good</th>
                                <th style="text-align:center;" width="15%;">Damaged</th>
                                <th style="text-align:center;" width="15%;">Missing</th>
                                <th style="width:15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="inventoryTable">
                            @foreach($inventory as $item)
                                <tr>
                                    <td>{{ $item->description }}</td>
                                    <td style="text-align:center;">{{ $item->good }}</td>
                                    <td style="text-align:center;">{{ $item->damaged }}</td>
                                    <td style="text-align:center;">{{ $item->missing }}</td>
                                    <td><a href="#" class="btn btn-flat btn-2 tooltipped" data-tooltip="Edit"><i class="far fa-edit"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>    
                </table>
            </div>
            <div class="right" id="pagination">
                <ul id="paginationUL">

                </ul>
            </div>   
        </div>
    </div>
@endsection

@section('pagejs')
    <script src="{{ asset('/js/pages/Rooms/inventory.js') }}"></script>
@stop