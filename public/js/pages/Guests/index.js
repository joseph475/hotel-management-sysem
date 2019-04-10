$(document).ready(loadGuests(curpage));

function loadGuests(curpage) {
    sessionStorage.setItem("curpage", curpage);
    $.ajax({
        url: 'api/Guests',
        data:{
            page: curpage  
        },
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopGuestDetails(data.data);
            $.getScript("js/pagination.js", function () {  // load pagination
                createPagination(data.last_page, "loadGuests");
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
            companyName = data[i].companyName,
            companyAddress = data[i].companyAddress
        $('#guestTable').append(createGuestTable(roomNo, name, contact, companyName, checkin_id));
    }
}

function createGuestTable(roomNo, name, contact, companyName, checkin_id) {
    companyName = (companyName == null)? "" : companyName;
    contact = (contact == null)? "" : contact;
    var myGuest = '<tr data-id='+ checkin_id +'>' +
        '<td>' + name + '</td>' +
        '<td>' + contact + '</td>' +
        '<td>' + companyName + '</td>' +
        '<td>' + roomNo + '</td>' +
        '<td>' +
            '<a href="Checkin-status/'+ checkin_id +'" class="btn btn-flat btn-2"><i class="material-icons left">input</i>View</a>' +
        '</td>' +
        '</tr>'
    return myGuest;
}



