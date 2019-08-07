$(document).ready(function(){
    $('#submitCheckin').on('click', saveCheckin);
})

var checkifvalid = ['#name', '#contact', '#room_id', '#adultsCount','#childrenCount'];
var durationSelect = $('#duration');

$("#rdo-personal").click(rdopersonal);
$("#rdo-company").click(rdocompany);

$('.comp_name_cont').hide();
$('.comp_name_address').hide();

(function loadRoomRates(){
    var roomtypeId = $("#roomType").attr("data-type_id");
    
    $.ajax({
        url: '../api/AdminReservationList/getRoomRates/' + roomtypeId,
        type: 'get',
        dataType: 'json',
        success: function (data) {
            var dataLength = data.length;
            
            durationSelect.html("");
            for (i = 0; i < dataLength; i++) {
                var id = data[i].id,
                    hours = data[i].hours;

                if(hours < 24){
                    durationSelect.append('<option data-days="0" value=' + id + '>' + hours +' hrs</option>');
                }
                else{
                    for(j = 1; j <= 7; j++){
                        if(j === 1){
                            durationSelect.append('<option data-days='+ j +' value=' + id + '>' + j +' day</option>');
                            continue;
                        }
                        durationSelect.append('<option data-days='+ j +' value=' + id + '>' + j +' days</option>');
                    }
                    break;
                }
            }
            M.AutoInit();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
})();


function saveCheckin(){

    if(checkifValidated(checkifvalid)){
        $.confirm({
            title: 'Checkin Confrimation?',
            content: '',
            buttons: {
                cancel: function () { },
                confirm: function () {
                    $.ajax({
                        url: '../api/Checkin',
                        type: 'POST',
                        data: {
                            name: $('#name').val().trim(),
                            contact: $('#contact').val().trim(),
                            email: $('#email').val().trim(),
                            companyName: $('#compName').val().trim(),
                            companyAddress: $('#compAdress').val().trim(),
                            room_id: $('#room_id').val(),
                            adultsCount: $('#adultsCount').val().trim(),
                            childrenCount: $('#childrenCount').val().trim(),
                            rate_id : durationSelect.val().trim(),
                            days : durationSelect.find(':selected').attr('data-days'),
                        },
                        dataType: 'json',
                        success: function (data) {
                            if(data.status == 1){
                                $.confirm({
                                    title: 'Checked in Succesfully',
                                    content: '',
                                    buttons: {
                                        OK: function () { 
                                            window.location = "/"; 
                                        }
                                    }
                                });
                            }
                            else{
                                displayMessage('','Oops!!! Something went wrong')
                            }
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
}
function rdopersonal(){
    $('.comp_name_cont').hide();
    $('.comp_name_address').hide();
}
function rdocompany(){
    $('.comp_name_cont').show();
    $('.comp_name_address').show(); 
}

// $('.conf_select_hours').on('click', function(){
//     $('#rdo-hours').prop("checked", true);
// });