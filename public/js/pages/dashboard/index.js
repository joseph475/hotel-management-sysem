var roomCards = $('#room-cards');
var dataLength = 0;
var view = sessionStorage.getItem("room-views");

$(document).ready(function(){

    if(view == "grid"){ loadRoomCards(1); }
    else{ loadRoomList(1); }

    loadAvailableRoomsCount();
    loadReserveAvailableOccupiedCount();
});

$(document).on('click', '.card-panel', filter);
$(document).on('click', '.availableRoomsFilter', filter);

$('body').on('click',function(){ $('.legends ul').fadeOut("slow"); });

$('#show-legends').on('click',function(e){
    $('.legends ul').fadeToggle("slow");
    e.stopPropagation();
});

$('#change-views').on('click',function(e){
    let view = sessionStorage.getItem("room-views");
    if(view == "grid"){
        sessionStorage.setItem('room-views', 'list');
        loadRoomList(1);
    }
    else{
        sessionStorage.setItem('room-views', 'grid');
        loadRoomCards(1);
    }
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
                availableTypes += `<li class="availableRoomsFilter" filter-type="available-filter" data-filter="${ data[i].type }">${ data[i].type }<span class="new badge grey darken-2" data-badge-caption="">${ data[i].total }</span></li>`;
            }
            $('#availableTypes').append(availableTypes);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function loadReserveAvailableOccupiedCount(){
    $.ajax({
        url: 'api/dashboard/getReserveAvailableOccupiedCount',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            console.log(data);
            try{$('#vacantCount').html(data[0].total);}
            catch{$('#vacantCount').html("0");}
            
            try{ $('#occupiedCount').html(data[1].total); }
            catch{ $('#occupiedCount').html("0"); }

            try{ $('#reservedCount').html(data[2].total); }
            catch{ $('#reservedCount').html("0"); }

            // try{ $('#cleaningCount').html(data[3].total); }
            // catch{ $('#cleaningCount').html("0"); }

            // try{ $('#maintenanceCount').html(data[4].total); }
            // catch{ $('#maintenanceCount').html("0"); }
            
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}



function loadRoomCards(curpage, search = '') {
    sessionStorage.setItem("curpage", curpage);
    $.ajax({
        url: 'api/dashboard',
        data:{
            page: curpage,
            search: search
        },
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopRoomCards(data.data);
            $.getScript("js/pagination.js", function () {  // load pagination
                createPagination(data.last_page, "loadRoomCards", search);
                $('#page_' + curpage).addClass("activePage");
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
};

function loadRoomList(curpage, search = '') {
    sessionStorage.setItem("curpage", curpage);
    $.ajax({
        url: 'api/dashboard',
        data:{
            page: curpage,
            search: search
        },
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopRoomList(data.data);
            $.getScript("js/pagination.js", function () {  // load pagination
                createPagination(data.last_page, "loadRoomList", search);
                $('#page_' + curpage).addClass("activePage");
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
};

function loopRoomList(data){
    dataLength = data.length;

    roomCards.html("");
    roomCards.append(` <div class="table-container"><table class="highlight z-depth-1 myTable" id="room-list-view"><tr><th>Room #</th><th>Room Type</th><th>Floor</th><th></th></tr></table></div>`);
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

                $('#room-list-view').append(createRoomList(roomNo,room_id, type, floor, maxAdult,maxChildren, status));

                // console.log('#room_no_link_' + room_id);

            if(status === 'Vacant'){ $('#room_no_link_' + room_id).html(`<a class="blue-text" href="Checkin/${room_id}">Room ${roomNo}</a>`); }
            if(status === 'Occupied'){ $('#room_no_link_' + room_id).html(`<a class="blue-text" href="Checkin-status/${room_id}">Room ${roomNo}</a>`); }
        }
    }
}
function createRoomList(roomNo, room_id, type, floor, maxAdult, maxChildren, status) {
    var myRoomCard = `<tr class='room_"${room_id}"'>` +
                    `<td id="room_no_link_${room_id}">Room ${roomNo}</td>` +
                    `<td>${type}</td>` +
                    `<td>${floor}</td>` +
                    `<td class="${status}" width="20">${status}</td>` +
                    `</tr>`;
    return myRoomCard;
}

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
    var myRoomCard = "<div class='col m2 s6'>" +
                        "<div class='cards z-depth-1' id='room_"+ room_id +"'>" +
                            `<p class="p-room">Room ${roomNo}</p>` +   
                            `<div class='card-image ${status}'>`+
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


function filter(){
    let view = sessionStorage.getItem("room-views");
    
    sessionStorage.setItem("curpage", 1);
    let curpage = sessionStorage.getItem("curpage");
    let filter = $(this).attr('data-filter');
    $(this).toggleClass('active');
   
    $('.availableRoomsFilter').not(this).removeClass('active');
    $('.card-panel').not(this).removeClass('active');

    if(view == "grid"){
        $(this).hasClass('active')? loadRoomCards(curpage, filter) : loadRoomCards(curpage, '');
    }
    else{
        $(this).hasClass('active')? loadRoomList(curpage, filter) : loadRoomList(curpage, '');
    }
    
}
