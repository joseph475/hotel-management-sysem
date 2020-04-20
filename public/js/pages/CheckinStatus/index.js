var myFoodList = $('.foodList');
var myExtrasList = $('.ExtrasList');
var addSomethingModal = $('#addFoodsExtrasModal');
var checkin_id = $('.checkin-status-page').attr('data-id');
var tobeCleared = ['#something_quantity']

$(document).on('click','.update_hours', extendTime);
// $(document).ready(loadFoodList);
$(document).ready(loadExtrasList);
$(document).on('click','.addSomething', showAddSomething);
$(document).on('click','.add_something', confirmAddSomething);
$(document).on('click','#submitCheckOut', submitCheckOut);

$('input[name="searchFood"]').keypress(function (e) {
    var key = e.which;
    if (key == 13) { searchFood(); }
});


function confirmAddSomething(){
    var id = addSomethingModal.find('#something_quantity').attr('data-id');
    var quantity = addSomethingModal.find('#something_quantity').val();
    var type = addSomethingModal.find('#something_quantity').attr('data-type');
    var remaining = addSomethingModal.find('#something_quantity').attr('data-count');

    if (parseInt(quantity) > 0){
        if(type === 'Extras'){
            $.ajax({
                url: '../api/AddExtras',
                type: 'post',
                data:{
                    checkinId : checkin_id,
                    extrasId : id,
                    quantity : quantity
                },
                dataType: 'json',
                success: function (data) {
                    M.toast({html: 'Added Succesfully'});
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
        else{
            if(parseInt(remaining) > parseInt(quantity)){
                $.ajax({
                    url: '../api/AddFoods',
                    type: 'post',
                    data:{
                        checkinId : checkin_id,
                        foodsId : id,
                        quantity : quantity
                    },
                    dataType: 'json',
                    success: function (data) {
                        M.toast({html: 'Added Succesfully'});
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
            else{
                M.toast({html: 'Remaining servings not enough'});
                clearModal(tobeCleared);
            }
        }
    }
    else{
        M.toast({html: 'Invalid Quantity'});
    }
    
    
}

function searchFood(){
    let search = $('input[name="searchFood"]').val();
    $.ajax({
        url: '../api/Kitchen/getPublishedFoods',
        type: 'get',
        dataType: 'json',
        data:{
            search: search  
        },
        success: function (data) {
            loopFoodlist(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function loadExtrasList(){
    $.ajax({
        url: '../api/Extras/getPublishedExtras',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopExtraslist(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function loopExtraslist(data) {
    myExtrasList.html("");
    for (var i = 0; i < data.length; i++) {
        var id = data[i].id
            description = data[i].description,
            cost = data[i].cost,
            myExtrasList.append(createExtrasList(id, description, cost));
    }
}

function loopFoodlist(data) {
    myFoodList.html("");
    for (var i = 0; i < data.length; i++) {
        var id = data[i].id
            menuName = data[i].menuName,
            remaining = data[i].remaining,
            sellingPrice = data[i].sellingPrice
            myFoodList.append(createFoodList(id, menuName, remaining, sellingPrice));
    }
}

function createExtrasList(id, description, cost) {
    var myExtras = '<li data-id="'+ id +'" data-count="0" data-name="'+ description +'" data-type="Extras">' + description + 
                        '<span class="right">&#8369;' + cost +
                            '<a href="#addFoodsExtrasModal" class="addbtn ml30 addSomething modal-trigger">' +
                                '<i class="far fa-plus-square fa-lg"></i>' +
                            '</a>' +
                        '</span>' +
                  '</li>';
    return myExtras;
}

function createFoodList(id, menuName, remaining, sellingPrice) {
    var myFood = '<li data-id="'+ id +'" data-name="'+ menuName +'" data-count="'+ remaining +'" data-type="Foods">' + menuName + 
                        '<span class="right">&#8369;' + sellingPrice +
                            '<a href="#addFoodsExtrasModal" class="addbtn ml30 addSomething modal-trigger">' +
                                '<i class="far fa-plus-square fa-lg"></i>' +
                            '</a>' +
                        '</span>' +
                  '</li>';
    return myFood;
}

function extendTime(){
    var rate_id = $('input[name=roomRate]:checked').attr('data-id');
    var hours = $('input[name=roomRate]:checked').val();
    $.ajax({
        url: '../api/ExtendTime',
        type: 'POST',
        data: {
            checkin_id : checkin_id,
            rate_id: rate_id,
            hours: hours
        },
        dataType: 'json',
        success: function (data) {
            M.toast({html: 'Check-out Time Extended'});
            location.reload();
        },
        error: function (aaa, bbb, ccc) {
            console.log(aaa + "-" + bbb + "-" + ccc);
        }
    });
}

function showAddSomething(){
    var id = $(this).closest('li').attr('data-id');
    var name = $(this).closest('li').attr('data-name');
    var type = $(this).closest('li').attr('data-type');
    var remaining = $(this).closest('li').attr('data-count');

    addSomethingModal.find('h4').html('Add ' + name);
    addSomethingModal.find('#something_quantity').attr('data-id', id);
    addSomethingModal.find('#something_quantity').attr('data-type', type);
    addSomethingModal.find('#something_quantity').attr('data-count', remaining);
    if(addSomethingModal.find('#something_quantity').attr('data-type') == "Foods"){
        addSomethingModal.find('#something_quantity').attr('placeholder', 'Remaining (' + remaining + ') servings');
    }
    else{
        addSomethingModal.find('#something_quantity').attr('placeholder', '');
    }
    
}

function submitCheckOut(){
    // alert(checkin_id);
    $.confirm({
        title: 'Confirm checkout?',
        content: '',
        buttons: {
            cancel: function () { },
            confirm: function () {
               window.open("../api/Checkout/" + checkin_id);
               window.location = "/";
            }
        }
    });
}