@extends('events.layout')
@section('event_content')
    <div class="menu-right-chgpass">
        <div class="col-sm-12">
            <div>
                <div>
                    <strong><label>Giới Thiệu</label></strong>
                </div>
                <div class="textChgPass">
                    <label>{{ $event->description }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-sm-4">
                    <p>Người tạo sự kiện:</p>
                </div>
                <div class="col-sm-3" style="text-align: center">
                    <img src="{{url($event->member->avatar)}}" alt="" style="border-radius: 10px">
                    <a style="text-decoration: none" href="{{route('members.index',$event->member->id)}}">{{$event->member->name}}</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-sm-4">
                    <p>Email:</p>
                </div>
                <div class="col-sm-3">
                    <p>{{$event->mail}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>

                <div class="col-sm-4">
                    <p>Số điện thoại:</p>
                </div>
                <div class="col-sm-3">
                    <p>{{$event->number_phone}}</p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <p>{!! $event->detail !!}</p>
                </div>
            </div>
        </div>
    </div>

@endsection