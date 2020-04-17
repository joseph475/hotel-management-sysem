$(document).on('click', '.changeSection', changeSection);
cursection = sessionStorage.getItem('cursection');

function createPagination(data, returnCall, search, cursection = 1) {
    curpage = sessionStorage.getItem('curpage');

    $('#paginationUL').html("");
    var totalPage = parseInt(data);
    var pagepersection = 3;
    var section = Math.ceil(totalPage / pagepersection);

    // alert(cursection);

    if(totalPage > 1){
        $('#paginationUL').append(
            '<li>' +
                `<a class="btn btn-small btn-2 border-1 waves-effect waves-light black-text ${curpage == 1? 'disabled': ''}" onclick="${returnCall}( ${parseInt(curpage) - 1}, '${search}' )"><</a>`+
            '</li>'
        );
        for (i = (cursection * pagepersection -2);
             i <= (pagepersection > totalPage)? totalPage : pagepersection;
             i++) {
            $('#paginationUL').append(
                '<li>' +
                    `<btn href="" class="btn btn-2 btn-small border-1 waves-effect waves-light" id="page_${i}" onclick="${returnCall}( ${i}, '${search}' )" >` +
                    `${i}` +
                    '</btn>' +
                '</li>'
            )
        }
        $('#paginationUL').append(
            '<li>' +
                `<a class="btn btn-small btn-2 border-1 waves-effect waves-light black-text ${(parseInt(curpage) >= totalPage)? 'disabled': ''}" onclick="${returnCall}( ${parseInt(curpage) + 1}, '${search}' )">></a>`+
            '</li>'
        );
        $('#paginationUL').append(
            '<li>' +
                `<a class="btn btn-small btn-2 border-1 waves-effect waves-light black-text" onclick="changeSection(${ data }, ${ returnCall }, ${ search })">>></a>`+
            '</li>'
        );
    }
}

function changeSection(data, returnCall, search){
    sessionStorage.setItem('cursection', parseInt(cursection) + 1);
    cursection = sessionStorage.getItem('cursection');
    createPagination(data, returnCall, search, cursection);
}