@extends('layouts.master')
@section('content')
    <section class="content">
        <!--giỏ hàng-->
        <br>
        <h2 class="text-center">GIỎ HÀNG CỦA BẠN</h2>
        <form action="{{ route('cart.checkout') }}" method="post">
            {{ @csrf_field() }}
        <div class="container">

            @if(session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                        </ul>
                    </div>
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

                <?php if(Cart::count() >0) : ?>

            <h2><?php echo Cart::count(); ?> mặt hàng trong giỏ hàng</h2>
            <table class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th style="width:40%">Tên sự kiện</th>
                    <th style="width:20%">Giá vé</th>
                    <th style="width:10%">Số lượng</th>
                    <th style="width: 20%" class="text-center">Thành tiền</th>
                    <th style="width:10%"></th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0;
                $total = 0;
                ?>
                <?php foreach(Cart::content()  as $key=> $cart) :?>
                {{--<input type="hidden" name="event_id[]" value="{{ $cart->id }}">--}}
                <tr>
                    <?php $i++;
                        $total += $cart->options->total;
                    ?>
                    <td data-th="Product">

                        <div class="row">
                            <div class="col-sm-12 hidden-xs"><img src="{{ $cart->options->avatar }}" alt="Sản phẩm 1"
                                                                 class="img-responsive" width="120%">
                            </div>
                            <div class="col-sm-12">
                                <h4 class="nomargin" style="text-align: center">{{ $cart->name }}</h4>
                                <label>Địa điểm : {{$cart->options->location_detail }}</label>

                            </div>
                        </div>
                    </td>


                    <td data-th="Price" name="price">{{ number_format($cart->price) }} VNĐ</td>
                    <td data-th="Quantity">

                        <label class="form-control text-center"  id="number-of-ticket{{$i}}" type="number">{{ $cart->options->number_of_ticket }}</label>
                        {{--<input type="hidden" name="number_of_ticket[]" value="{{ $cart->options->number_of_ticket }}>--}}
                    </td>
                    <td data-th="Subtotal" class="text-center">{{ number_format($cart->options->total) }} VNĐ</td>
                    <td class="actions" data-th="">
                        {{--<a  class="btn btn-info btn-sm" id="edit-btn" onclick="changeStatus({{$i}})"><i class="fa fa-edit"></i>--}}
                        {{--</a>--}}
                        <a href="{{route('cart.destroy',$key)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td><a href="{{ route('events.index') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Tiếp tục mua hàng</a>
                    </td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>Tổng tiền {{number_format($total)}} VNĐ</strong>
                    </td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#myModal"
                                class="btn btn-large btn-block btn-primary btn-checkout">
                            Thanh toán khi nhận hàng
                        </button>
                        <button type="button" data-toggle="modal" data-target="#modalOnline" class="btn btn-large btn-block btn-success btn-checkout">
                            Thanh toán trực tuyến
                        </button>
                    </td>
                </tr>
                </tfoot>
            </table>
                    <?php else: ?>
                    <h3>Không có mặt hàng nào trong giỏ hàng</h3>
                    <?php endif; ?>
        </div>
        <!--Modal-->
        <div id="myModal" style="z-index: 999999 " class="modal fade" role="dialog">
            <div class="modal-dialog" style="max-width:80%">

                <!-- Modal content-->
                <div class="modal-content " style="opacity: 0.95">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-shopping-cart"></i> Thông tin thanh toán</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body" style="">


                            {{--<input type="hidden" name="book_id" value="{{ $cart->id }}">--}}

                            <input type="hidden" name="date_order" value="">

                            {{--<input type="hidden" name="event_id[]" value="{{$key->event_id}}">--}}

                            <input type="hidden" name="total_price" value="{{$total}}">
                            <input type="hidden" name="member_id" value="{{$cart->options->member_id}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><strong>Họ tên</strong></label>
                                        <input type="text" class="form-control" id="name" placeholder="Nhập họ tên"
                                               name="name" value="" required="" minlength="3">
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for=""><strong>Địa chỉ</strong></label>
                                        <input type="text" class="form-control" id="address" placeholder="Nhập địa chỉ"
                                               name="address" value="" minlength="10" required="">
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for=""><strong>Số điện thoại</strong></label>
                                        <input type="text" class="form-control" id="phone"
                                               placeholder="Nhập số điện thoại" name="number_phone" value="" minlength="9"
                                               required="">
                                    </div>
                                </div>


                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for=""><strong>Email</strong></label>
                                        <input type="email" class="form-control" id="email" placeholder="Nhập email"
                                               name="email" value="datnq.fuhl@gmail.com" required="">
                                    </div>
                                </div>




                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for=""><strong>Ghi chú</strong></label>
                                        <input type="text" class="form-control" id="note" placeholder="Nhập ghi chú"
                                               name="note" value="">
                                    </div>
                                </div>

                            </div>


                            {{--<div id="recaptcha" class="g-recaptcha"--}}
                                 {{--data-sitekey="6LdiZWIUAAAAAEOWtPTwWwYWEsS9AbnkMoqD0ppc">--}}
                                {{--<div style="width: 304px; height: 78px;">--}}
                                    {{--<div>--}}
                                        {{--<iframe src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LdiZWIUAAAAAEOWtPTwWwYWEsS9AbnkMoqD0ppc&amp;co=aHR0cDovL3B0by5kZXZtYXN0ZXIuZWR1LnZuOjgw&amp;hl=en&amp;v=v1542004393985&amp;size=normal&amp;cb=gjf0lr47l429"--}}
                                                {{--width="304" height="78" role="presentation" name="a-pm8u6wso9nl8"--}}
                                                {{--frameborder="0" scrolling="no"--}}
                                                {{--sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe>--}}
                                    {{--</div>--}}
                                    {{--<textarea id="g-recaptcha-response" name="g-recaptcha-response"--}}
                                              {{--class="g-recaptcha-response"--}}
                                              {{--style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <span class="msg-error error"></span>
                            <br>
                            <button type="submit" class="btn btn-primary">Thanh Toán</button>

                    </div>
                </div>
            </div>
        </div>
        </form>
        <!--end giỏ hàng--> <div id="modalOnline" style="z-index: 999999 " class="modal fade" role="dialog">
            <div class="modal-dialog" style="max-width:80%">

                <!-- Modal content-->
                <div class="modal-content " style="opacity: 0.95;margin-top: 150px;">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-shopping-cart"></i> Thanh toán online </h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body" style="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for=""><strong>Hệ thống đang trong quá trình bảo trì và cập nhât. Vui lòng sử dụng chức năng thanh toán offline</strong></label>
                                </div>

                            </div>
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for=""><strong>Xin lỗi vì sự bất tiện này !</strong></label>
                                </div>
                            </div>

                        </div>
                        <a href="showCart.html" class="btn btn-primary">Tôi đồng ý</a>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
{{--@push('footer')--}}
    {{--<script>--}}
    {{--function changeStatus(number){--}}
        {{--var editEle = document.getElementById('number-of-ticket'+number);--}}
        {{--editEle.contentEditable="true";--}}
        {{--editEle.focus();--}}
    {{--}--}}

    {{--</script>--}}
{{--@endpush--}}