@extends('layouts.master')
@section('content')
    <section>
        <div class="container">
            <div class="title">
                <h1>Tin Tức</h1>
                <hr>
            </div>
            <!--bigNews-->
            <div class="row">
                {{--@foreach( $news->getAttributes() as $new)--}}
                <div class="col-xs-18 col-sm-6 col-md-12">
                    @if(!empty($news))
                        <a href=""><img src="{{url( $news->avatar)}}" class="img-resposive" style="width: 100%;">
                        </a>
                        <div class="row">
                            <div class="col-sm-12" style="margin-top: 5px">
                            </div>
                        </div>
                        <div class="caption">
                            <div class="titleNews">
						<span class="stext-105 cl3">
                            <strong><a href="{{ route('news.show',$news->id) }}"><h3>{{ $news->title }}</h3></a></strong>
						</span>
                            </div>
                            <div class="infoNews">
                                <label>Bởi: Admin |</label>
                                {{--<label> {{ $news->category->name }} |</label>--}}
                                <label> {{ $news->created_at->format('Y-m-d') }}  |</label>
                            </div>
                            <div class="sapo">
                                <p>{{ substr($news->description,0,400).'......' }}
                                    <a href="{{ route('news.show',$news->id) }}" class="fa fa-info-circle"> Đọc tiếp </a></p>
                            </div>
                        </div>
                    @endif
                </div>
                    {{--@endforeach--}}
            </div><!--/row-->
            <div class="row">
                <div class="col-xs-18 col-sm-6 col-md-6">
                    @if(!empty($news1))
                        <a href=""><img src="{{ url( $news1->avatar) }}" class="img-resposive"></a>
                        <div class="row">
                            <div class="col-sm-12" style="margin-top: 5px">
                            </div>
                        </div>
                        <div class="caption">
                        <div class="titleNews">
                            <span class="stext-105 cl3">
                            <strong><a href="{{ route('news.show',$news1->id) }}"><h4>{{ $news1->title }}</h4></a></strong>
                            </span>
                        </div>
                        <div class="infoNews">
                            <label>Bởi: Admin |</label>
                            {{--<label> {{ $news1->category->name }} |</label>--}}
                            <label> {{ $news1->created_at->format('Y-m-d') }}  |</label>
                        </div>
                        <div class="sapo">
                            <p>{{ substr($news1->description,0,400).'......' }}
                                <a href="{{ route('news.show',$news1->id) }}" class="fa fa-info-circle"> Đọc tiếp </a></p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-xs-18 col-sm-6 col-md-6">
                @if(!empty($news2))
                    <a href=""><img src="{{ url( $news2->avatar ) }}" class="img-resposive"></a>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top: 5px">
                        </div>
                    </div>
                    <div class="caption">
                    <div class="titleNews">
                    <span class="stext-105 cl3">
                    <strong><a href="{{ route('news.show',$news2->id) }}"><h4>{{ $news1->title }}</h4></a></strong>
                    </span>
                    </div>
                    <div class="infoNews">
                        <label>Bởi: Admin |</label>
                        {{--<label> {{ $news2->category->name }} |</label>--}}
                        <label> {{ $news2->created_at->format('Y-m-d') }} |</label>
                    </div>
                    <div class="sapo">
                        <p>{{ substr($news2->description,0,400).'......' }}
                            <a href="{{ route('news.show',$news2->id) }}" class="fa fa-info-circle"> Đọc tiếp </a></p>
                    </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-18 col-sm-6 col-md-4">
                @if(!empty($news3))
                    <a href=""><img src="{{ url( $news3->avatar) }}" class="img-resposive"></a>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top: 5px">
                        </div>
                    </div>
                    <div class="caption">
                        <div class="titleNews">
							<span class="stext-105 cl3">
								<strong><a href="{{ route('news.show',$news3->id) }}">{{ $news3->title }}</a></strong>
							</span>
                        </div>
                        <div class="infoNews">
                            <label>Bởi: Admin |</label>
                            {{--<label> {{ $news3->category->name }} |</label>--}}
                            <label> {{ $news3->created_at->format('Y-m-d') }} |</label>
                        </div>
                        <div class="sapo">
                            <p>{{ substr($news3->description,0,400).'......' }}
                                <a href="{{ route('news.show',$news3->id) }}" class="fa fa-info-circle"> Đọc tiếp </a></p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-xs-18 col-sm-6 col-md-4">
                <div>
                    @if(!empty($news4))
                        <a href=""><img src="{{ url( $news4->avatar) }}" class="img-resposive"></a>
                        <div class="row">
                            <div class="col-sm-12" style="margin-top: 5px">
                            </div>
                        </div>
                        <div class="caption">
                            <div class="titleNews">
								<span class="stext-105 cl3">
									<strong><a href="{{ route('news.show',$news4->id) }}">{{ $news4->title }}</a></strong>
								</span>
                            </div>
                            <div class="infoNews">
                                <label>Bởi: Admin |</label>
                                {{--<label> {{ $news4->category->name }} |</label>--}}
                                <label> {{ $news4->created_at->format('Y-m-d') }} |</label>
                            </div>
                            <div class="sapo">
                                <p>{{ substr($news4->description,0,400).'......' }}
                                    <a href="{{ route('news.show',$news4->id) }}" class="fa fa-info-circle"> Đọc tiếp </a></p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-xs-18 col-sm-6 col-md-4">
                <div>
                    @if(!empty($news5))
                        <a href=""><img src="{{ url( $news5->avatar) }}" class="img-resposive"></a>
                        <div class="row">
                            <div class="col-sm-12" style="margin-top: 5px">
                            </div>
                        </div>
                        <div class="caption">
                            <div class="titleNews">
								<span class="stext-105 cl3">
									<strong><a href="{{ route('news.show',$news5->id) }}">{{ $news5->title }}</a></strong>
								</span>
                            </div>
                            <div class="infoNews">
                                <label>Bởi: Admin |</label>
                                {{--<label> {{ $news5->category->name }} |</label>--}}
                                <label> {{ $news5->created_at->format('Y-m-d') }} |</label>
                            </div>
                            <div class="sapo">
                                <p>{{ substr($news5->description,0,400).'......' }}
                                    <a href="{{ route('news.show',$news5->id) }}" class="fa fa-info-circle"> Đọc tiếp </a></p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-xs-18 col-sm-6 col-md-4">
                <div>
                    @if(!empty($news6))
                        <a href=""><img src="{{ url( $news6->avatar) }}" class="img-resposive"></a>
                        <div class="row">
                            <div class="col-sm-12" style="margin-top: 5px">
                            </div>
                        </div>
                        <div class="caption">
                            <div class="titleNews">
								<span class="stext-105 cl3">
									<strong><a href="{{ route('news.show',$news6->id) }}">{{ $news6->title }}</a></strong>
								</span>
                            </div>
                            <div class="infoNews">
                                <label>Bởi: Admin |</label>
                                {{--<label> {{ $news6->category->name }} |</label>--}}
                                <label> {{ $news6->created_at->format('Y-m-d') }} |</label>
                            </div>
                            <div class="sapo">
                                <p>{{ substr($news6->description,0,400).'......' }}
                                    <a href="{{ route('news.show',$news6->id) }}" class="fa fa-info-circle"> Đọc tiếp </a></p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>



        </div> <!-- container -->
    </section>
    @endsection