$(document).ready(function () {
    loadRoomCards();    
    // $(loadRoomCards);
});
// $('body').on('load',loadRoomCards());

function loadRoomCards() {
    $.ajax({
        url: 'api/dashboard',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopRoomCards(data);
            // M.AutoInit();
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
            type = data[i].type,
            floor = data[i].floor,
            rate = convert(data[i].rate),
            rateperhour = convert(data[i].rateperhour),
            maxAdult = data[i].maxAdult,
            maxChildren = data[i].maxChildren,
            checkin_id = data[i].checkin_id,
            status = data[i].status    
        $('#room-cards').append(createRoomCards(roomNo, type, floor, rate, rateperhour,maxAdult,maxChildren, status));

        if(status == 'Vacant'){ $('#roomNo_' + roomNo).wrap('<a href="Checkin/'+ roomNo +'"></a>'); }
        if(status == 'Occupied'){ $('#roomNo_' + roomNo).wrap('<a href="Checkin-status/'+ checkin_id +'"></a>'); }

    }
}

function createRoomCards(roomNo, type, floor, rate, rateperhour,maxAdult,maxChildren, status) {
    var myRoomCard = "<div class='col m3 s6'>" +
                        "<div class='cards z-depth-1' id='roomNo_"+ roomNo +"'>" +
                            "<p class='p-room'>Room " + roomNo + "</p>" +   
                            "<div class='card-image "+ status +"'>" +
                                "<img src='/images/bed1.png'>" +
                            "</div>" +
                            "<div class='room_status'>" +
                                "<div class='room_status_content'>" +
                                    "<div class='p-type'>" + type + "</div>" +
                                    "<div class='p-info'>Floor: " + floor + "</div>" +
                                    "<div class='p-info'>Rate: &#8369;" + rate + "</div>" +
                                    "<div class='p-info'>Rate/Hour: &#8369;" + rateperhour + "</div>" +
                                    "<div class='p-info'>Max Adult: " + maxAdult + "</div>" +
                                    "<div class='p-info'>Max Children: " + maxChildren + "</div>" +
                                    "<div class='p-status'>Status: " + status + "</div>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "</div>" 
    return myRoomCard;
}
