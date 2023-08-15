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

function onlyNumberKey (evt) {
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}

function Giahuy_SubmitFrom(submitElement) {
    
    var form = $(submitElement).closest('form')[0];
    if (form[0].value == '') {
        alert('Vui lòng nhập vào tên');
		form[0].focus();
		return false;
    } else {
        form.submit();
    }
}

function Giahuy_disable_Componet_TextBox(thisCheckBox) {
    var disabled;
    if($(thisCheckBox)[0].checked === true) {
        disabled = true;
    } else {
        disabled = false;
    }
    $('#namecomp').prop('disabled', disabled)
}