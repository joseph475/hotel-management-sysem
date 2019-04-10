$(document).ready(function(){
    $('#btn_save_res').on('click', saveReservation);
})

var checkifvalid = ['#name', '#valid_id','#valid_id_type', '#roomType', '#mobile','#email',
 '#checkinDate', '#adultsCount','#childCount'];

function saveReservation(){
    
    var name = $('#name').val().trim();
    var vaild_id = $('#valid_id').val().trim();
    var valid_id_type = $('#valid_id_type').val();
    var roomType = $('#roomType').val();
    var mobile = $('#mobile').val().trim();
    var email = $('#email').val().trim();
    var compName = $('#compName').val().trim();
    var compAddress = $('#compAddress').val().trim();
    var checkinDate = $('#checkinDate').val().trim();
    var adultsCount = $('#adultsCount').val().trim();
    var childCount = $('#childCount').val().trim();

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
                            name: name,
                            roomtype : roomType,
                            personal_id_type: valid_id_type,
                            personal_id: vaild_id,
                            mobile: mobile,
                            email: email,
                            compName : compName,
                            compAddress : compAddress,
                            checkInDate : checkinDate,
                            adultsCount: adultsCount,
                            childrensCount: childCount
                        },
                        dataType: 'json',
                        success: function (data) {
                            $.confirm({
                                title: 'Reservation Saved Succesfully',
                                content: '',
                                buttons: {
                                    OK: function () {
                                        window.location ="/";
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