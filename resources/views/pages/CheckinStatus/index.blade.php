@extends('layouts.app')

@section('content')
<div class="row checkin-status-page">
    <div id="page-header">
        <div class="page-title">Checkin Status</div>
        <div class="page-buttons">
            <div class="button-content">
                <a class="btn btn-1" href="/">
                    <i class="material-icons left">arrow_back</i>
                    Back
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
                            <li>Room <span class="right">&#8369;5000</span></li>
                            <li>Food <span class="right">&#8369;1000</span></li>
                            <li>Extras <span class="right">&#8369;500</span></li>
                            <li>Total <span class="right">&#8369;6500</span></li>
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
                        <ul>
                            <li>Room <span class="right">&#8369;5000</span></li>
                            <li>Food <span class="right">&#8369;1000</span></li>
                            <li>Extras <span class="right">&#8369;500</span></li>
                            <li>Total <span class="right">&#8369;6500</span></li>
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
                        <ul>
                            <li>Room <span class="right">&#8369;5000</span></li>
                            <li>Food <span class="right">&#8369;1000</span></li>
                            <li>Extras <span class="right">&#8369;500</span></li>
                            <li>Total <span class="right">&#8369;6500</span></li>
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
                        <ul>
                            <li>Room <span class="right">&#8369;5000</span></li>
                            <li>Food <span class="right">&#8369;1000</span></li>
                            <li>Extras <span class="right">&#8369;500</span></li>
                            <li>Total <span class="right">&#8369;6500</span></li>
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
                            <li>Check-out Date <span class="right">{{ date('F d, Y', strtotime($data->checkOutDate)) }} <a class="editCheckout tooltipped" data-tooltip="Edit"><i class="far fa-edit pl5"></i></a></span></li>
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
                            <li>Rate <span class="right">{{ $data->rate }}</span></li>
                            <li>Rate\Hour <span class="right">{{ $data->rateperhour }}</span></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="collapsible expandable mb6">
                <li>
                    <div class="collapsible-header"><i class="fas fa-utensils"></i></i>Add Foods</div>
                    <div class="collapsible-body">
                        <ul>
                            <li>Room No <span class="right">{{ $data->roomNo }}</span></li>
                            <li>Room Type <span class="right">{{ $data->type }}</span></li>
                            <li>Rate <span class="right">{{ $data->rate }}</span></li>
                            <li>Rate\Hour <span class="right">{{ $data->rateperhour }}</span></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="collapsible expandable mb6">
                <li>
                    <div class="collapsible-header"><i class="fab fa-ethereum"></i></i>Add Extras</div>
                    <div class="collapsible-body">
                        <ul>
                            <li>Room No <span class="right">{{ $data->roomNo }}</span></li>
                            <li>Room Type <span class="right">{{ $data->type }}</span></li>
                            <li>Rate <span class="right">{{ $data->rate }}</span></li>
                            <li>Rate\Hour <span class="right">{{ $data->rateperhour }}</span></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('pagejs')
<script src="{{ asset('/js/pages/CheckinStatus/index.js') }}"></script>
@stop