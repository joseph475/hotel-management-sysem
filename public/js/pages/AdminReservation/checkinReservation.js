var mytable = $('#ReservationListTable');
$(document).ready(loadReservationList(curpage));

// $(document).on('click','#reserveRoom', reserveRoom);

function loadReservationList(curpage) {
    $.ajax({
        url: 'api/AdminReservationList/getReservedRooms',
        data:{
            page: curpage  
        },
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopDetails(data.data);
            $.getScript("js/pagination.js", function () {  // load pagination
                createPagination(data.last_page, "loadReservationList");
                $('#page_' + curpage).addClass("activePage");
            });
            
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
};

function loopDetails(data) {
    mytable.html("");
    for (var i = 0; i < data.length; i++) {
        var id =  data[i].id,
            guest_name = data[i].name
            roomNo = data[i].roomNo
            roomtype = data[i].type,
            roomtype_id = data[i].roomTypeId,
            mobile = data[i].mobile,
            mytable.append(createTable(id, guest_name, roomNo, roomtype, mobile, roomtype_id));
    }
}

function createTable(id, guest_name, roomNo, roomtype, mobile, roomtype_id) {

    var myReservation = '<tr class="" data-id="'+ id +'">' +
            '<td>' + guest_name + '</td>' +
            '<td>' + roomNo + '</td>' +
            '<td>' + roomtype + '</td>' +
            '<td>' + mobile + '</td>' +
            '<td>' +
                '<a class="btn btn-2 btn-flat mr5 openReservationModal modal-trigger" data-roomTypeId='+ roomtype_id +' href="#RoomList"><i class="fas fa-sign-in-alt"></i></a>' +
                '<a class="btn btn-2 btn-flat mr5 deleteExtra"><i class="far fa-trash-alt"></i></a>' +
            '</td>' +
        '</tr>'
    return myReservation;
}

function reserveRoom(){
    // var reservationId = $(this).closest('li').attr('data-reservationId');
    // var roomId = $(this).closest('li').attr('data-roomId');

    // $.ajax({
    //     url: '../api/AdminReservationList/reserve',
    //     type: 'PUT',
    //     data: {
    //         reservationId: reservationId,
    //         roomId: roomId
    //     },
    //     dataType: 'json',
    //     success: function (data) {
    //         M.toast({html: 'Saving Pls. Wait!!!'});
    //         location.reload();
    //     },
    //     error: function (aaa, bbb, ccc) { console.log(aaa); }
    // });
}
