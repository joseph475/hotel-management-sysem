$(document).ready(loadRoomCards);

function loadRoomCards() {
    $.ajax({
        url: 'api/dashboard',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopRoomCards(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
};

function loopRoomCards(data) {
    $('#room-cards').html("");
    for (var i = 0; i < data.length; i++) {
        var roomNo = data[i].roomNo,
            room_id = data[i].room_id,
            type = data[i].type,
            floor = data[i].floor,
            // rate = convert(data[i].rate),
            // rateperhour = convert(data[i].rateperhour),
            maxAdult = data[i].maxAdult,
            maxChildren = data[i].maxChildren,
            checkin_id = data[i].checkin_id,
            status = data[i].status    
        $('#room-cards').append(createRoomCards(roomNo,room_id, type, floor, maxAdult,maxChildren, status));

        if(status == 'Vacant'){ $('#room_' + room_id).wrap('<a href="Checkin/'+ room_id +'"></a>'); }
        if(status == 'Occupied'){ $('#room_' + room_id).wrap('<a href="Checkin-status/'+ checkin_id +'"></a>'); }
    }
}

function createRoomCards(roomNo, room_id, type, floor,maxAdult,maxChildren, status) {
    var myRoomCard = "<div class='col m3 s6'>" +
                        "<div class='cards z-depth-1' id='room_"+ room_id +"'>" +
                            "<p class='p-room'>Room " + roomNo + "</p>" +   
                            "<div class='card-image "+ status +"'>" +
                                "<img src='/images/bed1.png'>" +
                            "</div>" +
                            "<div class='room_status'>" +
                                "<div class='room_status_content'>" +
                                    "<div class='p-type'>" + type + "</div>" +
                                    "<div class='p-info'>Floor: " + floor + "</div>" +
                                    // "<div class='p-info'>Rate: &#8369;" + rate + "</div>" +
                                    // "<div class='p-info'>Rate/Hour: &#8369;" + rateperhour + "</div>" +
                                    "<div class='p-info'>Max Adult: " + maxAdult + "</div>" +
                                    "<div class='p-info'>Max Children: " + maxChildren + "</div>" +
                                    "<div class='p-status'>Status: " + status + "</div>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "</div>" 
    return myRoomCard;
}
