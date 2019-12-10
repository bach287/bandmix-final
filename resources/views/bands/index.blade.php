@extends('layouts.master')
@push('header')
    <link rel="stylesheet" href="{{url('css/band.css')}}">
@endpush
@section('content')
    <div class="title">
        <h2>Ban Nhạc mới </h2>
        <hr>
    </div>
    <div class="row">
        @foreach($new_bands as $band)
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="hovereffect">
                    <img class="img-responsive" src="{{$band->avatar}}" alt="">
                    <div class="overlay">
                        <p>
                            {{$band->description}}
                        </p>
                        <a class="info"  href="{{route('bands.show', $band->slug)}}">Chi tiết</a>

                    </div>
                </div>
                <div class="overLayB">
                    <a class="info" href="{{url('/bands/'.$band->slug)}}"><h4>{{$band->name}}</h4></a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="title">
        <h2>Danh Sách Ban Nhạc</h2>
        <hr>
    </div>
    <div class="row justify-content-center">
        <form class="form-inline search-form">
            <div class="form-group" >
                <input type="text" value="{{request()->get('keyword')}}" class="form-control" name="keyword" placeholder="Tìm kiếm" aria-label="Search" style="width: 30%">
                <select class="form-control" name="genre">
                    <option value="">Thể Loại</option>
                    @foreach($genres as $genre)
                        <option {{ $genre->id == request()->get('genre') ? 'selected' : '' }} value="{{$genre->id}}">{{$genre->name}}</option>
                    @endforeach
                </select>
                <select class="form-control select-op" name="search_location">
                    <option value="" selected>Địa điểm</option>
                    @foreach($locations as $location)
                        <option {{ $location->id == request()->get('search_location') ? 'selected' : '' }} value="{{ $location->id }}" >{{ $location->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-default searchA ">Tìm kiếm</button>
            </div>
        </form>
    </div>
    <div class="row">
        @foreach($bands as $band)
            <div class="col-xs-18 col-sm-6 col-md-3">
                <div class="hovereffect">
                    <img class="img-responsive" src="{{$band->avatar}}" alt="">
                    <div class="overlay">
                        <p>
                            {{$band->description}}
                        </p>
                        <a class="info"  href="{{route('bands.show', $band->slug)}}">Chi tiết</a>

                    </div>
                </div>
                <div class="overLayB">
                    <a class="info" href="{{url('/bands/'.$band->slug)}}"><h4>{{$band->name}}</h4></a>
                </div>
            </div>
        @endforeach
    </div>
    {{$bands->links()}}

@endsection