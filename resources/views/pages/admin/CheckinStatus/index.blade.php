@extends('layouts.app')

@section('content')
<div class="row checkin-status-page" data-id="{{ $data->checkin_id }}">
    <div id="page-header">
        <div class="page-title">Checkin Status</div>
        <div class="page-buttons">
            <div class="button-content">
                <a class="btn btn-1" href="/">
                    <i class="material-icons left">arrow_back</i>
                    Back
                </a>
                <a href="#ChooseHoursModal" class="btn btn-1 modal-trigger" id="extend_time">
                    <i class="material-icons left">access_time</i>
                    Extend Time
                </a>
                <a class="btn btn-1" id="submitCheckin">
                    <i class="material-icons left">exit_to_app</i>
                    Check Out
                </a>
            </div>
        </div>
    </div>
    <div class="row content">
        <div class="col s12 m4 push-m8">
            <ul class="collapsible expandable mb6">
                <li class="active">
                    <div class="collapsible-header">
                        <i class="far fa-money-bill-alt"></i>Billing Summary 
                        <a class="headerbtn printSummary tooltipped" data-tooltip="Print">
                            <i class="material-icons">print</i>
                        </a>
                    </div>
                    <div class="collapsible-body">
                        <ul>
                            <li>Room <span class="right">&#8369; {{ $totalRoom[0]->rate }}</span></li>
                            <li>Food <span class="right">&#8369; {{ $totalFoods[0]->price }}</span></li>
                            <li>Extras <span class="right">&#8369; {{ $totalExtras[0]->price }}</span></li>
                            <li>Total <span class="right">&#8369; {{ $totalRoom[0]->rate + $totalFoods[0]->price + $totalExtras[0]->price}}</span></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="collapsible expandable mb6">
                <li>
                    <div class="collapsible-header">
                        <i class="far fa-money-bill-alt"></i>Room Breakdown 
                        <a class="headerbtn printSummary tooltipped" data-tooltip="Print">
                            <i class="material-icons">print</i>
                        </a>
                    </div>
                    <div class="collapsible-body">
                        <ul class="room_breakdown">
                            @foreach($roombilling as $roombill)
                                <li>{{ $roombill->hours }} hrs <span class="right">&#8369; {{ $roombill->rate }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="collapsible expandable mb6">
                <li>
                    <div class="collapsible-header">
                        <i class="far fa-money-bill-alt"></i>Foods Breakdown 
                        <a class="headerbtn printSummary tooltipped" data-tooltip="Print">
                            <i class="material-icons">print</i>
                        </a>
                    </div>
                    <div class="collapsible-body">
                        <ul class="mx5">
                            <table class="addedTable">
                                <tbody>
                                    @foreach($addedfoods as $foods)
                                        <tr data-id="{{ $foods->id }}">
                                            <td>{{ $foods->menuName }}</td>
                                            <td class="teals-text">Quantity ( {{ $foods->quantity }} )</td>
                                            <td class="teals-text">&#8369;{{ $foods->quantity * $foods->sellingPrice }}</td>
                                            <td class="right-align">
                                                <a class="editCheckout tooltipped" data-tooltip="Edit">
                                                    <i class="far fa-edit ml20"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="collapsible expandable mb6">
                <li>
                    <div class="collapsible-header">
                        <i class="far fa-money-bill-alt"></i>Extras Breakdown 
                        <a class="headerbtn printSummary tooltipped" data-tooltip="Print">
                            <i class="material-icons">print</i>
                        </a>
                    </div>
                    <div class="collapsible-body">
                        <ul class="mx5">
                            <table class="addedTable">
                                <tbody>
                                    @foreach($addedextras as $extras)
                                        <tr data-id="{{ $extras->id }}">
                                            <td>{{ $extras->description }}</td>
                                            <td class="teals-text">Quantity ( {{ $extras->quantity }} )</td>
                                            <td class="teals-text">&#8369;{{ $extras->quantity * $extras->cost }}</td>
                                            <td class="right-align">
                                                <a class="editCheckout tooltipped" data-tooltip="Edit">
                                                    <i class="far fa-edit ml20"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col s12 m8 pull-m4">
            <ul class="collapsible expandable mb6">
                <li class="active">
                    <div class="collapsible-header"><i class="fas fa-users"></i>Guest Details
                        <a class="headerbtn viewGuest tooltipped" data-tooltip="View Details">
                            <i class="fas fa-external-link-square-alt"></i>
                        </a>
                    </div>
                    <div class="collapsible-body">
                        <ul>
                            <li>Name <span class="right">{{ $data->name }}</span></li>
                            <li>Contact <span class="right">{{ $data->contact }}</span></li>
                            <li>Company <span class="right">{{ $data->companyName }}</span></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="collapsible expandable mb6">
                <li class="active">
                    <div class="collapsible-header"><i class="far fa-calendar-check"></i>Check-in Details</div>
                    <div class="collapsible-body">
                        <ul>
                            <li>Check-in Date <span class="right">{{ date('F d, Y', strtotime($data->checkInDate)) }}</span></li>
                            <li>Check-in Time <span class="right">{{ date('g:i A', strtotime($data->checkInDate)) }}</span></li>
                            <li>Check-out Date 
                                <span class="right">{{ date('F d, Y', strtotime($data->checkOutDate)) }} 
                                    {{--  <a class="editCheckout tooltipped" data-tooltip="Edit">
                                        <i class="far fa-edit fa-lg ml10"></i>
                                    </a>  --}}
                                </span>
                            </li>
                            <li>Check-Out Time 
                                <span class="right">{{ date('g:i A', strtotime($data->checkOutDate)) }}
                                    {{--  <a class="editCheckout tooltipped" data-tooltip="Edit">
                                        <i class="far fa-edit fa-lg ml10"></i>
                                    </a>  --}}
                                </span>
                            </li>
                            {{--  <li>Remaining Time <span class="right">{{ date('H:i', strtotime($data->remaining_time)) }}</span></li>  --}}
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="collapsible expandable mb6">
                <li>
                    <div class="collapsible-header"><i class="fas fa-bed"></i>Room Details</div>
                    <div class="collapsible-body">
                        <ul>
                            <li>Room No <span class="right">{{ $data->roomNo }}</span></li>
                            <li>Room Type <span class="right">{{ $data->type }}</span></li>
                            <li>Penalty Rate\Hour <span class="right">{{ $data->rateperhour }}</span></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="collapsible expandable mb6">
                <li>
                    <div class="collapsible-header"><i class="fas fa-utensils"></i></i>Add Foods</div>
                    <div class="collapsible-body">
                        <ul class="foodList">
                            {{--  @foreach($foodlist as $foods)
                                <li data-id="{{ $foods->id }}">{{ $foods->menuName }} 
                                    <span class="right">&#8369;{{ $foods->sellingPrice }} 
                                        <a href="" class="addbtn ml30 tooltipped" data-tooltip="Add {{ $foods->menuName }}">
                                            <i class="far fa-plus-square fa-lg"></i>
                                        </a> 
                                    </span>
                                </li>
                            @endforeach  --}}
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="collapsible expandable mb6">
                <li>
                    <div class="collapsible-header"><i class="fab fa-ethereum"></i></i>Add Extras</div>
                    <div class="collapsible-body">
                        <ul class="ExtrasList">
                            {{--  @foreach($extraslist as $extras)
                                <li data-id="{{ $extras->id }}">{{ $extras->description }} 
                                    <span class="right">&#8369;{{ $extras->cost }} 
                                        <a href="" class="addbtn ml30 tooltipped" data-tooltip="Add {{ $extras->description }}">
                                            <i class="far fa-plus-square fa-lg"></i>
                                        </a> 
                                    </span>
                                </li>
                            @endforeach  --}}
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div id="ChooseHoursModal" class="modal">
        <div class="modal-content">
            <div class="row">
                <div class="col m12 s12">
                    <h4>Choose No. of Hours</h4>
                </div>    
            </div>
            @foreach($roomRates as $rate)
                <p class="pl11">
                    <label class="mr20">
                        <input id="roomRate" name="roomRate" data-id="{{ $rate->id }}" value="{{ $rate->hours }}" class="with-gap" name="group3" type="radio" checked/>
                        <span class="mr10">Hours: {{ $rate->hours }}</span>
                        <span>Rate: &#8369 {{ $rate->rate }}</span>
                    </label>
                </p>
            @endforeach
        </div>
        <div class="modal-footer">
            <a href="#!"  class="modal-close waves-effect waves-green btn btn-1">
                Cancel
            </a>
            <button class="modal-close waves-effect waves-green btn btn-1 update_hours">
                Confirm
            </button>
        </div>
    </div>
    <div id="addFoodsExtrasModal" class="modal">
        <div class="row mb0">
            <div class="col m12 s12">
                <h4 class="pt20"></h4>
                <div class="input-field col s12 mt25">
                    <input data-count="" placeholder="" data-id="" data-type="" id="something_quantity" type="number" class="validate">
                    <label for="something_quantity"></label>
                </div>
            </div>    
        </div>
        <div class="modal-footer">
            <a href="#!"  class="modal-close waves-effect waves-green btn btn-1">
                Cancel
            </a>
            <button class="modal-close waves-effect waves-green btn btn-1 add_something">
                Confirm
            </button>
        </div>
    </div>
</div>
@endsection

@section('pagejs')
<script src="{{ asset('/js/pages/CheckinStatus/index.js') }}"></script>
@stop