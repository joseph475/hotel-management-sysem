$(document).ready(function(){
    $('#submitCheckin').on('click', saveCheckin);
})

var checkifvalid = ['#name', '#contact', '#room_id', '#adultsCount','#childrenCount'];

$("#rdo-personal").click(rdopersonal);
$("#rdo-company").click(rdocompany);

$('.comp_name_cont').hide();
$('.comp_name_address').hide();

function saveCheckin(){
    
    var guestname = $('#name').val().trim();
    var contact = $('#contact').val().trim();
    var compName = $('#compName').val().trim();
    var compAdress = $('#compAdress').val().trim();
    var room_id = $('#room_id').val();
    var adultsCount = $('#adultsCount').val().trim();
    var childrenCount = $('#childrenCount').val().trim();
    var raterefno = $('input[name=roomRate]:checked').attr('data-id');
    // var raterefno = $('#roomRate').attr('data-id');
    var remainingTime = 0;
    

    if($('#rdo-hours').prop("checked") == true){ remainingTime = $('input[name=roomRate]:checked').val(); }
    else{ remainingTime = 24; }

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
                            name: guestname,
                            contact: contact,
                            companyName: compName,
                            companyAddress: compAdress,
                            room_id: room_id,
                            adultsCount: adultsCount,
                            childrenCount: childrenCount,
                            remainingTime : remainingTime,
                            raterefno : raterefno
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

$('.conf_select_hours').on('click', function(){
    $('#rdo-hours').prop("checked", true);
});