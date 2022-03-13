<ul id="slide-out" class="sidenav sidenav-fixed">
    <li>
        <div class="user-view">
            <a><img class="circle" src="{{ url('/images/account4.png') }}"></a>
            <p class="name">
                <span class="user">Joseph
                    <i class="tiny material-icons">arrow_drop_down</i>
                </span><br>
                Administrator
            </p>
        </div>
    </li>
    <li><a href="{{ url('/') }}"><i class="material-icons">dashboard</i>Dashboard</a></li>
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header dropdownArr"><i class="material-icons">event_note</i>Reservations<i class="material-icons right arrow">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="" href="{{ url('/AddReservation') }}"><i class="material-icons">assignment</i>Make a Reservation</a></li>
                </ul>
                <ul>
                    <li><a class="" href="{{ url('/PendingReservationList') }}"><i class="material-icons">cached</i>Pending Reservations</a></li>
                </ul>
                <ul>
                    <li><a class="" href="{{ url('/CheckinReservation') }}"><i class="material-icons">import_contacts</i>Checkin Reservations</a></li>
                </ul>
            </div>
        </li>
    </ul>
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header dropdownArr"><i class="material-icons">face</i>Guests<i class="material-icons right arrow">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="modal-trigger" href="{{ url('/Guests') }}"><i class="material-icons">group</i>Guest List</a></li>
                </ul>
                <ul>
                    <li><a class="modal-trigger" href="{{ url('/ArchivedGuest') }}"><i class="material-icons">storage</i>Archived Guest</a></li>
                </ul>
            </div>
        </li>
    </ul>
    <li><a href="{{ url('/UpcomingCheckout') }}"><i class="material-icons left">event_available</i>Upcoming Checkouts</a></li>
    
    <li><a href="{{ url('/RoomManagement') }}"><i class="material-icons">hotel</i>Room Management</a></li>

        <ul class="collapsible collapsible-accordion">
        <!-- settings -->
            <li>
                <a class="collapsible-header dropdownArr"><i class="fas fa-cogs"></i>Manage<i class="material-icons right arrow">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul> 
                        <li><a href="{{ url('/Rooms') }}"><i class="material-icons left">hotel</i>Rooms</a></li>
                        <li><a href="{{ url('/RoomTypes') }}"><i class="material-icons left">weekend</i>Room Types</a></li>
                        <li><a href="{{ url('/Kitchen') }}"><i class="material-icons left">restaurant_menu</i>Food Menus</a></li>
                        <li><a href="{{ url('/InventoryList') }}"><i class="material-icons left">storage</i>Inventory List</a></li>
                        <li><a href="{{ url('/Extras') }}"><i class="material-icons left">filter_vintage</i>Extras</a></li>
                        <li><a href="{{ url('/Extras') }}"><i class="material-icons left">money_off</i>Discounts</a></li>
                        <li><a href="accounts.php"><i class="material-icons">supervisor_account</i>Accounts</a></li>
                    </ul>
                </div>
            </li>
        <!-- reports -->
            <li>
                <a class="collapsible-header dropdownArr"><i class="material-icons">insert_chart</i>Reports<i class="material-icons right arrow">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="../api/Guests/Report" target="_blank"><i class="material-icons">assignment_ind</i>Guest Masterlist</a></li>
                        <li><a href="{{ url('/Collections') }}"><i class="material-icons">attach_money</i>Collections</a></li>
                        <li><a href="{{ url('/InventoryStatus') }}"><i class="material-icons">storage</i>Room Inventory Report</a></li>
                        {{--  window.open("../api/Guests/Report");  --}}
                    </ul>
                </div>
            </li>
        </ul>

    <li><a href="logout.php"><i class="material-icons left">exit_to_app</i>Log Out</a></li>
</ul> 
