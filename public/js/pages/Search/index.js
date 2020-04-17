$(document).on('click', '#searchbtn', search);

$('input[name="search"]').keypress(function (e) {
    var key = e.which;
    if (key == 13) { search(); }
});

function search() {
    let page_title = $('.page-title').attr('page-title');
    let search = $('input[name="search"]').val();

    switch (page_title) {
        case 'Dashboard':
            loadRoomCards(1, search);
            break;
        case 'Pending Reservations':
            loadReservationList(1, search);
            break;
        case 'Checkin Reservation':
            loadReservationList(1, search);
            break;
        case 'Guest Masterlist':
            loadGuests(1, search);
            break;
        case 'Archived Guest Masterlist':
            loadArchivedGuests(1, search);
            break;
        case 'Room Management':
            loadRooms(1, search);
            break;
        case 'Manage Rooms':
            loadRooms(1, search);
            break;
        case 'Manage Room Types':
            loadRoomTypes(1, search);
            break;
        case 'Manage Food Menu':
            loadFoods(1, search);
            break;
        case 'Manage Inventory List':
            loadInventoryList(1, search);
            break;
        case 'Manage Extras':
            loadExtras(1, search);
            break;
    }
}