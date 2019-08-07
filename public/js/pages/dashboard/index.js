var roomCards = $('#room-cards');
var dataLength = 0;

$(document).ready(function(){
    loadRoomCards(1);
    loadAvailableRoomsCount();
    loadReserveAndAvailableCount();
});
// $(document).ready(loadRoomCards);

$('body').on('click',function(){ $('.legends ul').fadeOut("slow"); });

$('.menu').on('click',function(e){
    $('.legends ul').fadeToggle("slow");
    e.stopPropagation();
});

function loadAvailableRoomsCount(){
    $.ajax({
        url: 'api/dashboard/getAvailableRooms',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            dataLength = data.length;
            var availableTypes = "";

            for (var i = 0; i < dataLength; i++) {
                availableTypes += '<li>' + data[i].type + '<span class="new badge grey darken-2" data-badge-caption="">' + data[i].total + '</span></li>';
            }
            $('#availableTypes').append(availableTypes);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function loadReserveAndAvailableCount(){
    $.ajax({
        url: 'api/dashboard/getResrveAndAvailableCount',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            try{$('#vacantCount').html(data[0].total);}
            catch{$('#vacantCount').html("0");}
            
            try{ $('#ReservedCount').html(data[1].total); }
            catch{ $('#ReservedCount').html("0"); }
            
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function loadRoomCards(curpage) {
    sessionStorage.setItem("curpage", curpage);
    $.ajax({
        url: 'api/dashboard',
        data:{
            page: curpage  
        },
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopRoomCards(data.data);
            $.getScript("js/pagination.js", function () {  // load pagination
                createPagination(data.last_page, "loadRoomCards");
                $('#page_' + curpage).addClass("activePage");
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
};

function loopRoomCards(data) {
    dataLength = data.length;

    roomCards.html("");
    if(dataLength > 0){
        for (var i = 0; i < data.length; i++) {
            var roomNo = data[i].roomNo,
                room_id = data[i].room_id,
                type = data[i].type,
                floor = data[i].floor,
                maxAdult = data[i].maxAdult,
                maxChildren = data[i].maxChildren,
                checkin_id = data[i].checkin_id,
                status = data[i].status;

                roomCards.append(createRoomCards(roomNo,room_id, type, floor, maxAdult,maxChildren, status));

            if(status === 'Vacant'){ $('#room_' + room_id).wrap('<a href="Checkin/'+ room_id +'"></a>'); }
            if(status === 'Occupied'){ $('#room_' + room_id).wrap('<a href="Checkin-status/'+ checkin_id +'"></a>'); }
        }
    }
}

function createRoomCards(roomNo, room_id, type, floor, maxAdult, maxChildren, status) {
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
                    "</div>";
    return myRoomCard;
}
