var modal = $('#AddRoomTypeModal');
var checkifvalid = ['#roomType','#description', '#maxAdult', '#maxChildren'];

$(document).ready(function () {
    loadRoomTypes(curpage);
});

function loadRoomTypes(curpage) {
    sessionStorage.setItem("curpage", curpage);
    $.ajax({
        url: 'api/RoomTypes',
        data: {
            page: curpage
        },
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopRoomTypeDetails(data.data);
            $.getScript("js/pagination.js", function () {  // load pagination
                createPagination(data.last_page, "loadRoomTypes");
                $('#page_' + curpage).addClass("activePage");
            });
            M.AutoInit();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
};

function loopRoomTypeDetails(data) {
    $('#roomTypeTable').html("");
    for (var i = 0; i < data.length; i++) {
        var id = data[i].id,
            type = data[i].type,
            maxAdult = data[i].maxAdult,
            maxChildren = data[i].maxChildren;
            // rate = data[i].rate;
            // rateperhour = data[i].rateperhour;
        $('#roomTypeTable').append(createRoomTypeTable(id, type, maxAdult, maxChildren));
    }
}

function createRoomTypeTable(id, type, maxAdult, maxChildren) {
    var myRoomType = "<tr>" +
        '<td>' + type + '</td>' +
        // '<td>' + rate + '</td>' +
        // '<td>' + rateperhour + '</td>' +
        '<td>' + maxAdult + '</td>' +
        '<td>' + maxChildren + '</td>' +
        '<td>' +
        '<a href="/RoomType/'+ id +'" class="btn btn-flat btn-2"><i class="material-icons left">input</i>View</a>' +
        '</td>' +
        '</tr>'
    return myRoomType;
}


$('#submit').on('click', function () {    
if(checkValid(checkifvalid)){
    var roomType = modal.find('#roomType').val(),
        description = modal.find('#description').val(),
        maxAdult = modal.find('#maxAdult').val(),
        maxChildren = modal.find('#maxChildren').val();
        
    curpage = sessionStorage.getItem("curpage");
    $.confirm({
        title: 'Save Room Type?',
        content: '',
        buttons: {
            cancel: function () { },
            confirm: function () {
                $.ajax({
                    url: '../api/RoomType',
                    type: 'POST',
                    data: {
                        type: roomType,
                        description : description,
                        // rate: rate,
                        // rateperhour: rateperhour,
                        maxAdult: maxAdult,
                        maxChildren: maxChildren
                    },
                    dataType: 'json',
                    success: function (data) {
                        M.toast({html: 'Room Type Added Succesfully'});
                        loadRoomTypes(1);
                        clearModal(checkifvalid);
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
        displayMessage('Please Validate all fields', '');
    }
})

function clearmodal() {
    modal.find('#roomType').val('');
    // modal.find('#rate').val('');
    // modal.find('#rateperhour').val('');
    modal.find('#maxAdult').val('');
    modal.find('#maxChildren').val('');
    M.AutoInit();
}
