function createPagination(data, returnCall, search) {
    $('#paginationUL').html("");
    var totalPage = parseInt(data);
    if(totalPage > 1){
        for (i = 1; i <= totalPage; i++) {
            $('#paginationUL').append(
                '<li>' +
                    `<button class="btn-pageLinks waves-effect waves-light" id="page_${i}" onclick="${returnCall}( ${i}, '${search}' )" >` +
                    `${i}` +
                    '</button>' +
                '</li>'
            )
        }
    }
}