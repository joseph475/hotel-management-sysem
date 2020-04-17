$(document).ready(loadArchivedGuests(curpage));

function loadArchivedGuests(curpage, search = '') {
    sessionStorage.setItem("curpage", curpage);
    $.ajax({
        url: 'api/ArchivedGuests',
        data:{
            page: curpage,
            search: search  
        },
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopGuestDetails(data.data);
            $.getScript("js/pagination.js", function () {  // load pagination
                createPagination(data.last_page, "loadArchivedGuests");
                $('#page_' + curpage).addClass("activePage");
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
};

function loopGuestDetails(data) {
    $('#guestTable').html("");
    for (var i = 0; i < data.length; i++) {
        var roomNo = data[i].roomNo,
            checkin_id = data[i].checkin_id,
            name = data[i].name,
            contact = data[i].contact,
            checkinDate = data[i].checkInDate
            checkoutDate = data[i].actual_checkout
        $('#guestTable').append(createGuestTable(roomNo, name, contact, checkin_id, checkinDate, checkoutDate));
    }
}

function createGuestTable(roomNo, name, contact, checkin_id, checkinDate, checkoutDate) {
    contact = (contact == null)? "" : contact;
    var myGuest = '<tr data-id='+ checkin_id +'>' +
        '<td>' + name + '</td>' +
        '<td>' + contact + '</td>' +
        '<td>' + roomNo + '</td>' +
        '<td>' + checkinDate + '</td>' +
        '<td>' + checkoutDate + '</td>' +
        '</tr>'
    return myGuest;
}



