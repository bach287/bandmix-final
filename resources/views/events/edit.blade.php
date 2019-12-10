@extends('layouts.master')
@section('content')
    {{--<div class="card-outside">--}}
    <form method="POST" action="{{ route('events.store') }}" onsubmit="checkDate()" class="cart_status row" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="card-outside">
            <div class="cart_status row">
                <div class="col-sm-3 menu_left">
                    <div class="avatar_user">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input  name="avatar" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview" style="width: 250px; height: 200px;">
                                <div id="imagePreview" style="background-image: url({{url($event->avatar)}});">
                                    <img src="" alt="">
                                </div>
                            </div>

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
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <input type="hidden" name="member_id" value="{{ $event->member_id }}">
                        <input type="hidden" name="status" value="{{ $event->status }}">
                        <input type="hidden" name="slug" value="{{ $event->slug }}">
                        <input type="hidden" name="avatar" value="{{ $event->avatar }}">
                        <div>
                            <strong><label>Giới Thiệu</label></strong>
                        </div>
                        <div class="">
                            <textarea type="textarea" class="form-control" placeholder="Giói thiệu chung" rows="3" name="description" required>{{ $event->description }}</textarea>
                        </div>
                        <div enctype="multipart/form-data">
                            <div class="second-part-chgpass row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <label id="date-error" style="color: red;font-size: small; display: flex; margin-left: 52%" hidden>
                                            Sự kiện không thể diễn ra trong quá khứ!
                                        </label>
                                        <div class="col-sm-3 input-with-label">
                                            <label> Tên Sự Kiện :</label>
                                        </div>
                                        <div class=" col-sm-3 input-with-content">
                                            <input type="text" class="form-control"
                                                   placeholder="Tên Sự Kiện" name="name" required value="{{ $event->name }}">
                                        </div>
                                        <div class="col-sm-3 input-with-label">
                                            <label>Ngày diễn ra :</label>
                                        </div>
                                        <div class=" col-sm-3 input-with-content">
                                            <input type="date" class="form-control" id="date" name="date" value="{{ $event->date }}">

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3 input-with-label">
                                            <label>Địa điểm :</label>
                                        </div>
                                        <div class=" col-sm-3 input-with-content">
                                            <select class="form-control" name="location" required>
                                                <option value="">Chọn thành phố</option>
                                                @foreach($locations as $location)
                                                    <option value="{{$location->id}}" {{$event->location_id == $location->id ? 'selected' : ''}}>{{$location->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-3 input-with-label">
                                            <label>Thời gian :</label>
                                        </div>
                                        <div class=" col-sm-3 input-with-content">
                                            <input type="time" class="form-control" name="time" required value="{{ $event->time }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3 input-with-label">
                                            <label>Địa điểm Tổ chức:</label>
                                        </div>
                                        <div class=" col-sm-3 input-with-content">
                                            <input type="text" class="form-control" placeholder="Địa điểm tổ chức" name="location_detail" required value="{{ $event->location_detail }}">

                                        </div>
                                        <div class="col-sm-3 input-with-label">
                                            <label>Thể Loại yêu cầu:</label>
                                        </div>
                                        <div class=" col-sm-3 input-with-content">
                                            <select class="form-control" name="genre" required>
                                                <option value="">Thể loại</option>
                                                @foreach($genres as $genre)
                                                    <option value="{{$genre->id}}" {{$event->genre->id == $genre->id ? 'selected' : ''}} >{{$genre->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3 input-with-label">
                                            <label>Số Lượng vé :</label>
                                        </div>
                                        <div class=" col-sm-3 input-with-content">
                                            <input type="number" class="form-control" name="vacancy" value="{{ $event->vacancy }}" disabled>
                                        </div>
                                        <div class="col-sm-3 input-with-label">
                                            <label>Email chương trình :</label>
                                        </div>
                                        <div class=" col-sm-3 input-with-content">
                                            <input type="email" class="form-control" name="mail" required value="{{ $event->mail }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 input-with-label">
                                            <label>Hot-line :</label>
                                        </div>
                                        <div class=" col-sm-3 input-with-content">
                                            <input type="text" class="form-control" name="number_phone" required value="{{ $event->number_phone }}">
                                        </div>

                                        <div class="col-sm-3 input-with-label">
                                            <label>Giá vé :</label>
                                        </div>
                                        <div class=" col-sm-3 input-with-content">
                                            <input type="number" class="form-control" name="price" value="{{ $event->price }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        </br>
                                        <div class="col-sm-12 input-with-label">
                                            <label>Các tiết mục tiêu biểu trong chương trình:</label>
                                        </div>
                                    </div>
                                    <div id="row-contain" style="padding: 0;margin: 0;">


                                        <span class="btn btn-primary btnPlus"><i class="fa fa-plus"></i>
                                            <label for="" style="margin:0 ">Thêm tiết mục</label>
                                        </span>

                                        @foreach($event->bands as $item)
                                            <div class="row">
                                                <div class="col-sm-2 input-with-label">
                                                    <label>Tiết mục:</label>
                                                </div>

                                                <div class=" col-sm-4 input-with-content">
                                                    <label>{{ $item->pivot->act }}</label>
                                                </div>
                                                <div class="col-sm-2 input-with-label">
                                                    <label> Ban nhạc:</label>
                                                </div>
                                                <div class=" col-sm-3 input-with-content">
                                                    <label><h6><a style="text-decoration: none;" href="{{url(route('bands.show',$item->slug))}}">{{ $item->name}}</a></h6></label>
                                                </div>
                                                <div class=" col-sm-1">
                                                    <span class="btn btn-danger btnRemove"><i class="fa fa-remove"></i></span>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="row hidden_template" style="display:none;" id="act_table">
                                            <div class="col-sm-2 input-with-label">
                                                <label>Tiết mục:</label>
                                            </div>

                                            <div class=" col-sm-4 input-with-content">
                                                <input type="Text" class="form-control" placeholder="Tên tiết mục " name="item_name[]">
                                            </div>

                                            <div class="col-sm-2 input-with-label">
                                                <label> Ban nhạc:</label>
                                            </div>

                                            <div class=" col-sm-3 input-with-content">
                                                <select class="form-control" data-toggle="modal" data-target="#modalOnline" name="band[]" required>
                                                    @foreach($bands as $band)
                                                        <option value="{{ $band->id }}">{{ $band->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class=" col-sm-1">
                                                <span class="btn btn-danger btnRemove"><i class="fa fa-remove"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 input-with-label">
                                            <label>Mô Tả Chi Tiết:</label>
                                        </div>
                                        <div class=" col-sm-12 input-with-content">
                                            <textarea type="textarea" class="form-control" placeholder="Mô tả về sự kiện" rows="10" name="detail" required>{{ $event->detail }}</textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row" style="display: flex; justify-content: center">
                                        <div class=" col-sm-1 input-with-content">
                                            <a href="{{ route('events.index') }}" class="btn btn-danger">Huỷ</a>
                                        </div>
                                        <div class=" col-sm-1 input-with-content">
                                            <button type="submit" class="btn btn-success">Lưu lại</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--END user information-->
            </div>
        </div>
    </form>
    {{--</div>--}}
@endsection
@push('footer')
    <script type="text/javascript" src="{{url('js/main.js')}}"></script>
    <script type="text/javascript" src="{{url('js/avatar.js')}}"></script>-
    <script type="text/javascript">
        $(document).ready(function() {
            // $('select').select2();
            $(document).on('click','.btnPlus',function(e){
                e.preventDefault();
                let obj = $('.hidden_template').clone()
                obj.removeClass('hidden_template')
                obj.removeAttr('style')
                $('#act_table').after(obj)
            })
            $(document).on('click','.btnRemove',function(e){
                e.preventDefault();
                $(this).parent().parent().remove()
            })
        });
    </script>
    <script>
        CKEDITOR.replace( 'detail' );
        //avatar load
        $(document).ready(function () {
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.pre-img').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#avt_input").on('change', function(){
                readURL(this);
            });
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
    <script>
        function checkDate() {
            var dateString = document.getElementById('date').value;
            var myDate = new Date(dateString);
            var today = new Date();
            if ( myDate < today ) {
                $('#date-error').removeAttr("hidden");
                event.preventDefault();
                window.scrollTo(500,600);
            }
            return true;
        }
    </script>
@endpush
