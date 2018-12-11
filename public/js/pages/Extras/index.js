var curpage = 1;
var mytable = $('#extrasTable');
var modal = $('#AddExtrasModal');
var checkifvalid = ['#description', '#price'];

$(document).ready(loadExtras(curpage));

function loadExtras(curpage) {
    $.ajax({
        url: 'api/Extras',
        data:{
            page: curpage  
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
            mytable.append(createExtrasTable(id, description, cost));
    }
}

function createExtrasTable(id, description, cost) {
    var myFood = '<tr class="extras_row" data-id="'+ id +'">' +
        '<td>' + description + '</td>' +
        '<td>' + cost + '</td>' +
        '<td>' +
            '<a class="btn btn-2 btn-flat mr5"><i class="material-icons">edit</i></a>' +
            '<a class="btn btn-2 btn-flat mr5"><i class="material-icons">delete</i></a>' +
        '</td>' +
        '</tr>'
    return myFood;
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
                        url: '../api/Extras',
                        type: 'POST',
                        data: {
                            description: description,
                            cost: price
                        },
                        dataType: 'json',
                        success: function (data) {
                            $.confirm({
                                title: 'Extra Succesfully Added',
                                content: '',
                                buttons: {
                                    OK: function () {
                                        loadExtras(1); 
                                        clearmodal();
                                    }
                                }
                            });
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

function clearmodal(){
    $.each(checkifvalid, function(i, v){ $(v).removeClass('valid') });

    modal.find('#description').val(null);
    modal.find('#cost').val(null);
    M.AutoInit();
}