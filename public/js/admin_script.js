var curpage = 1;
sessionStorage.setItem('cursection', 1);

var $loading = $('.loader').hide();
var $dimScreem = $('#dimScreen').hide();

$(document).ready(function ($) {
    checkNotif();
    jconfirm.defaults = { content : '', theme: 'dark', boxWidth: '35%', useBootstrap: false };
    if ($(".roomTypeDropDown").length){ loadRoomTypesDropdown() }
    $(window).on('load', function () {
        $('.loader').fadeOut('fast', function () { $(this).hide();  });
        $('#dimScreen').fadeOut('fast', function () { $(this).hide(); });
    });

    $('.dropdownArr').on('click', function(){
        $(this).find('.arrow').toggleClass("arrowRotate");
    })
});

$(document).ajaxStart(function () {
    $loading.show();
    $dimScreem.show();
}).ajaxStop(function () {
    $loading.hide();
    $dimScreem.hide();
});

function ckEditorInit(selector){
    CKEDITOR.replace(selector , {
        uiColor: '#d9d9d9'
    });
}

function checkValid(checkifvalid){
    for (i = 0 ; i < checkifvalid.length ; i++) {
        if(!$(checkifvalid[i]).hasClass('valid')){
            return false;
        }
    }
    return true;
}
function checkifValidated(checkifvalid){
    for (i = 0 ; i < checkifvalid.length ; i++) {
        if(!$(checkifvalid[i]).val()){
            return false;
        }
    }
    return true;
}

function clearModal(fields){
    for (i = 0 ; i < fields.length ; i++) {
        $(fields[i]).val('');
        $(fields[i]).removeClass('valid');
    }
}

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

function format_date(date1){
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

    mydate = yyyy + '-' + mm + '-' + dd + ' 00:00:01';
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

function parseDate(str, delimiter) {
    var mdy = str.split(delimiter);
    return new Date(mdy[0], mdy[1] - 1, mdy[2]);
}
function checkdatediff(date1, date2){
    // const diffTime = Math.abs(date2.getTime() - date1.getTime());
    // const diffDays = Math.round(diffTime / (1000 * 60 * 60 * 24)); 
    const _MS_PER_DAY = 1000 * 60 * 60 * 24;

    const utc1 = Date.UTC(date1.getFullYear(), date1.getMonth(), date1.getDate());
    const utc2 = Date.UTC(date2.getFullYear(), date2.getMonth(), date2.getDate());
  
    return Math.floor((utc2 - utc1) / _MS_PER_DAY);
}
function checkdaydiff(first, second) {
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


function checkNotif(){
    $.ajax({
        url: '/api/dashboard/getForCheckout',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            $('.notifbadge').css('padding','0 6px');
            $('.notifbadge').attr('data-badge-caption', data.length);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}