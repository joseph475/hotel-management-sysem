$(document).ready(function(){
    $('#btn_save_res').on('click', saveReservation);
    $('#roomType').change(selectRoomRates);
})

var checkifvalid = ['#name', '#valid_id','#valid_id_type', '#roomType', '#mobile','#email',
 '#checkinDate', '#adultsCount','#childCount', '#duration'];

var i = 0, j = 0;
var durationSelect = $('#duration');

function selectRoomRates(){
    var roomtypeId = $(this).val();
    
    $.ajax({
        url: 'api/AdminReservationList/getRoomRates/' + roomtypeId,
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
}

function saveReservation(){
    if(checkifValidated(checkifvalid)){
        $.confirm({
            title: 'Save Reservation?',
            content: '',
            buttons: {
                cancel: function () { },
                confirm: function () {
                    $.ajax({
                        url: '../api/WebReservation',
                        type: 'POST',
                        data: {
                            name: $('#name').val().trim(),
                            roomtype : $('#roomType').val(),
                            personal_id_type: $('#valid_id_type').val(),
                            personal_id: $('#valid_id').val().trim(),
                            mobile: $('#mobile').val().trim(),
                            email: $('#email').val().trim(),
                            compName : $('#compName').val().trim(),
                            compAddress : $('#compAddress').val().trim(),
                            checkInDate : $('#checkinDate').val().trim(),
                            adultsCount: $('#adultsCount').val().trim(),
                            childrensCount: $('#childCount').val().trim(),
                            rate_id : durationSelect.val().trim(),
                            days : durationSelect.find(':selected').attr('data-days'),
                        },
                        dataType: 'json',
                        success: function (data) {
                            $.confirm({
                                title: 'Reservation Saved Succesfully',
                                content: '',
                                buttons: {
                                    OK: function () {
                                        window.location ="/PendingReservationList";
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
}