$(document).ready(ckEditorInit('description'));
$(document).on('click','.submitRoomType', save);

function save(){
    $('#submitForm').submit();
}