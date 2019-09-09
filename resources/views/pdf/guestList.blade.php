<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            .page-break {page-break-after: always;}
            *{ font-size: 12px; }
            .bold {  font-weight: 600; font-size:22px;} 
            .title { font-weight: 600; font-size:18px; }
            .break-table td, .break-table th{
                padding: 5px;
            }
            body {
                font-family: DejaVu Sans;
            }
        </style>
            
    </head>
    <body>
        <h4 style="margin: 0;">{{ $variables['hotel'] }}</h4>
        <p style="margin: 5px 0 15px 0;">{{ $variables['address'] }}</p>
        <hr>
        <h3 class="title" style="margin-bottom: 5px;">Guest List</h3>
        <span style="font-weight: normal; margin-bottom:3px;">({{ date("M d, Y") }})</span>
        
        <table class="break-table" style="width: 100%; border-collapse: collapse; margin-top:5px;" border="1">
            <tr>
                <th style="width: 20%">Name</th>
                <th style="width: 9%; text-align:center">Room #</th>
                <th style="width: 10%;">Contact</th>
                <th style="width: 15%;">Room Type</th>
                <th style="width: 5%; text-align:center">Adults</th>
                <th style="width: 5%; text-align:center">Children</th>
                <th style="width: 18%; text-align:center">Checkin</th>
                <th style="width: 18%; text-align:center">Checkout</th>
            </tr>
            @foreach($guests as $guest)
              <tr>
                    <td>{{ $guest->name }}</td>
                    <td style="text-align:center">{{ $guest->roomNo }}</td>
                    <td>{{ $guest->contact }}</td>
                    <td>{{ $guest->type }}</td>
                    <td style="text-align:center">{{ $guest->adultsCount }}</td>
                    <td style="text-align:center">{{ $guest->childrenCount }}</td>
                    <td style="text-align:center">{{ $guest->checkInDate }}</td>
                    <td style="text-align:center">{{ $guest->checkOutDate }}</td>
              </tr>
            @endforeach
        </table>
    </body>
</html>