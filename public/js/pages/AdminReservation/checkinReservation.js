var mytable = $('#ReservationListTable');
$(document).ready(loadReservationList(curpage));
$(document).on('click','#checkInReservation', reserveRoom);
$(document).on('click','.deleteReservation', deleteReservation);

function loadReservationList(curpage, search = '') {
    $.ajax({
        url: 'api/AdminReservationList/getReservedRooms',
        data:{
            page: curpage,
            search: search 
        },
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopDetails(data.data);
            $.getScript("js/pagination.js", function () {  // load pagination
                createPagination(data.last_page, "loadReservationList", search);
                $('#page_' + curpage).addClass("activePage");
            });
            
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
};

function loopDetails(data) {
    var dataLength = data.length;
    mytable.html("");

    if(dataLength > 0){
        for (var i = 0; i < dataLength; i++) {
            var id =  data[i].id,
                guest_name = data[i].name
                roomNo = data[i].roomNo
                roomtype = data[i].type,
                rate_id = data[i].rate_id,
                duration = data[i].hours,
                mobile = data[i].mobile,
                days = data[i].days;

                duration = (parseInt(duration) === 24)? days + " days" : duration + " hrs";
                mytable.append(createTable(id, guest_name, roomNo, roomtype, mobile, rate_id, duration));
        }
    }
    else{
        mytable.append('<tr><td colspan="6" style="text-align:center;" class="grey lighten-3">No Reservations Available</td></tr>');
    }
}

function createTable(id, guest_name, roomNo, roomtype, mobile, rate_id, duration) {

    var myReservation = '<tr data-id="'+ id +'" data-rateId="'+ rate_id +'" >' +
            '<td>' + guest_name + '</td>' +
            '<td>' + roomNo + '</td>' +
            '<td>' + roomtype + '</td>' +
            '<td>' + duration + '</td>' +
            '<td>' + mobile + '</td>' +
            '<td class="actionButtons">' +
                '<a class="btn btn-2 btn-flat mr5" id="checkInReservation"><i class="fas fa-sign-in-alt"></i></a>' +
                '<a class="btn btn-2 btn-flat mr5 deleteReservation"><i class="far fa-trash-alt"></i></a>' +
            '</td>' +
        '</tr>'
    return myReservation;
}

function reserveRoom(){
    var reservationId = $(this).closest('tr').attr('data-id');
    
    $.ajax({
        url: '../api/AdminReservationList/checkInReservation',
        type: 'POST',
        data: {
            reservationId: reservationId
        },
        dataType: 'json',
        success: function (data) {
            M.toast({html: 'Saving Pls. Wait!!!'});
            window.location = "/";
        },
        error: function (aaa, bbb, ccc) { console.log(aaa); }
    });
}

function deleteReservation(){
    var reservationId = $(this).closest('tr').attr('data-id');
    
    $.confirm({
        title: 'Cancel Reservation?',
        buttons: {
            cancel: function () { },
            confirm: function () { 
                $.ajax({
                    url: '../api/AdminReservationList/cancelForCheckinReservation',
                    type: 'PUT',
                    data: {
                        reservationId: reservationId
                    },
                    dataType: 'json',
                    success: function (data) {
                        M.toast({html: 'Saving Pls. Wait!!!'});
                        location.reload();
                    },
                    error: function (aaa, bbb, ccc) { console.log(aaa); }
                });
            }
        }
    });
}
