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
            <a class="collapsible-header"><i class="material-icons">event_note</i>Reservations<i class="material-icons right">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="" href="bookReservation.php"><i class="material-icons">assignment</i>Book Reservation</a></li>
                </ul>
                <ul>
                    <li><a class="" href="reservationList.php"><i class="material-icons">list</i>Reservation List</a></li>
                </ul>
            </div>
        </li>
    </ul>
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header"><i class="material-icons">face</i>Guests<i class="material-icons right">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="modal-trigger" href="{{ url('/Guests') }}"><i class="material-icons">group</i>Guest List</a></li>
                </ul>
                <ul>
                    <li><a class="modal-trigger" href="guestArchived.php"><i class="material-icons">storage</i>Archived Guest</a></li>
                </ul>
            </div>
        </li>
    </ul>
    <li><a href="nextCheckout.php"><i class="material-icons left">event_available</i>Upcoming Checkouts</a></li>
    
    <li><a href="{{ url('/RoomManagement') }}"><i class="material-icons">hotel</i>Room Management</a></li>

   
        <ul class="collapsible collapsible-accordion">
        <!-- settings -->
            <li>
                <a class="collapsible-header"><i class="material-icons">settings</i>Manage<i class="material-icons right">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul>  
                        <li><a href="{{ url('/Rooms') }}"><i class="material-icons left">hotel</i>Rooms</a></li>
                        <li><a href="{{ url('/RoomTypes') }}"><i class="material-icons left">weekend</i>Room Types</a></li>
                        <li><a href="{{ url('/Kitchen') }}"><i class="material-icons left">restaurant_menu</i>Food Menus</a></li>
                        <li><a href="extras.php"><i class="material-icons left">dns</i>Extras</a></li>
                        <li><a href="accounts.php"><i class="material-icons">supervisor_account</i>Accounts</a></li>
                    </ul>
                </div>
            </li>
        <!-- reports -->
            <li>
                <a class="collapsible-header"><i class="material-icons">insert_chart</i>Reports<i class="material-icons right">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="collections.php"><i class="material-icons">attach_money</i>Collections</a></li>
                        <li><a href="#"><i class="material-icons">attach_money</i>Expenses</a></li>
                    </ul>
                </div>
            </li>
        </ul>

    <li><a href="logout.php"><i class="material-icons left">exit_to_app</i>Log Out</a></li>
</ul> 
