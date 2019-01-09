var curpage = 1;

$(document).ready(function ($) {
    jconfirm.defaults = { content : '', theme: 'dark', boxWidth: '35%', useBootstrap: false };
    if ($(".roomTypeDropDown").length){ loadRoomTypesDropdown() }
});
