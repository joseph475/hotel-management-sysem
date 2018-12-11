var modal = $('#AddRoomModal');
var curpage = 1;

$(document).ready(function () {
    loadRooms(curpage);    
});

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
        var roomNo = data[i].roomNo,
            type = data[i].type,
            floor = data[i].floor,
            rate = data[i].rate,
            rateperhour = data[i].rateperhour
        $('#roomTable').append(createRoomTable(roomNo, type, floor, rate, rateperhour));
    }
}

function createRoomTable(roomNo, type, floor, rate, rateperhour) {
    var myRoom = '<tr>' +
        '<td>' + roomNo + '</td>' +
        '<td>' + type + '</td>' +
        '<td>' + floor + '</td>' +
        '<td>' + rate + '</td>' +
        '<td>' + rateperhour + '</td>' +
        '<td>' +
            '<a class="btn btn-flat btn-2"><i class="material-icons left">input</i>View</a>' +
        '</td>' +
        '</tr>'
    return myRoom;
}


$('#submit').on('click', function () {
    var roomNo = modal.find('#roomNo').val().trim(),
        roomType = modal.find('#roomType').val(),
        floor = modal.find('#floor-select').val();

    curpage = sessionStorage.getItem("curpage");
    if (roomNo != '' && roomType != 0 && floor != 0) {
        $.confirm({
            title: 'Are you sure you want to Save?',
            content: '',
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
                        error: function (aaa, bbb, ccc) {
                            console.log(aaa + "-" + bbb + "-" + ccc);
                        }
                    });
                }
            }
        });
    }
    else {
        displayMessage('Please fill up all fields', '');
    }
})

function clearmodal(){
    modal.find('#roomNo').val('');
    modal.find('#roomType').val(0);
    modal.find('#floor-select').val(0);
    M.AutoInit();
}


