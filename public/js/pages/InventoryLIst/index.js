var mytable = $('#inventoryTable');
var modal = $('#AddInventoryItemModal');
var checkifvalid = ['#description'];

$(document).ready(loadInventoryList(curpage));
$(document).on('click', '.changeStatus', changeStatus);
$(document).on('click', '.deleteInventoryItem', deleteInventoryItem);

function loadInventoryList(curpage) {
    $.ajax({
        url: 'api/InventoryLists',
        data:{
            page: curpage  
        },
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopInventoryListsDetails(data.data);
            $.getScript("js/pagination.js", function () {  // load pagination
                createPagination(data.last_page, "loadInventoryList");
                $('#page_' + curpage).addClass("activePage");
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
};

function loopInventoryListsDetails(data) {
    mytable.html("");
    for (var i = 0; i < data.length; i++) {
        var id = data[i].id
            description = data[i].description,
            ispublished = data[i].ispublished
            mytable.append(createInventpryListTable(id, description, ispublished));
    }
}

function createInventpryListTable(id, description,  ispublished) {
    var myItem = '<tr data-id="'+ id +'">' +
        '<td>' + description + '</td>' +
        '<td class="actionButtons">' +
            '<a class="btn btn-2 btn-flat mr5 changeStatus">';
                if(parseInt(ispublished) == 1){
                    myItem += '<i class="far fa-eye"></i>';
                }
                else{
                    myItem += '<i class="far fa-eye-slash"></i>';
                }
                myItem += '</a>' +
            '<a class="btn btn-2 btn-flat mr5 deleteInventoryItem"><i class="far fa-trash-alt"></i></a>' +
        '</td>' +
        '</tr>'
    return myItem;
}


$('#submit').on('click', function () {
    if(checkValid(checkifvalid)){
        var description = modal.find('#description').val();

        $.confirm({
            title: 'Save Inventory Item?',
            content: '',
            buttons: {
                cancel: function () { },
                confirm: function () {
                    $.ajax({
                        url: '../api/InventoryList',
                        type: 'POST',
                        data: {
                            description: description,
                        },
                        dataType: 'json',
                        success: function (data) {
                            M.toast({html: 'Inventory Item Added Succesfully'});
                            loadInventoryList(1); 
                            clearmodal();
                        },
                        error: function (aaa, bbb, ccc) {
                            console.log(aaa);
                        }
                    });
                }
            }
        });
    }
    else{
        displayMessage('Please Validate all fields', '');
    }
})

function changeStatus(){
    var id = $(this).closest('tr').attr('data-id');
    var icon = $(this).find('i');
    var ispublished = 0;

    icon.hasClass('fa-eye')? ispublished = 0 : ispublished = 1;

    $.ajax({
        url: '../api/InventoryList',
        type: 'PUT',
        data: {
            id: id,
            ispublished : ispublished
        },
        dataType: 'json',
        success: function (data) {
            icon.toggleClass('fa-eye fa-eye-slash');
        },
        error: function (aaa, bbb, ccc) { console.log(aaa); }
    });
}

function deleteInventoryItem(){
    var tr = $(this).closest('tr')
    var id = tr.attr('data-id');
    
    $.confirm({
        title: 'Delete Inventory Item?',
        buttons: {
            cancel: function () { },
            confirm: function () { 
                $.ajax({
                    url: '../api/InventoryList/' + id,
                    type: 'DELETE',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function (data) {
                        if(data.status == 0){ displayMessage('Inventory Item cannot be deleted'); }
                        else{ tr.remove(); }
                    },
                    error: function (aaa, bbb, ccc) { console.log(aaa); }
                });
            }
        }
    });
}

function clearmodal(){
    $.each(checkifvalid, function(i, v){ $(v).removeClass('valid') });
    modal.find('#description').val(null);
    modal.find('#price').val(null);
    M.AutoInit();
}