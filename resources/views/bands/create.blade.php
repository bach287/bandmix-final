@extends('layouts.master')
@section('content')
    <div style="margin: 0;padding: 10px 0">
        <form action="{{route('bands.store')}}" method="POST" enctype="multipart/form-data" style="margin:10px 0 " class="cart_status row">
            {{csrf_field()}}
            <div class="col-sm-3 menu_left">
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input  name="avatar" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload"></label>
                    </div>
                    <div class="avatar-preview" style="width: 250px; height: 200px;">
                        <div id="imagePreview" style="background-image: url({{url('images/default.jpg')}});">
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
                        <div class="">
                            <textarea type="textarea" class="form-control" placeholder="Giói thiệu chung" rows="3" maxlength="140" name="description" required></textarea>
                        </div>
                        <hr>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3 input-with-label">
                                    <label> Tên Ban Nhạc :</label>
                                </div>
                                <div class=" col-sm-3 input-with-content">
                                    <input name="name" type="text" maxlength="20" class="form-control"
                                            placeholder="Tên ban nhạc" required>
                                </div>
                                <div class="col-sm-3 input-with-label">
                                    <label>Ngày Thành Lập :</label>
                                </div>
                                <div class=" col-sm-3 input-with-content">
                                    <input name="doc" type="date" class="form-control">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 input-with-label">
                                    <label>Số điện thoại:</label>
                                </div>
                                <div class=" col-sm-3 input-with-content">
                                    <input  name="phone_manager" maxlength="11" type="text" class="form-control" >
                                </div>
                                <div class="col-sm-3 input-with-label">
                                    <label>Số Lượng Thành Viên :</label>
                                </div>
                                <div class=" col-sm-3 input-with-content">
                                    <input name="number_of_mem" type="number" class="form-control" min="1" required>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-3 input-with-label">
                                    <label for="locations">Địa điểm hoạt động:</label>
                                </div>
                                <div class=" col-sm-3 input-with-content">
                                    <select name="location_id" id="locations" class="form-control" required>
                                        <option selected>Địa điểm hoạt động</option>
                                        @foreach($locations as $location)
                                            <option value="{{$location->id}}">{{$location->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3 input-with-label">
                                    <label for="genres">Thể Loại chơi:</label>
                                </div>
                                <div class=" col-sm-3 input-with-content">
                                    <select name="genre_id" id="genres" class="form-control" required>
                                        <option selected>Thể loại</option>
                                        @foreach($genres as $genre)
                                            <option value="{{$genre->id}}">{{$genre->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 input-with-label">
                                    <label>Thành tựu</label>
                                </div>

                            </div>
                            <div class=" col-sm-12 input-with-content">
                                <textarea name="achievements" class="form-control" id="achievements"
                                          placeholder="Ban nhạc của bạn đã có những giải thưởng hay những vị trí nào trong các cuộc thi?" rows="10"
                                          required></textarea>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 input-with-label">
                                    <label>Mô Tả Chi Tiết:</label>
                                </div>
                                <div class=" col-sm-12 input-with-content">
                                    <textarea name="about" class="form-control" id="about"
                                              placeholder="Mô tả về ban nhạc của bạn" rows="30"
                                              required></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-3 input-with-label">

                                </div>
                                <div class=" col-sm-1 input-with-content">
                                    <button class="btn btn-danger">Huỷ</button>
                                </div>
                                <div class=" col-sm-1 input-with-content">
                                    <button type="submit" class="btn btn-success">Tạo Ban Nhạc</button>
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
    <script>
        CKEDITOR.replace( 'about' );
        CKEDITOR.replace( 'achievements' );
        //avatar load
    </script>
@endpush