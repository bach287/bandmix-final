
<footer class="page-footer font-small stylish-color-dark pt-4">
    <div class="contact row">
        <div class="col-md-8">
            <div class="well well-sm contactleft">
                <h5> Liên hệ với chúng tôi :</h5>
                <form action="{{route('feedback.store')}}" method="POST">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="guest_name" class="form-control" id="name" placeholder="Họ và Tên" required="required" />
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <input type="email"  name="email" class="form-control" id="name" placeholder="Địa chỉ Email" required="required" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <input type="text" name="feedback_title" class="form-control" id="name" placeholder="Tiêu đề Thư" required="required" />
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-6">
                            <div class="form-group">
										<textarea name="feedback_body" id="message" class="form-control" rows="4" cols="25" required="required"
                                                  placeholder="Nội dung"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                                Gửi </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <form>
                <legend><span class="glyphicon glyphicon-globe"></span>Địa Chỉ : </legend>
                <address>
                    <strong> BandMix</strong><br>
                    Đại học FPT, khu công nghệ cao Hoà Lạc<br>
                    Km 29, Đại Lộ Thăng Long, xã Thạch Hoà, huyện Thạch Thất, TP Hà Nội<br>
                    <strong>Phone :</strong>
                    (+84) 962717143 <br>
                    <strong>Email:</strong>
                    <a href="mailto:#">bandmixvn@gmail.com</a>
                </address>

            </form>
        </div>

    </div> <!-- row -->
    <!-- Social buttons -->
    <section class="footer page-footer font-small special-color-dark pt-4">

        <!-- Footer Elements -->
        <div class="container-fluid">

            <!-- Social buttons -->
            <ul class="list-unstyled list-inline text-center">
                <li class="list-inline-item">
                    <a class="btn-floating btn-fb mx-1">
                        <i class="fa fa-facebook"> </i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-tw mx-1">
                        <i class="fa fa-twitter"> </i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-gplus mx-1">
                        <i class="fa fa-google-plus"> </i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-li mx-1">
                        <i class="fa fa-linkedin"> </i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-dribbble mx-1">
                        <i class="fa fa-dribbble"> </i>
                    </a>
                </li>
            </ul>
            <!-- Social buttons -->
        </div>
        <div class="footer-copyright text-center py-3">© 2018 Copyright:
            <a href="#"> BandMixvn.com</a>
        </div>
        <!-- Copyright -->
    </section>
    <!-- Footer -->
</footer>