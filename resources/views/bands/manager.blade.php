@extends('layouts.master')
@section('content')
    <div class="container">
            <!-- List Event -->
            <div class="title">
                <div class="type-1">
                    <div>
                        <a href="{{route('bands.create')}}" class="btn btn-1 create">
                            <span class="txt">Tạo Ban Nhạc</span>
                            <span class="round"><i class="fa fa-plus"></i></span>
                        </a>
                    </div>
                </div>
                <h2>Danh Sách Ban Nhạc</h2>
                <hr>
            </div>
            <div class=" row">
                <form class="form-inline search-form">
                    <div class="form-group" style="margin-left: 54%">
                        {{--<input type="hidden" name="member_id" value="{{ $bands->member_id }}">--}}
                        <input type="text" value="{{request()->get('keyword')}}" class="form-control" name="keyword" placeholder="Tìm kiếm" aria-label="Search" style="width: 30%">
                        <select class="form-control select-op" name="search_location">
                            <option value="" selected>Địa điểm</option>
                            @foreach($locations as $location)
                                <option {{ $location->id == request()->get('search_location') ? 'selected' : '' }} value="{{ $location->id }}" >{{ $location->name }}</option>
                            @endforeach
                        </select>
                        <select class="form-control select-op" name="search_genre">
                            <option value="" selected>Thể loại</option>
                            @foreach($genres as $genre)
                                <option {{ $genre->id == request()->get('search_genre') ? 'selected' : '' }} value="{{ $genre->id }}" >{{ $genre->name }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-default searchA ">Tìm kiếm</button>
                    </div>
                    {{--<p class="event_count">Tìm thấy {{count($events_search)}} sản phẩm</p>--}}
                </form>
            </div>
            <div class="row">
                @foreach($bands as $band)
                    <div class="col-xs-18 col-sm-6 col-md-3">
                        <div class="hovereffect">
                            <img class="img-responsive" src="{{url($band->avatar)}}" alt="">
                            <div class="overlay">
                                <p>
                                    {{$band->description}}
                                </p>
                                <a class="info" href="{{url('/bands/'.$band->slug)}}">Chi tiết</a>
                            </div>
                        </div>
                        <div class="overLayB" style="margin-top:58%">
                            <a class="info" href="{{url('/bands/'.$band->slug)}}" style=" ">
                                <h4>{{$band->name}}</h4>
                            </a>
                            <form action="{{route('bands.delete',[$band->id])}}" ">
                                <a href="" style="width: 100%;" class="btn btn-danger" id="btn-delete"><i class="fa fa-trash-o"></i> Xoá</a>
                            </form>
                        </div>
                        <div class="iconDelete">
                        </div>
                    </div>
                @endforeach
            </div> <!-- row -->
        </div> <!-- container -->
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
@endpush