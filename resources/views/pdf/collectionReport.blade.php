<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            .page-break {page-break-after: always;}
            *{ font-size: 12px; }
            .bold {  font-weight: 600; font-size:22px;} 
            .break-table td, .break-table th{
                padding: 5px;
            }
            .break-table th{ font-size:12px; }
            body {
                font-family: DejaVu Sans;
            }
        </style>
    </head>
    <body>
        <h4 style="margin: 0;">{{ $variables['hotel'] }}</h4>
        <p style="margin: 5px 0 15px 0;">{{ $variables['address'] }}</p>
        <hr>

        @if($type == "daily")
            <p style="margin: 0;">Date: {{ date('M d, Y', strtotime($dateFrom)) }}</p>
        @else
            <p style="margin: 0;">Date: {{ date('M d, Y', strtotime($dateFrom)) }} &#8212; {{ date('M d, Y', strtotime($dateTo)) }}</p>
        @endif

        @if ($total_collections[0]->total > 0)
            <p style="margin: 5px 0;">Total Collection: &#8369;{{ number_format($total_collections[0]->total) }}</p>
        @endif
        <hr>

        <h1 style="font-size:15px; margin:20px 0;">Collections</h1>

        @if (count($collections) > 0)
            <table class="break-table" style="width: 100%; border-collapse: collapse;" border="1">
                <tr>
                    <th rowspan="2" style="width: 30%">OR Number</th>
                    <th rowspan="2" style="width: 30%; text-align: center;">Date Collected</th>
                    <th colspan="3" style="width: 40%; text-align: center;">Collection</th>
                </tr>
                <tr>
                    <th style="width: 30%; text-align: center;">Room</th>
                    <th style="width: 35%; text-align: center;">Others</th>
                    <th style="width: 35%; text-align: center;">Total</th>
                </tr>
                @foreach($collections as $collection)
                <tr>
                    <td style="text-indent: 20px;">{{ $collection->ORNumber }}</td>
                    <td style="text-align: center;">{{ date('M d, Y', strtotime($collection->date_collected)) }}</td>
                    <td style="text-align: right;">&#8369;{{ number_format($collection->room) }}</td>
                    <td style="text-align: right;">&#8369;{{ number_format($collection->others) }}</td>
                    <td style="text-align: right;">&#8369;{{ number_format($collection->collection) }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" style="text-align: right">Total</td>
                    <th style="text-align: right;">&#8369;{{ number_format($total_collections[0]->total) }}</td>
                </tr>
            </table>
        @endif
    </body>
</html>