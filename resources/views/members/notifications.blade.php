@extends('layouts.master')
@push('header')
    <link rel="stylesheet" href="{{url('css/member.css')}}">
@endpush
@section('content')
    <div class="card-outside">
        <div class="cart_status row">
            <div class="col-sm-3 menu_left">
                <div class="rounded-circle">
                    <div>
                        <p>
                            <img src="{{url($member->avatar)}}" style="height: 255px; width: 255px;">
                        </p>
                    </div>
                    <div class="textUser" style="">
                        <div style="text-align: center">
                            <h4 >{{$member->name}}</h4>
                        </div>
                    </div>
                </div>
                @if($member->id == Auth::id())
                    <div class="change-user-infor">
                        <div class="row">
                            <div class="col-sm-2">
                                <i class="fa fa-user-circle"></i>
                            </div>
                            <div>
                                <label >Thông tin cá nhân</label>
                            </div>
                        </div>
                        <div class="menu-child">

                            <a href="{{route('members.edit', $member->id)}}"> <label class="pointer-user" >Chỉnh sửa thông tin</label></a>
                        </div>

                    </div>
                    <div class="lesson-menu">
                        <div class="row">
                            <div class="col-sm-2">
                                <i class="fa fa-bell" aria-hidden="true"></i>
                            </div>
                            <div>
                                <a href="{{route('member.noti',$member->id)}}">
                                    <label class="pointer-user">
                                        Thông báo
                                    </label>
                                    <label for="" style="color: red; margin-left: 2px;">
                                        ({{ count($member->notifications)}})
                                    </label>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="change-user-infor">
                        <div class="row">
                            <div class="col-sm-2">
                                <i class="fa fa-usd" aria-hidden="true"></i>
                            </div>
                            <div>
                                <a href="{{ route('members.manageBill',$member->id) }}">
                                    <label class="pointer-user">Lịch sử giao dịch</label>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="change-user-infor">
                        <div class="row">
                            <div class="col-sm-2">
                                <i class="fa fa-ticket"></i>
                            </div>
                            <div>
                                <a href="{{ route('members.manageBook',$member->id) }}">
                                    <label class="pointer-user">Quản lý đơn hàng</label>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <!--user information-->
            <div class="menu-right-chgpass">
                <div class="col-sm-12" >
                    <h4>Thông báo của bạn</h4>
                    @foreach($member->unreadNotifications as $notification)
                        <div class="noti-border">
                            <a class="noti" href="{{route('events.show',$notification->data['event']['id'])}}">
                                <div class="noti-title">Ban nhạc {{$notification->data['band']['name']}}</div>
                                <div>Sự kiện {{$notification->data['event']['name']}} đã mời ban nhạc của bạn tham gia biểu diễn!</div>
                                <div style="font-size: small">{{$notification->created_at}}</div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <hr>
                {{--<div class="col-sm-12" >--}}
                    {{--<h4>Thông báo đã đọc</h4>--}}
                    {{--@foreach($member->readNotifications as $notification)--}}
                        {{--<div class="noti-border">--}}
                            {{--<a class="noti" href="{{route('events.show',$notification->data['event']['id'])}}">--}}
                                {{--<div class="noti-title">Ban nhạc {{$notification->data['band']['name']}}</div>--}}
                                {{--<div>Sự kiện {{$notification->data['event']['name']}} đã mời ban nhạc của bạn tham gia biểu diễn!</div>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
            </div>
            <!--END user information-->
        </div>
    </div>
@endsection