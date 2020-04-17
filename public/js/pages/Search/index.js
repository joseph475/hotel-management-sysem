$(document).on('click','#searchbtn', search);

function search(){
    let page_title = $('.page-title').attr('page-title');

    switch(page_title){
        case 'Dashboard':
            loadRoomCards(1, '9');
        break
    }
}