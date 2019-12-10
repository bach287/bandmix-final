@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-18 col-sm-6 col-md-12">
                <a href=""><img class="img-news" src="{{ url( $news->avatar) }}" class="img-resposive">
                </a>
                {{--<div class="row">--}}
                    {{--<div class="col-sm-12" style="margin-top: 5px">--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="caption">
                    <div class="infoNews">
                        <label>Bởi: Admin |</label>
                        <label> FanBand |</label>
                        <label> {{ $news->created_at->format('d M Y - H:i:s') }} |</label>
                    </div>
                    <div class="titleNews">
						<span class="stext-105 cl3">
                            <strong><h1 style="text-align: center">{{ $news->title }}</h1></strong>
						</span>
                    </div>

                    <div class="sapo">
                        <p>{!! $news->body !!}</p>
                            {{--<a href="newdetail.html" class="fa fa-info-circle"> Đọc tiếp </a></p>--}}
                    </div>
                </div>
            </div>
        </div><!--/row-->
    </div>
    <div class="tab-rate">
        <div class="fb-comments" data-href="https://www.facebook.com/Soriking" data-numposts="5"></div>
    </div>

@endsection
