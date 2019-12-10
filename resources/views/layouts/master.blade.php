<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BandMix</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/css.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/loginCss.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/libs/validationEngine.jquery.css') }}">
    <link rel="stylesheet" href="{{asset('css/libs/jquery.alerts.css') }}">
    <link rel="stylesheet" href="{{ url('http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css') }}">
    {{--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">--}}

    @stack('header')
</head>
<body onload="setBold()">
<div id="menu" data-page="home"></div>
<section class="container-fluid">
    @include('partials.header')
    @include('partials.jumbotron')
<!-- indicators -->

<!-- new -->
<section>
    <div class="container">
        @yield('content')
    </div>
</section>
<!-- footer -->
@include('partials.footer')


<script type="text/javascript" src="{{url('js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/bootstrap.bundle.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/login.js')}}"></script>
<script type="text/javascript" src="{{url('js/menu.js')}}"></script>
<script type="text/javascript" src="{{url('js/carousel.js')}}"></script>
<!-- <script type="text/javascript" src="{{url('js/main.js')}}"></script> -->
<script type="text/javascript" src="{{url('js/header.js')}}"></script>
<script type="text/javascript" src="{{url('js/avatar.js')}}"></script>

<!-- add lib valid data -->
<script src="{{ asset('js/libs/jquery.validationEngine-ja.js') }}"></script>
<script src="{{ asset('js/libs/jquery.validationEngine.js') }}"></script>
<script src="{{ asset('js/libs/jquery.alerts.js') }}"></script>

<!-- add lib valid data -->
<script src="{{ asset('js/authen.js') }}"></script>
<script src="{{ asset('js/account_info.js') }}"></script>
        <script type="text/javascript" src="" href="{{url('http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js')}}"></script>
<script src="//cdn.ckeditor.com/4.10.1/full/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        $(document).on('click', '#btnContactUs', function () {
            var form = $this.parent('form');
            event.preventDefault();
            swal({
                title: "Bạn có chắc chắn muốn gửi ?",
                text: "",
                icon: "warning",
                buttons: true,
                dangerMode: false,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Phản hồi đã được gửi", {
                            icon: "success",
                        });
                    } else {
                        swal("Đã hủy!");
                    }
                })
        })
    })
</script>
<script>
    $(document).ready(function () {

        $(document).on('click','#btn-delete',function (event) {
            // confirm('cos xoa hay khong');

            var form = $(this).parent('form');
            event.preventDefault();

            swal({
                title: "Bạn có chắc chắn muốn xóa ?",
                text: "Một khi đã xóa thì không thể lấy lại dữ liệu",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

        // $('.btn-delete').click(function () {
        //     alert();
        // });
    });
</script>

@stack('footer')

</body>
</html>