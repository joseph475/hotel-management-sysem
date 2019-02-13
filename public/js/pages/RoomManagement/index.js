var mytable = $('#roomTable');

$(document).ready(loadRooms(curpage));
$(document).on('click','.changestatus' , changeStatus );

function loadRooms(curpage) {
    sessionStorage.setItem("curpage", curpage);
    $.ajax({
        url: 'api/Rooms/getRoomsNotOccupied',
        data:{
            page: curpage  
        },
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopRoomDetails(data.data);
            $.getScript("js/pagination.js", function () {  // load pagination
                createPagination(data.last_page, "loadRooms");
                $('#page_' + curpage).addClass("activePage");
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
};

function loopRoomDetails(data) {
    mytable.html("");
    for (var i = 0; i < data.length; i++) {
        var id = data[i].id
            roomNo = data[i].roomNo,
            status = data[i].status
            mytable.append(createRoomTable(id, roomNo, status));
    }
}

function createRoomTable(id, roomNo, status) {
    var myRoom = '<tr class="room_row" data-id="'+ id +'">' +
        '<td>' + roomNo + '</td>' +
        '<td class="room_status">' + status + '</td>' +
        '<td>' +
            '<a class="btn btn-flat changestatus mr5 Vacant white-text" data-status="Vacant"><i class="material-icons left">check</i>Vacant</a>' +
            '<a class="btn btn-flat changestatus mr5 Cleaning white-text" data-status="Cleaning"><i class="material-icons left">delete_sweep</i>Cleaning</a>' +
            '<a class="btn btn-flat changestatus mr5 Maintenance white-text" data-status="Maintenance"><i class="material-icons left">launch</i>Maintenance</a>' +
        '</td>' +
        '</tr>'
    return myRoom;
}

function changeStatus(){
    var id = $(this).closest('tr').attr('data-id');
    var status = $(this).attr('data-status');

    $.ajax({
        url: 'api/RoomManagement/update/' + id,
        data:{
            status: status
        },
        type: 'put',
        dataType: 'json',
        success: function (data) {
            if(data.status == 1){
                $('.room_row[data-id = '+ id +']').find('.room_status').html(status);
                M.toast({html: 'Room Status Updated Succesfully'});
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}