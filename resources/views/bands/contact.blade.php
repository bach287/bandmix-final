@extends('layouts.master')
@section('content')
    <div class="cart_status row" style="padding: 10px 0">
        <div class="col-sm-3 menu_left">
            <div class="avatar_user">
                <div style="width: 250px; height: 200px;">
                    <p>
                        <img src="{{url($band->avatar)}}">
                    </p>
                </div>
                <div class="textUser">
                    <div>
                        <label><h4> {{$band->name}} </h4>
                        </label>
                    </div>
                </div>
            </div>
            @if($band->member_id === Auth::id())
                <div class="btn-edit" style="display: flex; justify-content: center" >
                    <a href="{{route('bands.edit',$band->id)}}"><button id="band-edit-btn" class="btn btn-default"><i class="fa fa-pencil"></i> Chỉnh Sửa</button></a>
                </div>
                <div>
                    <div class="change-user-infor">
                        <div class="row">
                            <div class="col-sm-2">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            </div>
                            <div>
                                <a href="{{ route('bands.show',$band->slug )}}"> <label class="pointer-user">Thông tin Ban Nhạc</label></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
                <div class="change-user-infor">
                    <div class="row">
                        <div class="col-sm-2">
                            <i class="fa fa-phone-square" aria-hidden="true"></i>
                        </div>
                        <div>
                            <a href="{{route('bands.contact',$band->id)}}"><label class="pointer-user">Thông tin liên hệ</label></a>
                        </div>
                    </div>
                </div>

        </div>
        <!--user information-->
        <div class="menu-right-chgpass">
            <div class="second-part-chgpass row">
                <div class="col-sm-12">
                    <div>
                        <div>
                            <strong><label>Giới Thiệu</label></strong>
                        </div>
                        <div class="textChgPass">
                            <label>{{ $band->description }}</label>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-sm-4">
                            <p>Người tạo sự kiện:</p>
                        </div>
                        <div class="col-sm-3" style="text-align: center">
                            <img src="{{url($band->member->avatar)}}" alt="" style="border-radius: 10px">
                            <a style="text-decoration: none" href="{{route('members.index',$band->member->id)}}">{{$band->member->name}}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>

                        <div class="col-sm-4">
                            <p>Số điện thoại:</p>
                        </div>
                        <div class="col-sm-3">
                            <p>{{$band->phone_manager}}</p>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <p>{!! $band->about !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END user information-->

    </div>

@endsection
