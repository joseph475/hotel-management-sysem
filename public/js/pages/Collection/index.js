var mytable = $('#ORTable');
var dateFrom = getMyDate($('#fromdate').val());
var dateTo = getMyDateTime($('#todate').val());

$(document).ready(loadCollections(curpage));

function loadCollections(curpage) {
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
            loopCollectionDetails(data.data);
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

function loopCollectionDetails(data) {
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
            '<a class="btn btn-2 btn-flat mr5 changeStatus"><i class="material-icons">print</i></a>' +
        '</td>' +
        '</tr>'
    return myCollection;
}
