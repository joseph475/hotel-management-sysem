<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            .page-break {page-break-after: always;}
            *{ font-size: 14px; }
            .bold {  font-weight: 600; font-size:22px;} 
            .break-table td, .break-table th{
                padding: 5px;
            }
        </style>
            
    </head>
    <body>
        <h4 style="margin: 0;">{{ $variables['hotel'] }}</h4>
        <p style="margin: 5px 0 15px 0;">{{ $variables['address'] }}</p>
        <hr>
        <table style="width:100%;">
            <tr>
                <td style="width: 15%">Guest: </td>
                <td style="width: 35%">{{ $info[0]->name }}</td>
                <td style="width: 10%">Or #: </td>
                <td style="width: 30%">{{ $info[0]->ORNumber }}</td>
            </tr>
            <tr>
                <td style="width: 15%">Room #: </td>
                <td style="width: 45%">{{ $info[0]->roomNo }}</td>
                <td style="width: 10%">Checkin: </td>
                <td style="width: 30%">{{ date("M d, Y h:i A", strtotime($info[0]->checkInDate) ) }}</td>             
            </tr>
            <tr>
                <td style="width: 15%">Type: </td>
                <td style="width: 45%">{{ $info[0]->type }}</td>
                <td style="width: 10%">Checkout: </td>
                <td style="width: 30%">{{ date("M d, Y h:i A") }}</td>
            </tr>
            <tr>
                <td style="width: 15%">Contact #: </td>
                <td style="width: 45%">{{ $info[0]->contact }}</td>
                <td style="width: 10%">Total: </td>
                <td style="width: 30%; font-weight: 600;">{{ number_format($grandTotal) }}</td>
            </tr>
        </table>

        <hr>

        <h3 style="margin-bottom: 10px;">Room Fees</h3>
        <table class="break-table" style="width: 100%; border-collapse: collapse;" border="1">
            <tr>
                <th style="width: 70%">Hours</th>
                <th style="width: 30%; text-align:center;">Rate</th>
            </tr>
            @foreach($rooms as $room)
              <tr>
                  <td>{{ number_format($room->hours) }}</td>
                  <td style="text-align: right;">{{ number_format($room->rate) }}</td>
              </tr>
            @endforeach
            <tr>
                <th>Total</td>
                <th style="text-align: right;">{{ number_format($totalRoom[0]->rate) }}</td>
            </tr>
        </table>

        @if (count($foods) > 0)
            <h3 style="margin-bottom: 10px;">Foods Breakdown</h3>
            <table class="break-table" style="width: 100%; border-collapse: collapse;" border="1">
                <tr>
                    <th style="width: 55%">Name</th>
                    <th style="width: 15%; text-align: center;">Quanity</th>
                    <th style="width: 30%; text-align: center;">Cost</th>
                </tr>
                @foreach($foods as $food)
                <tr>
                    <td>{{ $food->menuName }}</td>
                    <td style="text-align: center;">{{ $food->quantity }}</td>
                    <td style="text-align: right;">{{ number_format($food->sellingPrice * $food->quantity) }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="2">Total</td>
                    <th style="text-align: right;">{{ number_format($totalFoods[0]->price) }}</td>
                </tr>
            </table>
        @endif
        
        @if (count($extras) > 0)
            <h3 style="margin-bottom: 10px;">Extras Breakdown</h3>
            <table class="break-table" style="width: 100%; border-collapse: collapse;" border="1">
                <tr>
                    <th style="width: 55%">Name</th>
                    <th style="width: 15%; text-align: center;">Quanity</th>
                    <th style="width: 30%; text-align: center;">Cost</th>
                </tr>
                @foreach($extras as $extra)
                <tr>
                    <td>{{ $extra->description }}</td>
                    <td style="text-align: center;">{{ $extra->quantity }}</td>
                    <td style="text-align: right;">{{ number_format($extra->cost * $extra->quantity) }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="2">Total</td>
                    <th style="text-align: right;">{{ number_format($totalExtras[0]->price) }}</td>
                </tr>
            </table>
        @endif
    </body>
</html>