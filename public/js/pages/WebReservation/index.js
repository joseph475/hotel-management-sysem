$('.btn_bookNow').on('click', showReservationModal);
$('.cancel_res').on('click', hideReservationModal);
$(document).on('click','.modal-overlay',hideReservationModal);
$("#reservation_modal").click(function(event) { event.stopPropagation() });
$("#rdo-personal").click(rdopersonal);
$("#rdo-company").click(rdocompany);
$('.book_res').on('click', bookReservation);
$('#roomType').change(changeLimit);

$('.comp_name_cont').hide();
$('.comp_name_address').hide();

var checkifvalid1 = ['#checkin_date', '#adult_count', '#child_count', '#roomType'];
var checkifvalid2 = ['#guest_name', '#guest_id', '#guest_id_type', '#contact', '#email'];
var checkifvalid3 = ['#guest_name', '#guest_id', '#guest_id_type', '#contact', '#email', "#compName", "#compAddress"];


function bookReservation(){
    if($('#rdo-personal').is(':checked')) {
        if(checkValid(checkifvalid2)){
            BookNow();
        }
    }
    else {
        if(checkValid(checkifvalid3)){
            BookNow();
        }
    }
}

function BookNow(){
    var guestname = $('#guest_name').val().trim();
    var guest_id_type = $('#guest_id_type').val().trim();
    var roomType = $('#roomType').val().trim();
    var guest_id = $('#guest_id').val().trim();
    var contact = $('#contact').val().trim();
    var email = $('#email').val().trim();
    var compName = $('#compName').val().trim();
    var compAddress = $('#compAddress').val().trim();

    var checkindate = $('#checkin_date').val().trim();;
    // var checkout_date = $('#checkout_date').val().trim();
    var adultcount = $('#adult_count').val().trim();
    var childcount = $('#child_count').val().trim();

    $.confirm({
        title: 'Book Reservation?',
        content: '',
        buttons: {
            cancel: function () { },
            confirm: function () {
                $.ajax({
                    url: '../api/WebReservation',
                    type: 'POST',
                    data: {
                        name: guestname,
                        roomtype : roomType,
                        personal_id_type: guest_id_type,
                        personal_id: guest_id,
                        mobile: contact,
                        email: email,
                        compName : compName,
                        compAddress : compAddress,
                        checkInDate : checkindate,
                        // checkOutDate: checkout_date,
                        adultsCount: adultcount,
                        childrensCount: childcount
                    },
                    dataType: 'json',
                    success: function (data) {
                        $.confirm({
                            title: 'Reservation Booked Succesfully',
                            content: '',
                            buttons: {
                                OK: function () {
                                   location.reload();
                                }
                            }
                        });
                    },
                    error: function (aaa, bbb, ccc) {
                        console.log(ccc);
                    }
                });
            }
        }
    });
}
function rdopersonal(){
    $('.comp_name_cont').hide();
    $('.comp_name_address').hide();
}
function rdocompany(){
    $('.comp_name_cont').show();
    $('.comp_name_address').show(); 
}

function changeLimit(){
    var maxAdultLimit = $(this).find(':selected').attr('data-maxAdult');
    var maxChildLimit = $(this).find(':selected').attr('data-maxChildren');
    $('#adult_count').find('option').remove().end();
    $('#child_count').find('option').remove().end();
    $('#adult_count').append('<option value="" disabled selected>Adult (18+)</option>');
    $('#child_count').append('<option value="" disabled selected>Children (0-17)</option>');

    for(i = 1; i <= maxAdultLimit; i++){
        $('#adult_count').append('<option value='+ i +'>'+ i +'</option>');
    }

    for(i = 1; i <= maxChildLimit; i++){
        $('#child_count').append('<option value='+ i +'>'+ i +'</option>');
    }
    M.AutoInit();
}

function showReservationModal(){
    if(checkifValidated(checkifvalid1)){
        $('#reservation_modal').addClass('open');
        $('#reservation_modal').css('z-index', '1003');
        $('#reservation_modal').css('opacity', '1');
        $('#reservation_modal').css('top', '10%');
        $('#reservation_modal').css('transform', 'scaleX(1) scaleY(1)');
        $('.web-reservation').append('<div class="modal-overlay" style="z-index: 1002; display: block; opacity: 0.5;"></div>');
        $('body').css('overflow','hidden');
        $('#reservation_modal').slideDown(400);
    }
    else{
        displayMessage("Please complete the reservation details", "");
    }
}

function hideReservationModal(){
    $('#reservation_modal').slideUp(400);
    $('.web-reservation').find('.modal-overlay').remove();
    $('body').css('overflow','');
}
