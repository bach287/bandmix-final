$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    // event click buttun btnLogin
    $("#btnLogin").click(function () {
        if ($("#sign_In_Form").validationEngine('validate')) {
            check_exit();
        }
    });
    // $("#password").oninvalid(function () {
    //     this.setCustomValidity('Hãy nhập ít nhất 6 ký tự');
    // });

    
    /**
     *  Check exit email
     */
    function check_exit() {
        let url = $('.check-exit-email').val();
        let email = $("#email_signin").val();
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'email': email
            },
            success: function (response) {
                if (response && response.user_item.length == 0) {
                    sign_In();
                } else {
                    jConfirm('Email đã tồn tại, vui lòng nhập email khác', 'Thông báo', function (status) {});
                }
            },
            error: function (error) {}
        });
    }

    /**
     *  Sign IN
     */
    function sign_In() {
        let url = $('.sign-in').val();
        let name = $("#fullName").val();
        let email = $("#email_signin").val();
        let password = $("#password").val();
        let password_confirmation = $("#confirm_password").val();
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'name': name,
                'email': email,
                'password': password,
                'password_confirmation': password_confirmation
            },
            success: function (response) {
                if (response && response.MESSAGE != null) {
                    jConfirm(response.MESSAGE, 'Thông báo   ', function (status) {
                        if(status) {
                            window.location.href = "/";
                        }
                    });
                }
            },
            error: function (error) {}
        });
    }
    
    // event click buttun btnLogin
    $("#btnSignIn").click(function () {
        if ($("#btnSignIn").validationEngine('validate')) {
            login();
        }
    });

    /**
     *  Check login
     */
    function login() {
        let url = $('.authen').val();
        let password = $("#authen-password").val();
        let email = $("#authen-email").val();
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'email': email,
                'password': password
            },
            success: function (response) {
                if (response && response.MESSAGE) {
                    window.location.reload();
                } else {
                    jConfirm('Email hoặc mật khẩu không đúng? Vui lòng nhập lại?', 'Thông báo', function (status) {});
                }
            },
            error: function (error) {}
        });
    }
});