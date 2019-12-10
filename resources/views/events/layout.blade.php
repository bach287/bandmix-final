@extends('layouts.master')
@section('content')
    <br/>
    <div class="card-outside">
        <div class="cart_status row">
            <div class="col-sm-3 menu_left">
                <div class="avatar_user">
                    <div>
                        <p>
                            <img src="{{ url($event->avatar) }}" >
                        </p>
                    </div>
                    <div class="textUser">
                        <div>
                            <label><h4> {{ $event->name }} </h4>
                            </label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="change-user-infor">
                        <div class="row">
                            <div class="col-sm-2">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            </div>
                            <div>
                                <a href="{{route('events.show',$event->id)}}"> <label class="pointer-user">Thông tin Sự Kiện</label></a>
                            </div>
                        </div>
                        @if($event->member_id == Auth::id() && $event->status != 0)
                        <div class="menu-child">
                            <a href="{{route('events.edit',$event->id)}}"><label class="pointer-user">Chỉnh sửa thông tin</label></a>
                        </div>
                        @endif

                        @guest

                        @else
                        <div class="menu-child">
                            <a href="{{route('events.contact',$event->id)}}"><label class="pointer-user">Thông tin liên hệ</label></a>
                        </div>
                        @endguest

                    </div>

                </div>
            </div>
            <!--user information-->
            @yield('event_content')
        </div>
    </div>
@endsection