
<section class="container-fluid">
    <header class="container-fluid head fixed-top">
        <nav class="navbar  navbar-expand-sm navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand" href="/">BANDMIX</a>
            <!-- Links -->
            <div class="collapse navbar-collapse" id="nav-content">
                <ul class="navbar-nav col-12 col-md-8 col-lg-6">
                    <li class="">
                        <a class="nav-link " href="/">TRANG CHỦ</a>
                    </li>
                    <li class="">
                        <a class="nav-link " href="{{route('bands.index')}}">BAN NHẠC</a>
                    </li>
                    <li class="">
                        <a class="nav-link " href="{{route('events.index')}}">SỰ KIỆN</a>
                    </li>
                    <li class="">
                        <a class="nav-link " href="{{route('news.index')}}">TIN TỨC</a>
                    </li>
                    <li class="">
                        <a class="nav-link " href="{{ route('about.index') }}">GIỚI THIỆU</a>
                    </li>
                </ul>
                <div style="display: flex; justify-content: flex-end; align-items: center" class="col-6">
                    <div class="search-container">
                        <div class="input-group md-form form-sm form-1 pl-0">
                            <div class="input-group-prepend">
                                <form action="{{route('masterSearching')}}">
                                    <div class="input-group-prepend">
                                        <input class="form-control searchMText" id="search-bar" name="searchValue" type="text" placeholder="Tìm kiếm" aria-label="Search">
                                        <button type="submit"  class="input-group-text cyan lighten-2 button searchM" id="search-button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    @guest
                    <form class="only_display_on_a form-inline my-2 my-lg-0 main-nav">
                        <a class="nav-link signin" style="color: white" >Đăng Nhập</a>
                        <a class="nav-link signup" style="color: white">Đăng Ký</a>
                    </form>
                    @else

                    <ul class="nav navbar-nav">
                        <li class="dropdown show">
                            <a href="#" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Chào {{ Auth::user()->name }} <span class="caret"></span><b class="caret"></b></a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" >
                                <li><a class="dropdown-item" href="{{ route('events.manage') }}">Quản lý Sự kiện</a></li>
                                <li><a class="dropdown-item" href="{{route('bands.manage')}}">Quản lý Ban nhạc</a></li>
                                <li><a class="dropdown-item" href="{{route('members.index',Auth::user()->id)}}">Quản lý tài khoản</a></li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Đăng xuất
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul  class="nav" data-toggle="modal" data-target="#modalCart" style="padding-left: 5%;">
                        <i  class="fa fa-shopping-cart cart-icon"></i><span class="badge">{{Cart::count()}}</span>
                    </ul>
                    @endguest
                </div>
            </div>
        </nav>
    </header>
    <div id="modalCart" class="modal fade mdcart" role="dialog" style="padding: 0px">
        <div class="modal-dialog modal-dialogCart " style="">

            <!-- Modal content-->
            <div class="modal-content modal-contentCart ">
                <div class="modal-header .modal-headerCart">
                    <i class="fa fa-shopping-cart cart-icon"></i><span class="badge">{{Cart::count()}}</span>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body modal-bodyCart" style="">
                    <!--<div class="shopping-cart">-->
                    @if(Cart::count() == 0)
                    <h3 style="text-align: center">Chưa có sản phẩm nào</h3>
                    @else
                    <!--end shopping-cart-header -->
                    <ul class="shopping-cart-items">
                        <?php foreach (Cart::content() as $key => $cart): ?>
                            <li class="items">
                                <img src="{{url($cart->options->avatar)}}" alt="item1" />
                                <span class="item-name">{{ $cart->name }}</span>
                                <span class="item-price">Giá vé : {{ $cart->price }}</span>
                                <span class="item-quantity">Số lượng vé đặt : {{ $cart->options->number_of_ticket }} vé</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="{{route('cart.show')}}" class="btnSeeCart">Chi Tiết Giỏ Hàng</a>
                    @endif
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
</section>