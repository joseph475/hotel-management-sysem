var modal = $('#AddRoomModal');

$(document).ready(loadRooms(1));
$(document).on('click', '.changeStatus', changeStatus);
$(document).on('click', '.deleteRoom', deleteRoom);

function loadRooms(curpage) {
    sessionStorage.setItem("curpage", curpage);
    $.ajax({
        url: 'api/Rooms',
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
    $('#roomTable').html("");
    for (var i = 0; i < data.length; i++) {
        var id = data[i].id,
            roomNo = data[i].roomNo,
            type = data[i].type,
            floor = data[i].floor,
            rate = data[i].rate,
            rateperhour = data[i].rateperhour,
            ispublished = data[i].ispublished
        $('#roomTable').append(createRoomTable(id, roomNo, type, floor, rate, rateperhour, ispublished));
    }
}

function createRoomTable(id, roomNo, type, floor, rate, rateperhour, ispublished) {    
    var myRoom = '<tr data-id='+ id +'>' +
        '<td>' + roomNo + '</td>' +
        '<td>' + type + '</td>' +
        '<td>' + floor + '</td>' +
        '<td>' + rate + '</td>' +
        '<td>' + rateperhour + '</td>' +
        '<td>' +
            '<a class="btn btn-flat btn-2 mr3 changeStatus" target="_blank">';

        if(parseInt(ispublished) == 1){
            myRoom += '<i class="far fa-eye"></i>';
        }
        else{
            myRoom += '<i class="far fa-eye-slash"></i>';
        }

        myRoom += '</a><a class="btn btn-flat btn-2 deleteRoom" target="_blank"><i class="far fa-trash-alt"></i></a></td></tr>';
    return myRoom;
}


$('#submit').on('click', function () {
    var roomNo = modal.find('#roomNo').val().trim(),
        roomType = modal.find('#roomType').val(),
        floor = modal.find('#floor-select').val();

    curpage = sessionStorage.getItem("curpage");
    if (roomNo != '' && roomType != 0 && floor != 0) {
        $.confirm({
            title: 'Save room?',
            buttons: {
                cancel: function () { },
                confirm: function () {
                    $.ajax({
                        url: '../api/Room',
                        type: 'POST',
                        data: {
                            roomNo: roomNo,
                            roomType: roomType,
                            floor: floor
                        },
                        dataType: 'json',
                        success: function (data) {
                            $.confirm({
                                title: 'Room Added Succesfully',
                                content: '',
                                buttons: {
                                    OK: function () {
                                        loadRooms(1); 
                                        clearmodal();
                                    }
                                }
                            });
                        },
                        error: function (aaa, bbb, ccc) { console.log(aaa); }
                    });
                }
            }
        });
    }
    else { displayMessage('Please Validate all fields', ''); }
})

function changeStatus(){
    var id = $(this).closest('tr').attr('data-id');
    var icon = $(this).find('i');
    var ispublished = 0;

    icon.hasClass('fa-eye')? ispublished = 0 : ispublished = 1;

    $.ajax({
        url: '../api/Room',
        type: 'PUT',
        data: {
            id: id,
            ispublished : ispublished
        },
        dataType: 'json',
        success: function (data) {
            icon.toggleClass('fa-eye fa-eye-slash');
        },
        error: function (aaa, bbb, ccc) { console.log(aaa); }
    });
}

function deleteRoom(){
    var tr = $(this).closest('tr')
    var id = tr.attr('data-id');
    
    $.confirm({
        title: 'Delete room?',
        buttons: {
            cancel: function () { },
            confirm: function () { 
                $.ajax({
                    url: '../api/Room/' + id,
                    type: 'DELETE',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function (data) {
                        if(data.status == 0){ displayMessage('Room cannot be deleted'); }
                        else{ tr.remove(); }
                    },
                    error: function (aaa, bbb, ccc) { console.log(aaa); }
                });
            }
        }
    });
}

function clearmodal(){
    modal.find('#roomNo').val('');
    modal.find('#roomType').val(0);
    modal.find('#floor-select').val(0);
    M.AutoInit();
}


