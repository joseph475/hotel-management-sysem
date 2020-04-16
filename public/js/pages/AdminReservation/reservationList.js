var mytable = $('#ReservationListTable');
var roomListUl = $('#roomListUl');

$(document).ready(loadReservationList(curpage));
$(document).on('click','.openReservationModal', openReservationModal);
$(document).on('click','#reserveRoom', reserveRoom);
$(document).on('click','.deleteReservation', deleteReservation);


function loadReservationList(curpage) {
    $.ajax({
        url: 'api/AdminReservationList',
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
    var dataLength = data.length;
    mytable.html("");

    if(dataLength > 0){
        for (var i = 0; i < dataLength; i++) {
            var id =  data[i].id,
                guest_name = data[i].name
                personal_id = data[i].personal_id,
                personal_id_type = data[i].personal_id_type,
                roomtype = data[i].type,
                roomtype_id = data[i].roomTypeId,
                mobile = data[i].mobile,
                email = data[i].email,
                checkInDate = data[i].checkInDate,
                // compName = (data[i].compName == null) ? '' : data[i].compName,
                // compAddress = (data[i].compAddress == null) ? '' : data[i].compAddress,
                mytable.append(createTable(id, guest_name, personal_id, personal_id_type, roomtype, mobile, checkInDate, roomtype_id));
        }
    }
    else{
        mytable.append('<tr><td colspan="6" style="text-align:center;" class="grey lighten-3">No Reservations Available</td></tr>');
    }
}

function createTable(id, guest_name, personal_id, personal_id_type, roomtype, mobile, checkInDate, roomtype_id) {
    var checkInDate = parseDate(checkInDate, '-');
    var today = new Date();
    var isWarning = checkdatediff(today, checkInDate) < 3 ? true : false;
    var trClass = (isWarning)? 'Warning' : '';
    today = today.toLocaleDateString("en-US");
    checkInDate = checkInDate.toLocaleDateString("en-US");

    var myReservation = '<tr class="" data-id="'+ id +'">' +
            '<td>' + guest_name + '</td>' +
            '<td>' + personal_id_type + " ("+ personal_id +")" + '</td>' +
            '<td>' + roomtype + '</td>' +
            '<td>' + mobile + '</td>' +
            '<td>' + checkInDate + '</td>' +
            '<td class="actionButtons">' +
                '<a class="btn-floating btn btn-float '+ trClass +' btn-flat mr5 openReservationModal modal-trigger" data-roomTypeId='+ roomtype_id +' href="#RoomList"><i class="fas fa-sign-in-alt"></i></a>' +
                '<a class="btn-floating btn btn-float '+ trClass +' btn-flat mr5 deleteReservation"><i class="far fa-trash-alt"></i></a>' +
            '</td>' +
        '</tr>'
    return myReservation;
}

function openReservationModal(){
    var roomTypeId = $(this).attr('data-roomTypeId');
    var reservationId = $(this).closest('tr').attr('data-id');

    $.ajax({
        url: 'api/AdminReservationList/getAvailableRooms',
        data:{
            roomTypeId: roomTypeId 
        },
        type: 'get',
        dataType: 'json',
        success: function (data) {
            var template = "";
            var availableRoomsLength = data.availableRooms.length;

            if(availableRoomsLength > 0){
                roomListUl.html('<li class="collection-header mycollection-header"><h4>Select Room</h4></li>');

                for (var i = 0; i < availableRoomsLength; i++) {
                    template += '<li class="collection-item mycollection" data-reservationId="'+ reservationId +'" data-roomId ="'+ data.availableRooms[i].roomNo +'">' +
                                    '<div class="custom-collection">' +
                                        '<div>Room#' +
                                            '<span>'+ data.availableRooms[i].roomNo +'</span>' +
                                        '</div>' +
                                        '<a href="#!" class="secondary-content btn btn-2 modal-close" id="reserveRoom">'+
                                            '<i class="material-icons left">send</i>Reserve' +
                                        '</a>' +
                                    '</div>' +
                                '</li>';
                }
                roomListUl.append(template);
            }
            else{
                roomListUl.html('<li class="collection-header"><h4>No Vacant Room for this Room Type</h4></li>');
            }            
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function reserveRoom(){
    var reservationId = $(this).closest('li').attr('data-reservationId');
    var roomId = $(this).closest('li').attr('data-roomId');
    var rate_id = $('#rate_id').val();

    $.ajax({
        url: '../api/AdminReservationList/reserve',
        type: 'PUT',
        data: {
            reservationId: reservationId,
            roomId: roomId,
            rate_id: rate_id
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
                    url: '../api/AdminReservationList/cancelPendingReservation',
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
