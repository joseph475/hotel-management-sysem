var checkifvalid = ['#roomNo'];

$(document).on('click','.printReport', function(){
    let reportType = $(this).attr('report-type');
    if(reportType == 'per-room'){
        if(checkifValidated(checkifvalid)){
            let roomNo = $('#roomNo').val();
            window.open("../api/InventoryStatus/" + roomNo);
        }
        else{ displayMessage('Please Input Room No.', ''); }
    }
    else{
        window.open("../api/InventoryStatus/");
    }
})