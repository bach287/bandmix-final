@extends('layouts.master')
@push('header')
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/css.css">
	<link rel="stylesheet" type="text/css" href="css/loginCss.css">
@endpush
@section('content')
    <div class="container">
        <!-- Top Event -->
        <div class="title">
            <h2>Sự Kiện Mới</h2>
            <hr>
        </div>
        <div class="row">
            @foreach($events as $event)
                <div class="col-xs-18 col-sm-6 col-md-4" style="height: 370px">

                    <div class="hovereffectE">
                        <img class="img-responsive" src="{{ url($event->avatar) }}" alt="">
                        <div class="overlayE">
                            <h2>{{ $event->name }}</h2>
                            <p >
                                {{$event->description}}
                            </p>
                        </div>
                    </div>
                    <div class="card-body relative">
                        <div class="table w-100 margin-bottom-0">

                            <a class="eventTitle" href="{{route('events.show', $event->id)}}">
                                <h4 style="text-align: center">{{ $event->name }}</h4>
                            </a>
                        </div>
                        <div class="row">
                            <div class="table-cell" style="width: 170px;">
                                <div class="event-price w-100">
                                    <span class="color-6">Gía vé :</span> <strong> {{ number_format($event->price) }} VNĐ</strong>
                                </div>
                                <div class="event-tags w-100">
									<span class="tag-venues">
										<span class="tag-venue smooth-trans label-default uppercase">{{$event->locations->name}}</span>
									</span>

                                </div>
                            </div>
                            <div class="event-date">
                                <div class="relative">
                                    <div class="date-month">
                                        {{date("F", strtotime($event->date))}}
                                    </div>
                                    <div class="date-detail">
                                        <div class="date-num color-6">
                                            {{date("d", strtotime($event->date))}}
                                        </div>
                                        <div class="date-day">
                                            {{date("D", strtotime($event->date))}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> <!-- row -->
        <!-- List Event -->
        <div class="title">
            <h2>Danh Sách Sự Kiện</h2>
            <hr>
        </div>
        <div class="row justify-content-center">
            <form class="form-inline search-form">
                <div class="form-group" >
                    <input type="text" value="{{request()->get('keyword')}}" class="form-control" name="keyword" placeholder="Tìm kiếm" aria-label="Search" style="width: 30%">
                        <select class="form-control select-op" name="search_select" >
                            <option value="" selected>Giá vé</option>
                            <option {{request()->get('search_select') == 'asc' ?'selected' : ''}} value="asc">Giá: thấp->cao</option>
                            <option {{request()->get('search_select') == 'desc' ?'selected' : ''}} value="desc">Giá: cao->thấp</option>
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
            @foreach($events_search as $event)
                <div class="col-xs-18 col-sm-6 col-md-4" style="height: 370px">

                    <div class="hovereffectE">
                        <img class="img-responsive" src="{{ url($event->avatar) }}" alt="">
                        <div class="overlayE">
                            <h2>{{ $event->name }}</h2>
                            <p >
                                {{$event->description}}
                            </p>
                        </div>
                    </div>
                    <div class="card-body relative">
                        <div class="table w-100 margin-bottom-0">

                            <a class="eventTitle" href="{{route('events.show', $event->id)}}">
                                <h4 style="text-align: center">{{ $event->name }}</h4>
                            </a>
                        </div>
                        <div class="row">
                            <div class="table-cell" style="width: 170px;">
                                <div class="event-price w-100">
                                    <span class="color-6">Gía vé :</span> <strong> {{ number_format($event->price) }} VNĐ</strong>
                                </div>
                                <div class="event-tags w-100">
									<span class="tag-venues">
										<span class="tag-venue smooth-trans label-default uppercase">{{$event->locations->name}}</span>
									</span>

                                </div>
                            </div>
                            <div class="event-date">
                                <div class="relative">
                                    <div class="date-month">
                                        {{date("F", strtotime($event->date))}}
                                    </div>
                                    <div class="date-detail">
                                        <div class="date-num color-6">
                                            {{date("d", strtotime($event->date))}}
                                        </div>
                                        <div class="date-day">
                                            {{date("D", strtotime($event->date))}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{$events_search->links()}}
        </div> <!-- row -->
        <div class="title">
            <h2>Sản phẩm nổi bật</h2>
            <hr>
        </div>
        <div class="row">

            <div class="col-xs-18 col-sm-6 col-md-3">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/hAs-l3vqaaE" frameborder="0"
                            allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>

            <div class="col-xs-18 col-sm-6 col-md-3">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/7NJqUN9TClM" frameborder="0"
                            allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>

            <div class="col-xs-18 col-sm-6 col-md-3">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/7NJqUN9TClM" frameborder="0"
                            allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>

            </div>
            <div class="col-xs-18 col-sm-6 col-md-3">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/nKcUxurCOrU" frameborder="0"
                            allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
        </div><!--/row-->
    </div> <!-- container -->
@endsection