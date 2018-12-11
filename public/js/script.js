    // sessionStorage.curpage = 1;
    // var curpage = sessionStorage.curpage;

var $loading = $('.loader').hide();
var $dimScreem = $('#dimScreen').hide();

$(document).ready(function ($) {
    jconfirm.defaults = { theme: 'dark', boxWidth: '35%', useBootstrap: false };
    if ($(".roomTypeDropDown").length){ loadRoomTypesDropdown() }
    $(window).on('load', function () {
        $('.loader').fadeOut('fast', function () { $(this).hide();  });
        $('#dimScreen').fadeOut('fast', function () { $(this).hide(); });
    });  
});

$(document).ajaxStart(function () {
    $loading.show();
    $dimScreem.show();
}).ajaxStop(function () {
    $loading.hide();
    $dimScreem.hide();
});

function getCurrentDate(){
    var d = new Date();

    var month = d.getMonth() + 1;
    var day = d.getDate();

    var currentDate =
         d.getFullYear() + '-' +
        (('' + month).length < 2 ? '0' : '') + month + '-' +
        (('' + day).length < 2 ? '0' : '') + day;

    return currentDate;
}
function getCurdate1(){
    var d = new Date();

    var month = d.getMonth() + 1;
    var day = d.getDate();

    var currentDate =
        (('' + month).length < 2 ? '0' : '') + month + '-' +
        (('' + day).length < 2 ? '0' : '') + day + '-' +
        d.getFullYear();

    return currentDate;
}

function getMyDate(date1){

    var today = new Date(date1);
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    
    if (dd < 10) {
        dd = '0' + dd
    }

    if (mm < 10) {
        mm = '0' + mm
    } 

    mydate = yyyy + '-' + mm + '-' + dd;
    return mydate;
}

function getMyDateTime(date1) {

    var today = new Date(date1);
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd
    }

    if (mm < 10) {
        mm = '0' + mm
    }

    mydate = yyyy + '-' + mm + '-' + dd + ' 23:59:59';
    return mydate;
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

function displayMessage(title, content){
    $.alert({
        title: title,
        content: content,
        theme: 'dark',
        boxWidth: '35%',
        useBootstrap: false,
    });
}

function displayDialog(title, content){
    $.dialog({
        title: title,
        content: content,
        theme: 'material',
        boxWidth: '35%',
        useBootstrap: false,
    });
}
function convert(x){
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function parseDate(str) {
    var mdy = str.split('/');
    return new Date(mdy[2], mdy[0] - 1, mdy[1]);
}

function datediff(first, second) {
    return Math.round((second - first) / (1000 * 60 * 60 * 24));
}

function removeComma(str){
    var mystr = str.replace(",", "");
    return mystr;
}

function loadRoomTypesDropdown(){
    $.ajax({
        url: '../api/RoomTypes',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            $('.roomTypeDropDown').html("");
            $('.roomTypeDropDown').append('<option value="" selected disabled>Room Type</option>');
            for (var i = 0; i < data.data.length; i++) {
                var id = data.data[i].id,
                    type = data.data[i].type
                $('.roomTypeDropDown').append('<option value=' + id + '>' + type +'</option>');
            }
            M.AutoInit();
        }
    });
};


window.onscroll = function () { stickyPageHeader() };

var pageheader = document.getElementById("page-header");

if (document.body.contains(pageheader)){
    var sticky = pageheader.offsetTop;

    function stickyPageHeader() {
        if (window.pageYOffset > sticky) {
            pageheader.classList.add("sticky");
        } else {
            pageheader.classList.remove("sticky");
        }
    }
}
