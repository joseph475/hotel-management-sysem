var curpage = 1;

$(document).ready(function ($) {
    jconfirm.defaults = { content: '', theme: 'dark', boxWidth: '35%', useBootstrap: false };
    if ($(".roomTypeDropDown").length) { loadRoomTypesDropdown() }
});

function checkifValidated(checkifvalid) {
    for (i = 0; i < checkifvalid.length; i++) {
        if (!$(checkifvalid[i]).val()) {
            return false;
        }
    }
    return true;
}

function checkValid(checkifvalid) {
    for (i = 0; i < checkifvalid.length; i++) {
        if (!$(checkifvalid[i]).hasClass('valid')) {
            return false;
        }
    }
    return true;
}

function displayMessage(title, content) {
    $.alert({
        title: title,
        content: content,
        theme: 'dark',
        boxWidth: '35%',
        useBootstrap: false,
    });
}
