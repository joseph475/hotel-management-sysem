var mytable = $('#hotelInfoTable');
var modal = $('#UpdateModal');

$(document).ready(loadHotelInfo);
$(document).on('click','.editInfo', showModal);
$(document).on('click','#submit', saveUpdate);

function loadHotelInfo() {
    $.ajax({
        url: 'api/HotelInfo',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopHotelDetails(data);
            M.AutoInit();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
};

function loopHotelDetails(data) {
    mytable.html("");
    for (var i = 0; i < data.length; i++) {
        var id = data[i].id
            key = data[i].key_name,
            value = data[i].value
            mytable.append(createHotelInfoTable(id, key, value));
    }
}

function createHotelInfoTable(id, key, value) {
    var myHotelInfo = '<tr data-id="'+ id +'">' +
        '<td class="key">' + key + '</td>' +
        '<td class="value">' + value + '</td>' +
        '<td>' +
            '<a class="btn btn-2 btn-flat mr5 editInfo tooltipped" data-tooltip="Edit"><i class="far fa-edit"></i></a>' +
        '</td>' +
        '</tr>'
    return myHotelInfo;
}

function showModal(){
    var tr = $(this).closest('tr');
    var id = tr.attr('data-id');
    var key = tr.find('.key').html();
    var value = tr.find('.value').html();

    modal.attr('data-id', id);
    modal.find('label').html(key);
    modal.find('label').addClass("active");
    modal.find('#key').val(value);
    modal.show();
}

function saveUpdate(){
    var id = modal.attr('data-id');
    var key = modal.find('label').html();
    var value = modal.find('#key').val();
    // alert(value);
    $.confirm({
        title: 'Update Confirmation?',
        buttons: {
            cancel: function () { },
            confirm: function () {
                $.ajax({
                    url: '../api/HotelInfo',
                    type: 'PUT',
                    data: {
                        key_name: key,
                        value: value
                    },
                    dataType: 'json',
                    success: function (data) {
                        modal.hide();
                        mytable.find('tr[data-id="' + id + '"]').find('.value').html(value);
                    },
                    error: function (aaa, bbb, ccc) { console.log(aaa); }
                });
            }
        }
    });
}

$('.modal-close').on('click', function(){
    modal.hide();
});
