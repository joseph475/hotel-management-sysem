var mytable = $('#extrasTable');
var modal = $('#AddExtrasModal');
var checkifvalid = ['#description', '#price'];

$(document).ready(loadExtras(curpage));
$(document).on('click', '.changeStatus', changeStatus);
$(document).on('click', '.deleteExtra', deleteExtra);

function loadExtras(curpage, search = '') {
    $.ajax({
        url: 'api/Extras',
        data:{
            page: curpage,
            search: search  
        },
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopExtrasDetails(data.data);
            $.getScript("js/pagination.js", function () {  // load pagination
                createPagination(data.last_page, "loadExtras");
                $('#page_' + curpage).addClass("activePage");
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
};

function loopExtrasDetails(data) {
    mytable.html("");
    for (var i = 0; i < data.length; i++) {
        var id = data[i].id
            description = data[i].description,
            cost = data[i].cost,
            ispublished = data[i].ispublished
            mytable.append(createExtrasTable(id, description, cost, ispublished));
    }
}

function createExtrasTable(id, description, cost, ispublished) {
    var myExtra = '<tr data-id="'+ id +'">' +
        '<td>' + description + '</td>' +
        '<td>' + cost + '</td>' +
        '<td class="actionButtons">' +
            '<a class="btn btn-2 btn-flat mr5 changeStatus">';
                if(parseInt(ispublished) == 1){
                    myExtra += '<i class="far fa-eye"></i>';
                }
                else{
                    myExtra += '<i class="far fa-eye-slash"></i>';
                }
            myExtra += '</a>' +
            '<a class="btn btn-2 btn-flat mr5 deleteExtra"><i class="far fa-trash-alt"></i></a>' +
        '</td>' +
        '</tr>'
    return myExtra;
}


$('#submit').on('click', function () {
    if(checkValid(checkifvalid)){
        var description = modal.find('#description').val(),
            price = modal.find('#price').val();

        $.confirm({
            title: 'Save Extra?',
            content: '',
            buttons: {
                cancel: function () { },
                confirm: function () {
                    $.ajax({
                        url: '../api/Extra',
                        type: 'POST',
                        data: {
                            description: description,
                            cost: price
                        },
                        dataType: 'json',
                        success: function (data) {
                            M.toast({html: 'Extras Added Succesfully'});
                            loadExtras(1); 
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
        url: '../api/Extra',
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

function deleteExtra(){
    var tr = $(this).closest('tr')
    var id = tr.attr('data-id');
    
    $.confirm({
        title: 'Delete Extra?',
        buttons: {
            cancel: function () { },
            confirm: function () { 
                $.ajax({
                    url: '../api/Extra/' + id,
                    type: 'DELETE',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function (data) {
                        if(data.status == 0){ displayMessage('Extra cannot be deleted'); }
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