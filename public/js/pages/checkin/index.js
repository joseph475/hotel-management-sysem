$(document).ready(function(){
    $('#submitCheckin').on('click', saveCheckin);
})

function saveCheckin(){
    var guestname = $('#name').val().trim();
    var contact = $('#contact').val().trim();
    var compName = $('#compName').val().trim();
    var compAdress = $('#compAdress').val().trim();

    var room_id = $('#room_id').val();
    var checkoutdate = $('#checkoutdate').val().trim();
    var adultsCount = $('#adultsCount').val().trim();
    var childrenCount = $('#childrenCount').val().trim();

    if (guestname != '' && contact != '' && compName != '' && compAdress != '' && checkoutdate != '' && adultsCount != '' && childrenCount != '') {
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
                            checkOutDate: checkoutdate,
                            adultsCount: adultsCount,
                            childrenCount: childrenCount
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