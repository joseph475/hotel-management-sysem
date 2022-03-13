$(document).on('click', '.changeSection', changeSection);

var pagepersection = 8;
var offset = pagepersection - 1;
var sectionpage = 1;

function createPagination(data, returnCall, search, cursection = 1) {
    $('#paginationUL').html("");

    curpage = sessionStorage.getItem('curpage');
    cursection = sessionStorage.getItem('cursection');

    sectionpage = (parseInt(cursection) * pagepersection - offset);
    var backsectionpage = ((parseInt(cursection) - 1) * pagepersection - offset);

    var totalPage = parseInt(data);
    var section = Math.ceil(totalPage / pagepersection);
    var limit = (totalPage < pagepersection)? totalPage : pagepersection;

    limit = limit * parseInt(cursection);
    limit = limit > totalPage? totalPage : limit;

    if(totalPage > 1){
        $('#paginationUL').append(
            '<li>' +
                `<a class="btn btn-small btn-2 border-1 waves-effect waves-light black-text ${(parseInt(cursection) == 1)? 'disabled': ''}" onclick="changeSection(${ data }, '${ returnCall }', '${ search }', '${ parseInt(cursection) - 1 }', '${ backsectionpage }', 'previous')"><<</a>`+
            '</li>'
        );
        for (i = ((sectionpage < 1)? 1 : sectionpage);
             i <= limit;
             i++) {
            $('#paginationUL').append(
                '<li>' +
                    `<a class="btn btn-2 btn-small border-1 waves-effect waves-light" id="page_${i}" onclick="${returnCall}( ${i}, '${search}' )" >` +
                    `${i}` +
                    '</a>' +
                '</li>'
            )
        }
        $('#paginationUL').append(
            '<li>' +
                `<a class="btn btn-small btn-2 border-1 waves-effect waves-light black-text ${(parseInt(cursection) >= section)? 'disabled': ''}" onclick="changeSection(${ data }, '${ returnCall }', '${ search }', '${ cursection }', '${ sectionpage }', 'next')">>></a>`+
            '</li>'
        );
    }
}

function changeSection(data, returnCall, search, cursection, sectionpage, move){
    
    if(move == "next"){
        sessionStorage.setItem('cursection', parseInt(cursection) + 1);
        cursection = sessionStorage.getItem('cursection');
        sectionpage = (parseInt(cursection) * pagepersection - offset)
    }
    else{
        sessionStorage.setItem('cursection', parseInt(cursection));
        cursection = sessionStorage.getItem('cursection');
        ((parseInt(cursection) - 1) * pagepersection - offset)
    }
    
    // sectionpage = (move == "next")? sectionpage = (parseInt(cursection) * pagepersection - offset) : ((parseInt(cursection) - 1) * pagepersection - offset);
    
    
    createPagination(data, returnCall, search, cursection);
    window[returnCall](sectionpage, search);
}