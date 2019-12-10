@extends('layouts.master')
@section('content')
    <br/>
    <br/>
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
                    @if($event->status != 0)
                        <div class="change-user-infor">
                            <div class="row">
                                <div class="col-sm-2">
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <a href="{{route('events.show',$event->id)}}"> <label class="pointer-user">Thông tin Sự Kiện</label></a>
                                </div>
                            </div>
                            <div class="menu-child">
                                <a href="{{route('events.edit',$event->id)}}"><label class="pointer-user">Chỉnh sửa thông tin</label></a>
                            </div>
                            <div class="menu-child">
                                <a href="{{route('events.contact',$event->id)}}"><label class="pointer-user">Thông tin liên hệ</label></a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!--user information-->
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
                    <form method="POST" action="{{route('events.confirm')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="event_id" value="{{$event->id}}">
                        <div class="second-part-chgpass row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-5 input-with-label">
                                        <label> Tên Sự Kiện :</label>
                                    </div>
                                    <div class=" col-sm-5 input-with-content">
                                        <label> {{$event->name}} </label>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5 input-with-label">
                                        <label>Thời gian diễn ra :</label>
                                    </div>
                                    <div class=" col-sm-5 input-with-content">
                                        <label>{{ $event->time}} Ngày {{date("d", strtotime($event->date))}} tháng {{date("m", strtotime($event->date))}} năm {{date("Y", strtotime($event->date))}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5 input-with-label">
                                        <label>Giá vé :</label>
                                    </div>
                                    <div class=" col-sm-5 input-with-content">
                                        <label>{{ number_format($event->price) }} VND</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5 input-with-label">
                                        <label>Địa điểm tổ chức:</label>
                                    </div>
                                    <div class=" col-sm-5 input-with-content">
                                        <label>{{ $event->location_detail.', '.$event->locations->name}}</label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    </br>
                                    <div class="col-sm-12 input-with-label">
                                        <label>Các tiết mục tiêu biểu trong chương trình:</label>
                                    </div>
                                </div>
                                <div id="row-contain" style="padding: 0;margin: 0;">

                                    @foreach($event->bands as $item)
                                        <div class="row">
                                            <div class="col-sm-2 input-with-label">
                                                <label>Tiết mục:</label>
                                            </div>

                                            <div class=" col-sm-4 input-with-content">
                                                <input type="text" name="item_name[]" readonly value="{{ $item->pivot->act }}">
                                            </div>
                                            <div class="col-sm-2 input-with-label">
                                                <label> Ban nhạc:</label>
                                            </div>
                                            <div class=" col-sm-4 input-with-content">
                                                <input type="hidden" name="band[]" value="{{$item->id}}">
                                                <label><h6><a style="text-decoration: none;" href="{{url(route('bands.show',$item->slug))}}">{{ $item->name}}</a></h6></label>
                                            </div>

                                            {{--<div class=" col-sm-3 input-with-content">--}}
                                                {{--<select class="form-control" data-toggle="modal" data-target="#modalOnline" name="band[]" required>--}}
                                                    {{--@foreach($bands as $band)--}}
                                                        {{--<option {{ $act->band_id == $band->id ? 'selected' : '' }} value="{{ $band->id }}">{{ $band->name }}</option>--}}
                                                    {{--@endforeach--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            <div class=" col-sm-1">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-sm-5 input-with-label">
                                        <label>Mô Tả Chi Tiết:</label>
                                    </div>
                                </div>
                                <div class=" col-sm-12 input-with-content">
                                    <label>{!! $event->detail  !!}</label>
                                </div>
                            </div>
                            <input type="hidden" name="status" value="1">
                            <div class="col-md-12" style="display: flex; justify-content: center">
                                <div class="input-with-content">
                                    <a href="{{route('events.edit',$event->id)}}" class="btn btn-primary">Chỉnh sửa</a>
                                </div>
                                <div class="input-with-content">
                                    <input type="submit" class="btn btn-success" value="Duyệt sự kiện">
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <!--END user information-->
            </div>
        </div>
    </div>
@endsection
@push('footer')
    <script type="text/javascript">
        $(document).ready(function() {
            // $('select').select2();
            $(document).on('click','.btnPlus',function(e){
                e.preventDefault();
                let obj = $('.hidden_template').clone()
                obj.removeClass('hidden_template')
                obj.removeAttr('style')
                $(this).parent().parent().after(obj)
            })
            $(document).on('click','.btnRemove',function(e){
                e.preventDefault();
                $(this).parent().parent().remove()
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#check").change(function() {
                if (this.checked) {
                    $(".checkSingle").each(function() {
                        this.checked=true;
                    });
                } else {
                    $(".checkSingle").each(function() {
                        this.checked=false;
                    });
                }
            });

            $(".checkSingle").click(function () {
                if ($(this).is(":checked")) {
                    var isAllChecked = 0;

                    $(".checkSingle").each(function() {
                        if (!this.checked)
                            isAllChecked = 1;
                    });

                    if (isAllChecked == 0) {
                        $("#checkedAll").prop("checked", true);
                    }
                }
                else {
                    $("#checkedAll").prop("checked", false);
                }
            });
        });
    </script>
@endpush
