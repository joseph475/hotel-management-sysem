var Addmodal = $('#AddInventoryModal');
var UpdateModal = $('#UpdateInventoryModal');
var roomNo = $('.page-title').attr('data-roomNo');

var checkifvalid = ['#inventory-select','#quantity'];

$(document).on('click', '.status-radio', function(){
    // $loading.show();
    let inventoryId = $(this).closest('tr').attr('data-id');
    let status = $(this).val();
    $.ajax({
        url: '../api/Room/UpdateInventorystatus/',
        type: 'PUT',
        data: {
            inventory_id: inventoryId,
            status: status
        },
        dataType: 'json',
        success: function (data) {
            // M.toast({html: 'Status updated succesfully'});
            // location.reload();
        },
        error: function (aaa, bbb, ccc) { console.log(aaa); }
    });  
});
$(document).on('click', '#editItemStatus', function(){
    $('#inventoryStatusTable').html("");
    let inventoryId = $(this).attr('data-id');
    $.ajax({
        url: '../api/Room/Inventorystatus/',
        type: 'get',
        data: {
            room_id: roomNo,
            inventory_id: inventoryId
        },
        dataType: 'json',
        success: function (data) {
            // console.log(data);
            loopInventoryStatus(data);
        },
        error: function (aaa, bbb, ccc) { console.log(aaa); }
    });
});

function loopInventoryStatus(data) {
    for (var i = 0; i < data.length; i++) {
        var id = data[i].id,
            description = data[i].description,
            status = data[i].status
        $('#inventoryStatusTable').append(createInventoryTable(i + 1, id, description, status));
    }
}

function createInventoryTable(i, id, description, status) {
    let statusdesc = '';
    switch(status){ 
        case 1: statusdesc = 'Good'; break;
        case 2: statusdesc = 'Damaged'; break; 
        case 3: statusdesc = 'Missing'; break; 
    }
    var myInventoryStatus = '<tr data-id='+ id +'>' +
        '<td style="font-weight:600;">' + description + ' ' + i + '<span></td>' +
        // '<td>' + statusdesc + '</td>' +
        '<td class="center-align">' +
                '<label class="mr20">'+
                    `<input name="group${i}" type="radio" class="with-gap status-radio" value="1" ${status == 1? 'checked' : ''} />` +
                    '<span class="pl30">Good</span>' +
                '</label>' +
                '<label class="mr20">'+
                    `<input name="group${i}" type="radio" class="with-gap status-radio" value="2" ${status == 2? 'checked' : ''}/>` +
                    '<span class="pl30">Damaged</span>' +
                '</label>' +
                '<label class="mr20">'+
                    `<input name="group${i}" type="radio" class="with-gap status-radio" value="3" ${status == 3? 'checked' : ''}/>` +
                    '<span class="pl30">Missing</span>' +
                '</label>' +
        '</td>' +
        '</tr>';
    return myInventoryStatus;
}

$('#submit').on('click', function () {
    let inventoryId = Addmodal.find('#inventory-select').val(),
        quantity = Addmodal.find('#quantity').val();

    // curpage = sessionStorage.getItem("curpage");

    if (inventoryId != 0 && quantity != 0) {
        $.confirm({
            title: 'Save Item?',
            buttons: {
                cancel: function () { },
                confirm: function () {
                    $.ajax({
                        url: '../api/Room/AddInventory/',
                        type: 'POST',
                        data: {
                            room_id: roomNo,
                            inventory_id: inventoryId,
                            status: 1,
                            quantity: quantity
                        },
                        dataType: 'json',
                        success: function (data) {
                            M.toast({html: 'Item Added Succesfully'});
                            location.reload();
                        },
                        error: function (aaa, bbb, ccc) { console.log(aaa); }
                    });
                }
            }
        });
    }
    else { displayMessage('Please Validate all fields', ''); }
})