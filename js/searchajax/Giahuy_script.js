function Giahuy_componentLookup (path_url, act, inputString) {
    const actURL = path_url+'/ajax/Giahuy_ajax.php';
    if(inputString !== '') {
        $.post(
            actURL,
            {
                act: act,
                inputString: inputString
            },
            function (data) {
                $('#suggestions').html(data);
                $('#suggestions').fadeIn();
            }
        )
    }
}