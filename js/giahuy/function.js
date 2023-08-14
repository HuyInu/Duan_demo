function Giahuy_checkdAllCheckBox (numberOfCheckbox, event) {
    if($(event.target)[0].checked === true) {
        for (i = 1;i <= numberOfCheckbox; i++) {
            $('#checkbox'+i).prop('checked', true);
        }
    } else {
        for (i = 1;i <= numberOfCheckbox; i++) {
            $('#checkbox'+i).prop('checked', false);
        }
    }
}

function onlyNumberKey(evt) {
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}