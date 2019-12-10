@extends('layouts.master')
@section('content')
    <div class="container">
        <!-- List Event -->
        <div class="title">
            <div class="type-1">
                <div>
                    <a href="{{ route('events.create') }}" class="btn btn-1 create">
                        <span class="txt">Tạo Sự Kiện</span>
                        <span class="round"><i class="fa fa-plus"></i></span>
                    </a>
                </div>
            </div>
            <h2>Các sự kiện đã tạo</h2>
            <hr>
        </div>
        <div class=" row">
            <form class="form-inline search-form">
                <input type="hidden" name="member_id" value="{{Auth::id()}}">
                <div class="form-group" style="margin-left: 54%">
                    <input type="text" value="{{request()->get('keyword')}}" class="form-control" name="keyword" placeholder="Tìm kiếm" aria-label="Search" style="width: 30%">
                    <select class="form-control select-op" name="search_location">
                        <option value="" selected>Địa điểm</option>
                        @foreach($locations as $location)
                            <option {{ $location->id == request()->get('search_location') ? 'selected' : '' }} value="{{ $location->id }}" >{{ $location->name }}</option>
                        @endforeach
                    </select>
                    <select class="form-control select-op" name="search_date">
                        <option value="">Thời gian</option>
                        <option value=">" {{request()->get('search_date') == '>' ? 'selected' : ''}}>Sắp diễn ra</option>
                        <option value="<" {{request()->get('search_date') == '<' ? 'selected' : ''}}>Đã diễn ra</option>
                    </select>
                    <button type="submit" class="btn btn-default searchA ">Tìm kiếm</button>
                </div>
                {{--<p class="event_count">Tìm thấy {{count($events_search)}} sản phẩm</p>--}}
            </form>

        </div>
        <!--sukien-->
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
                        <form action="{{route('events.delete',$event->id)}}" style="margin: 0;padding: 0">
                            <label href="" id="btn-delete" class="btn btn-danger" style="width: 100%;">
                                <i class="fa fa-trash-o"></i> Xoá
                            </label>
                        </form>
                        <div class="iconSED">
                            @if($event->status == 2)
                            <a href="{{route('events.review',$event->id)}}" class="btn btn-default btnicon">
                                <i class="fa fa-edit"></i> Đang chờ duyệt...
                            </a >
                            @endif
                            @if($event->status == 1)
                                <a class="btn btn-default btnicon" style="pointer-events: none; color: white">
                                    <i class="fa fa-star"></i> Đang diễn ra
                                </a >
                            @endif
                            @if($event->status == 0)
                                <a class="btn btn-default btnicon" style="pointer-events: none; color: white">
                                    <i class="fa fa-calendar-times-o" aria-hidden="true"></i> Đã kết thúc
                                </a >
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            {{$events->links()}}
        </div> <!-- row -->
    </div> <!-- container -->
@endsection