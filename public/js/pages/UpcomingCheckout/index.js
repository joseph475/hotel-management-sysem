var mytable = $('#CheckoutTable');

$(document).ready(loadCheckouts(curpage));

function loadCheckouts(curpage, search = '') {
    $.ajax({
        url: 'api/UpcomingCheckouts',
        data:{
            page: curpage,
            search: search  
        },
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopCheckoutDetails(data.data);
            $.getScript("js/pagination.js", function () {  // load pagination
                createPagination(data.last_page, "loadCheckouts", search);
                $('#page_' + curpage).addClass("activePage");
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
};

function loopCheckoutDetails(data) {
    mytable.html("");
    for (var i = 0; i < data.length; i++) {
        var checkin_id = data[i].checkin_id
            roomNo = data[i].roomNo,
            guestName = data[i].name,
            contact = data[i].contact,
            checkInDate = data[i].checkInDate,
            checkOutDate = data[i].checkOutDate
            mytable.append(createCheckoutTable(checkin_id, roomNo, guestName, contact,checkInDate,checkOutDate));
    }
}

function createCheckoutTable(checkin_id, roomNo, guestName, contact, checkInDate, checkOutDate) {
    var d = new Date(checkOutDate);
    var time = formatAMPM(d);
    var date1 = format_date(d);

    var myCheckout = '<tr data-id="'+ checkin_id +'">' +
            '<td>' + roomNo + '</td>' +
            '<td>' + guestName + '</td>' +
            '<td>' + contact + '</td>' +
            '<td>' + date1 + '</td>' +
            '<td>' + time + '</td>' +
            '<td class="actionButtons">' +
                '<a href="Checkin-status/'+ checkin_id +'" class="btn btn-flat btn-2"><i class="material-icons">input</i></a>' +
            '</td>' +
        '</tr>'
    return myCheckout;
}

