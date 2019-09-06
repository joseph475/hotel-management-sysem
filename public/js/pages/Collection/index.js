var mytable = "";

// for todays collection
var datenowfrom = getMyDate(getCurdate1());
var datenowto = getMyDateTime(getCurdate1());
var dateFrom = getMyDate($('#fromdate').val());
var dateTo = getMyDateTime($('#todate').val());

$(document).ready(loadCollections(curpage));
$(document).on('click','.printReceipt', printReceipt);
$(document).on('click','.printReport', printReport);

$('.filterlist').on('click',filterlist);

function loadCollections(curpage) {
    $.ajax({
        url: 'api/Collections',
        data:{
            page: curpage,
            dateFrom: datenowfrom,
            dateTo: datenowto
        },
        type: 'get',
        dataType: 'json',
        success: function (data) {
            loopCollectionDetailsDaily(data.collections.data);
            loopCollectionDetailsRange(data.collections.data);
            $('.total_collectionDaily').html('Collections: ');
            if(data.total_collections[0].total){
                $('.total_collectionDaily').append('&#8369;' + convert(data.total_collections[0].total));
                $('.total_collectionRange').append('&#8369;' + convert(data.total_collections[0].total));
            }
            $.getScript("js/pagination.js", function () {  // load pagination
                createPagination(data.last_page, "loadCollections");
                $('#page_' + curpage).addClass("activePage");
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
};

function loopCollectionDetailsDaily(data) {
    let mytable = $('#DailyTable');
    mytable.html("");
    for (var i = 0; i < data.length; i++) {
        var id = data[i].id
            ORNumber = data[i].ORNumber,
            checkin_id = data[i].checkInId,
            collection = data[i].collection
            date_collected = data[i].date_collected
            mytable.append(createCollectionsTable(ORNumber, checkin_id, collection, date_collected));
    }
}
function loopCollectionDetailsRange(data) {
    let mytable = $('#RangeTable');
    mytable.html("");
    for (var i = 0; i < data.length; i++) {
        var id = data[i].id
            ORNumber = data[i].ORNumber,
            checkin_id = data[i].checkInId,
            collection = data[i].collection
            date_collected = data[i].date_collected
            mytable.append(createCollectionsTable(ORNumber, checkin_id, collection, date_collected));
    }
}

function createCollectionsTable(ORNumber, checkin_id, collection, date_collected) {
    var myCollection = '<tr data-id="'+ checkin_id +'">' +
        '<td>' + ORNumber + '</td>' +
        '<td>' + collection + '</td>' +
        '<td>' + format_date(date_collected) + '</td>' +
        '<td>' +
            '<a class="btn btn-2 btn-flat mr5 printReceipt"><i class="material-icons">print</i></a>' +
        '</td>' +
        '</tr>'
    return myCollection;
}

function printReceipt(){
    var id = $(this).closest('tr').attr('data-id');
    window.open("../api/Collections/Receipt/" + id);
}
function printReport(){
    var type =  $(this).attr('report-type');

    if(type === 'daily'){
        dateFrom = getMyDate(getCurrentDate());
        dateTo = getMyDateTime(getCurrentDate());
    }
    else{
        dateFrom = getMyDate($('#fromdate').val());
        dateTo = getMyDateTime($('#todate').val());
    }
    window.open("../api/Collections/Report/"+ type + "/From/" + dateFrom + "/To/" + dateTo);
}
// function printRangeReport(){

// }

function filterlist(){
    let dateFrom = getMyDate($('#fromdate').val());
    let dateTo = getMyDateTime($('#todate').val());
    var date1 = new Date(dateFrom);
    var date2 = new Date(dateTo);
    
    if(date2.getTime() > date1.getTime()){
        $.ajax({
            url: 'api/Collections',
            data:{
                page: curpage,
                dateFrom: dateFrom,
                dateTo: dateTo
            },
            type: 'get',
            dataType: 'json',
            success: function (data) {
                loopCollectionDetailsRange(data.collections.data);
                $('.total_collectionRange').html('Collections: ');
                $('.datedisplay').html(`From: ${ $('#fromdate').val() } &nbsp; &nbsp; To: ${ $('#todate').val() } `);
                if(data.total_collections[0].total){
                    $('.total_collectionRange').append('&#8369;' + convert(data.total_collections[0].total));
                }
                $.getScript("js/pagination.js", function () {  // load pagination
                    createPagination(data.last_page, "loadCollections");
                    $('#page_' + curpage).addClass("activePage");
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
    else{
        M.toast({html: 'Date To must be higher'});
    }
}