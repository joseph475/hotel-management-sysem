var curpage = 1;
var mytable = $('#foodTable');
var modal = $('#AddMenuModal');
var checkifvalid = ['#menu', '#servings', '#cost', '#price'];

$(document).ready(loadFoods(curpage));

function loadFoods(curpage) {
    $.ajax({
        url: 'api/Kitchen',
        data:{
            page: curpage  
        },
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopFoodDetails(data.data);
            $.getScript("js/pagination.js", function () {  // load pagination
                createPagination(data.last_page, "loadFoods");
                $('#page_' + curpage).addClass("activePage");
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
};

function loopFoodDetails(data) {
    mytable.html("");
    for (var i = 0; i < data.length; i++) {
        var id = data[i].id
            menuName = data[i].menuName,
            servings = data[i].servings,
            remaining = data[i].remaining,
            cost = data[i].cost,
            sellingPrice = data[i].sellingPrice
            mytable.append(createFoodTable(id, menuName, servings, remaining, cost, sellingPrice));
    }
}

function createFoodTable(id, menuName, servings, remaining, cost, sellingPrice) {
    var myFood = '<tr class="room_row" data-id="'+ id +'">' +
        '<td>' + menuName + '</td>' +
        '<td>' + servings + '</td>' +
        '<td>' + remaining + '</td>' +
        '<td>' + cost + '</td>' +
        '<td>' + sellingPrice + '</td>' +
        '<td>' +
            '<a class="btn btn-2 btn-flat mr5"><i class="material-icons">edit</i></a>' +
            '<a class="btn btn-2 btn-flat mr5"><i class="material-icons">delete</i></a>' +
        '</td>' +
        '</tr>'
    return myFood;
}

$('#submit').on('click', function () {
    var valid = true;

    $.each(checkifvalid, function(i, v){
        if(!$(v).hasClass('valid'))
            valid = false;
    });
    
    if(valid){
        var menu = modal.find('#menu').val().trim(),
            servings = modal.find('#servings').val(),
            remaining = servings,
            cost = modal.find('#cost').val(),
            price = modal.find('#price').val();

        $.confirm({
            title: 'Save Food Menu?',
            content: '',
            buttons: {
                cancel: function () { },
                confirm: function () {
                    $.ajax({
                        url: '../api/Kitchen',
                        type: 'POST',
                        data: {
                            menuName: menu,
                            servings: servings,
                            remaining: remaining,
                            cost: cost,
                            sellingPrice: price
                        },
                        dataType: 'json',
                        success: function (data) {
                            $.confirm({
                                title: 'Menu Succesfully Added',
                                content: '',
                                buttons: {
                                    OK: function () {
                                        loadFoods(1); 
                                        clearmodal();
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
    else{
        displayMessage('Please Validate all fields', '');
    }
})

function clearmodal(){
    $.each(checkifvalid, function(i, v){ $(v).removeClass('valid') });

    modal.find('#menu').val(null);
    modal.find('#servings').val(null);
    modal.find('#cost').val(null);
    modal.find('#price').val(null);
    M.AutoInit();
}
