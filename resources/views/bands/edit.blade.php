@extends('layouts.master')
@section('content')
    <div style="margin: 0;padding: 10px 0">
        <form action="{{route('bands.update',$band->id)}}" method="post" onsubmit="checkDate()" enctype="multipart/form-data" style="margin:10px 0 " class="cart_status row">
            {{csrf_field()}}
            <div class="col-sm-3 menu_left">
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input  name="avatar" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload"></label>
                    </div>
                    <div class="avatar-preview" style="width: 250px; height: 200px;">
                        <div id="imagePreview" style="background-image: url({{url('images/default.jpg')}});">
                            <img src="{{url($band->avatar)}}" alt="">
                        </div>
                    </div>

                </div>
            </div>
            <!--user information-->
            <div class="menu-right-chgpass">
                <div class="second-part-chgpass row">
                    <div class="col-sm-12">
                        <div>
                            <strong><label>Giới Thiệu</label></strong>
                        </div>
                        <div >
                            <textarea type="textarea" class="form-control" placeholder="Giói thiệu chung" rows="3" name="description" required>{{$band->description}}</textarea>
                        </div>
                        <hr>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3 input-with-label">
                                    <label> Tên Ban Nhạc :</label>
                                </div>
                                <div class=" col-sm-3 input-with-content">
                                    <input name="name" type="text" class="form-control"
                                           placeholder="Tên ban nhạc" value="{{$band->name}}" required>

                                </div>
                                <div class="col-sm-3 input-with-label">
                                    <label>Ngày Thành Lập :</label>
                                </div>
                                <div class=" col-sm-3 input-with-content">
                                    <input name="doc" id="date-of-create" type="date" value="{{$band->doc}}" class="form-control">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 input-with-label">
                                    <label>Số điện thoại:</label>
                                </div>
                                <div class=" col-sm-3 input-with-content">
                                    <input  name="phone_manager" type="text" value="{{$band->phone_manager}}" class="form-control" >
                                </div>
                                <div class="col-sm-3 input-with-label">
                                    <label>Số Lượng Thành Viên :</label>
                                </div>
                                <div class=" col-sm-3 input-with-content">
                                    <input name="number_of_mem" type="number" class="form-control" value="{{$band->number_of_mem}}" required>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-3 input-with-label">
                                    <label for="locations">Địa điểm hoạt động:</label>
                                </div>
                                <div class=" col-sm-3 input-with-content">
                                    <select name="location_id" id="locations" class="form-control" required>
                                        <option>Địa điểm hoạt động</option>
                                        @foreach($locations as $location)
                                            <option value="{{$location->id}}" {{$band->location_id == $location->id ? 'selected' : ''}}>{{$location->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3 input-with-label">
                                    <label for="genres">Thể Loại chơi:</label>
                                </div>
                                <div class=" col-sm-3 input-with-content">
                                    <select name="genre_id" id="genres" class="form-control" required>
                                        <option>Thể loại</option>
                                        @foreach($genres as $genre)
                                            <option value="{{$genre->id}}" {{$band->genre_id == $genre->id ? 'selected' : ''}} >{{$genre->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 input-with-label">
                                    <label>Thành tựu</label>
                                </div>
                                <div class=" col-sm-12 input-with-content">
                                <textarea name="achievements" id="achivements" class="form-control"
                                          placeholder="Ban nhạc của bạn đã có những giải thưởng hay những vị trí nào trong các cuộc thi?" rows="4"
                                          required>{{$band->achievements}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 input-with-label">
                                    <label>Mô Tả Chi Tiết:</label>
                                </div>
                                <div class=" col-sm-12 input-with-content">
                                    <textarea name="about" class="form-control"
                                              placeholder="Mô tả về ban nhạc của bạn" rows="10"
                                              required>{{$band->about}}</textarea>
                                </div>
                            </div>
                            {{--<div class="col-sm-3 input-with-label">--}}
                                {{--<label>Sản Phẩm</label>--}}
                            {{--</div>--}}
                            {{--<div class=" col-sm-5 input-with-content">--}}
                                    {{--<input type="file" class="form-control-file" id="myFile" >--}}
                                {{--</div>--}}
                            {{--<br>--}}
                            <div class="row justify-content-center">
                                <div class=" col-sm-1">
                                    <a class="btn btn-danger"  href="{{route('bands.show', $band->slug)}}">Huỷ</a>
                                </div>
                                <div class=" col-sm-1">
                                    <button type="submit" class="btn btn-success">Lưu chỉnh sửa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--END user information-->
        </form>
    </div>
@endsection
@push('footer')
    <script type="text/javascript" src="{{url('js/main.js')}}"></script>
    <script type="text/javascript" src="{{url('js/avatar.js')}}"></script>
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
    <script>
        CKEDITOR.replace( 'achievements' );
        CKEDITOR.replace( 'about' );
        //avatar load
    </script>
    <script>
        function checkDate() {

            var dateString = document.getElementById('date-of-create').value;
            var myDate = new Date(dateString);
            var today = new Date();
            if ( myDate > today ) {
                $('#date-of-create').after('<p>You cannot enter a date in the future!.</p>');
                event.preventDefault();
            }
            return true;
        }
    </script>
@endpush