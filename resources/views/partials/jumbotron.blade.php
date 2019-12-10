<section class="container-fluid body">
    <div id="carouselExampleIndicators" class="carousel slide">
        <!-- carousel content -->
        <div class="carousel-inner">
            <!-- first slide -->
            @foreach($g_slides as $slide)
                <div class="carousel-item {{$slide->is_on_top == 1 ? 'active':''}}">
                    <img class="d-block w-100" src="{{url($slide->url)}}" alt="First slide">
                    <div class="carousel-caption d-md-block">
                        <h3 data-animation="animated bounceInLeft">
                            Đẳng Cấp - Chuyên Nghiệp
                        </h3>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- controls -->
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
<!-- login -->
<section>
    <div class="user-modal">
        <div class="user-modal-container">
            <ul class="switcher">
                <li><a href="#">Đăng Nhập</a></li>
                <li><a href="#">Đăng Ký</a></li>
            </ul>
            <div id="login">
                <form id="login_Form" class="form" method="POST" action="{{ route('authen')}}">
                    <input type="hidden" class="authen" value="{{ route('authen') }}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <p class="fieldset">
                        <label id='email' class="image-replace email validate[required, custom[email_Required], custom[email_Type]]" for="signin-email">E-mail</label>
                        <input class="full-width has-padding has-border" id="authen-email" type="email" placeholder="E-mail" value="{{ old('email') }}" name="email">
                    </p>

                    <p class="fieldset">
                        <label class="image-replace password" for="signin-password">Mật Khẩu</label>
                        <input class="full-width has-padding has-border validate[required, custom[password_Required], custom[password_Not_Spacing]]" id="authen-password" type="password" placeholder="Mật khẩu" name="password">
                        <a href="#0" class="hide-password">Hiện</a>
                    </p>

                    <p class="fieldset" >
                        <input type="checkbox" name="remember" id="remember-me" checked value="{{ old('remember') ? 'checked' : '' }}">
                        <label for="remember-me">Ghi nhớ</label>
                    </p>

                    <p class="fieldset">
                    <button id="btnSignIn" type="button" class="btn btn-secondary btn-lg btn-block" form="login_Form">Đăng Nhập</button>
                    </p>
                    <p class="form-bottom-message"><a href="{{ route('password.request') }}">Quên mật khẩu?</a></p>
                </form>

            </div>
            <!-- --------------------------------- SIGN IN----------------------------------------------------- -->
            <input type="hidden" class="check-exit-email" value="{{ route('check-exit-email') }}">
            <input type="hidden" class="sign-in" value="{{ route('sign-in') }}">
            <div id="signup">
                <form id="sign_In_Form" class="form" method="POST" action="{{ route('sign-in') }}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <p class="fieldset">
                        <label class="image-replace username" for="signup-username">Họ và Tên :</label>
                        <input class="full-width has-padding has-border validate[required, custom[fullName_Required]]" id="fullName" name="name" type="text" placeholder="Họ và tên đệm" value="{{ old('name') }}">
                    </p>
                    <p class="fieldset">
                        <label class="image-replace email" for="signup-email">E-mail</label>
                        <input class="full-width has-padding has-border validate[required, custom[email_Required], custom[email_Type]]" id="email_signin" type="email" placeholder="E-mail" value="{{ old('email') }}" name="email_signin">
                    </p>
                    <p class="fieldset">
                        <label class="image-replace password" for="signup-password">Mật khẩu</label>
                        <input class="full-width has-padding has-border validate[required,minSize[6], custom[password_Required], custom[password_Not_Spacing]]" id="password" type="password"  placeholder="Mật khẩu" name="password">
                        <a href="#0" class="hide-password">Hiện</a>
                    </p>
                    <p class="fieldset">
                        <label class="image-replace password" for="signup-password"> Nhập Lại Mật khẩu</label>
                        <input class="full-width has-padding has-border validate[equals[password]]" id="confirm_password" type="password" placeholder="Nhập Lại Mật khẩu" name="password_confirmation" >
                        <a href="#0" class="hide-password">Hiện</a>
                    </p>
                    <p class="fieldset">
                        <button id="btnLogin" type="button" class="btn btn-secondary btn-lg btn-block" form="sign_In_Form">Đăng kí</button>
                    </p>
                </form>

                <!-- <a href="#0" class="cd-close-form">Close</a> -->
            </div>

            <div id="reset-password">
                <p class="form-message">Quên mật khẩu? Vui lòng nhập địa chỉ email của bạn.
                    <br> Bạn sẽ nhận được một liên kết để tạo mật khẩu mới.</p>

                <form class="form" id="reset_Pass_Form">
                    <p class="msg_success" style="display:none;">
                        <span style="color:seagreen;">Mật khẩu đã được cập nhật, vui lòng kiểm tra email</span>
                    </p>
                    <p class="fieldset">
                        <label class="image-replace email validate[required, custom[email_Required], custom[email_Type]]" for="reset-email">E-mail</label>
                        <input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">
                        <span class="error-message reset_pass_error">Tài khoản không tồn tại!</span>
                    </p>

                    <p class="fieldset">
                        <input id="email_reset_pass" class="full-width has-padding button_reset_pass" type="submit" data-url="{{ route('reset-pass') }}" value="Gửi yêu cầu">
                    </p>
                </form>

                <p class="form-bottom-message">
                    <a href="#0">Quay lại trang đăng nhập
                    </a>
                </p>
            </div>
            <!-- <a href="#0" class="close-form">Đóng</a> -->
        </div>
    </div>
</section>
