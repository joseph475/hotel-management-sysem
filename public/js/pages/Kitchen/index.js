var mytable = $('#foodTable');
var modal = $('#AddMenuModal');
var checkifvalid = ['#menu', '#servings', '#cost', '#price'];

$(document).ready(loadFoods(curpage));
$(document).on('click', '.changeStatus', changeStatus);
$(document).on('click', '.deleteFood', deleteFood);

function loadFoods(curpage, search = '') {
    $.ajax({
        url: 'api/Kitchen',
        data:{
            page: curpage,
            search: search 
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
            sellingPrice = data[i].sellingPrice,
            ispublished = data[i].ispublished
            mytable.append(createFoodTable(id, menuName, servings, remaining, cost, sellingPrice, ispublished));
    }
}

function createFoodTable(id, menuName, servings, remaining, cost, sellingPrice, ispublished) {
    var myFood = '<tr data-id="'+ id +'">' +
        '<td>' + menuName + '</td>' +
        '<td>' + servings + '</td>' +
        '<td>' + remaining + '</td>' +
        '<td>' + cost + '</td>' +
        '<td>' + sellingPrice + '</td>' +
        '<td class="actionButtons">' +
            '<a class="btn btn-2 btn-flat mr5 changeStatus">'; 
                if(parseInt(ispublished) == 1){
                    myFood += '<i class="far fa-eye"></i>';
                }
                else{
                    myFood += '<i class="far fa-eye-slash"></i>';
                }
            myFood += '</a>' +
            '<a class="btn btn-2 btn-flat mr5 deleteFood"><i class="far fa-trash-alt"></i></a>' +
        '</td>' +
        '</tr>'
    return myFood;
}

$('#submit').on('click', function () {
    if(checkValid(checkifvalid)){
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
                            M.toast({html: 'Food Added Succesfully'});
                            loadFoods(1); 
                            clearmodal();
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

function changeStatus(){
    var id = $(this).closest('tr').attr('data-id');
    var icon = $(this).find('i');
    var ispublished = 0;
    
    icon.hasClass('fa-eye')? ispublished = 0 : ispublished = 1;

    $.ajax({
        url: '../api/Kitchen',
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
function deleteFood(){
    var tr = $(this).closest('tr')
    var id = tr.attr('data-id');
    
    $.confirm({
        title: 'Delete Food Menu?',
        buttons: {
            cancel: function () { },
            confirm: function () { 
                $.ajax({
                    url: '../api/Kitchen/' + id,
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

    modal.find('#menu').val(null);
    modal.find('#servings').val(null);
    modal.find('#cost').val(null);
    modal.find('#price').val(null);
    M.AutoInit();
}
