$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    $("#id_info").show();
    $("#change_pass").hide();

    /**
     * Method show hide when user click to button change pass
     */
    $("#changePass").click(function () {
        $("#id_info").hide();
        $("#change_pass").show();
    });

    /**
     * Method change password
     */
    $("#btnChangPass").click(function (e) {
        e.preventDefault()
        $('.msg_error_rp').hide()
        if ($("#change_Pass_Form").validationEngine('validate')) {
            let url = $(this).data('url')
            let old_pass = $('#old_pass').val()
            let new_pass = $('#new_pass').val()
            let new_pass_confirm = $('#re_pass').val()
            if(new_pass != new_pass_confirm) {
                $('.msg_error_rp').html('mat khau khong khop')
                $('.msg_error_rp').show()
            } else {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                    'old_pass' : old_pass,
                    'new_pass' : new_pass
                    },
                    success: function (response) {
                        if(response.status == 'error') {
                            $('.msg_error_rp').html(response.msg)
                            $('.msg_error_rp').show()
                        } else {
                            $('.msg_success').show()
                            setTimeout(function() {
                            $('.msg_success').hide()
                            }, 5000)
                        }              
                    }
                });
            }
        }
    });
});