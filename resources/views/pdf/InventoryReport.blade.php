<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            .page-break {page-break-after: always;}
            *{ font-size: 12px; }
            .bold {  font-weight: 600;}
            .break-table td, .break-table th{
                padding: 5px;
            }
            .break-table th{ font-size:12px; }
            body {
                font-family: DejaVu Sans;
            }
            .gray{
                background-color: #c0c0c0;
            }
        </style>
    </head>
    <body>
        <h4 style="margin: 0;">{{ $variables['hotel'] }}</h4>
        <p style="margin: 5px 0 15px 0;">{{ $variables['address'] }}</p>
        <hr>

        <h1 style="font-size:15px; margin:20px 0;">Inventory Status</h1>

        @php
            $roomno = '';
        @endphp

        @if (count($inventoryStatus) > 0)
            <table class="break-table" style="width: 100%; border-collapse: collapse;" border="1">
                <tr>
                    <th style="width: 40%"></th>
                    <th style="width: 20%; text-align: center;">Good</th>
                    <th style="width: 20%; text-align: center;">Damaged</th>
                    <th style="width: 20%; text-align: center;">Missing</th>
                </tr>
                @foreach($inventoryStatus as $item)
                @if($roomno != $item->room_id)
                    <tr>
                        <td colspan="4" class="bold gray">Room {{ $item->room_id }}</td>
                    </tr>
                    @php
                        $roomno = $item->room_id;
                    @endphp
                @endif
                    @if( $item->good > 0 ||  $item->damaged > 0 || $item->missing > 0)
                        <tr>
                            <td style="text-indent:20px;">{{ $item->description }}</td>
                            <td style="text-align: center;">{{ $item->good }}</td>
                            <td style="text-align: center;">{{ $item->damaged }}</td>
                            <td style="text-align: center;">{{ $item->missing }}</td>
                        </tr>
                    @endif
                @endforeach
                {{--  <tr>
                    <th colspan="2">Total</td>
                    <th style="text-align: right;">&#8369;{{ number_format($total_collections[0]->total) }}</td>
                </tr>  --}}
            </table>
        @endif
    </body>
</html>