$(document).ready(loadRoomRate);
$(document).ready(ckEditorInit('description'));
$(document).on('click','.submitRoomType', save);
$(document).on('click', '.btn_add_rate', addRate);
$(document).on('click','#submit_penalty_rate', changePenaltyRate);
$(document).on('click', '.changeStatus', changeStatus);

var checkifvalid = ['#add_hour', '#add_rate'];
var roomtype_id = $('.btn_add_rate').attr('data-id');

function save(){
    $('#submitForm').submit();
    M.toast({html: 'Saving Pls. Wait!!!'});
}

function loadRoomRate(){
    $.ajax({
        url: '../api/RoomRate/' + roomtype_id,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            loopdetails(data);
        },
        error: function (aaa, bbb, ccc) {
            console.log(aaa + "-" + bbb + "-" + ccc);
        }
    });
}
function loopdetails(data){
    $('.add_ul').html("");
    for (var i = 0; i < data.length; i++) {
        var id = data[i].id,
            hours = data[i].hours,
            rate = data[i].rate
        $('.add_ul').append(createlist(id, hours, rate));
    }
}
function createlist(id, hours, rate){
    var myList = '<li data-id="'+ id +'">'+ hours +' hrs <span class="right">&#8369;'+ rate +'</span></li>';
    return myList;
}
function changePenaltyRate(){
    var penalty_rate = $('#penalty_rate_change').val();
    $.ajax({
        url: '../api/ChangePenaltyRate',
        type: 'PUT',
        data: {
            id: roomtype_id,
            rateperhour: penalty_rate
        },
        dataType: 'json',
        success: function (data) {
            M.toast({html: 'Penalty Rate Updated Succesfully'});
            $('#penalty_rate').html(penalty_rate);
            $('#penalty_rate_change').val('');
            $('#penalty_rate_change').removeClass('valid');
        },
        error: function (aaa, bbb, ccc) {
            console.log(aaa + "-" + bbb + "-" + ccc);
        }
    });
}
function changeStatus(e){
    e.preventDefault();
    let status = $(this).attr('data-status');
    status = (status == 1)? 0 : 1;
    $.confirm({
        title: `${(status == 1)? 'Publish ':'Unpublish ' }RoomType?`,
        content: '',
        buttons: {
            cancel: function () { },
            confirm: function () {
                $.ajax({
                    url: '../api/ChangeStatus',
                    type: 'PUT',
                    data: {
                        id: roomtype_id,
                        ispublished : status
                    },
                    dataType: 'json',
                    success: function (data) {
                        location.reload();
                    },
                    error: function (aaa, bbb, ccc) { console.log(aaa); }
                });
            }
        }
    });
}
function addRate(){
    var hours = $('#add_hour').val().trim();
    var rate = $('#add_rate').val().trim();
    
    if(checkValid(checkifvalid)){
        $.confirm({
            title: 'Add Rate?',
            content: '',
            buttons: {
                cancel: function () { },
                confirm: function () {
                    $.ajax({
                        url: '../api/AddRoomRate',
                        type: 'POST',
                        data: {
                            roomtype_id: roomtype_id,
                            hours : hours,
                            rate: rate
                        },
                        dataType: 'json',
                        success: function (data) {
                            M.toast({html: 'Rate Added Succesfully'});
                            clearModal(checkifvalid);
                            loadRoomRate();
                        },
                        error: function (aaa, bbb, ccc) {
                            console.log(aaa + "-" + bbb + "-" + ccc);
                        }
                    });
                }
            }
        });
    }
}
