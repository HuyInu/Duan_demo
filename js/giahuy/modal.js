function GiaHuy_openModal(modalID, msg, callbackFunc, urlAction)
{
    if($('#'+modalID).hasClass('hidden'))
    {
        $('#'+modalID).removeClass('hidden')
        $('#'+modalID).removeClass('displayNon')
        $('#'+modalID).children().children().children('.card-body').children('#modal-content')[0].innerText = msg

        GiaHuy_addEventConfirmModal(modalID, callbackFunc,urlAction)
    }
}

function GiaHuy_closeModal(modalID){
    if($('#'+modalID).hasClass('hidden') === false)
    {
        $('#'+modalID).addClass('hidden')
        setTimeout(function () {
            $('#'+modalID).addClass('displayNon')
        }, 301);
    }
}

function GiaHuy_addEventConfirmModal(modalID, actFunction, urlAction)
{
    $('#'+modalID).children().children().children('.card-body').children('.card-action').children('#confirmModal_btn')
    .on('click', function(){
        actFunction(urlAction)
    })
}

function GiaHuy_confirmModal(callbackFunc){
    callbackFunc()
}

