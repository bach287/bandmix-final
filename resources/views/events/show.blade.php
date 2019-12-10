@extends('events.layout')
@section('event_content')
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
            <div class="second-part-chgpass row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-5 input-with-label">
                            <label> Tên Sự Kiện :</label>
                        </div>
                        <div class=" col-sm-5 input-with-content">
                            <label> {{ $event->name }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 input-with-label">
                            <label>Thời gian diễn ra :</label>
                        </div>
                        <div class=" col-sm-5 input-with-content">
                            <label>{{ $event->time}} Ngày {{date("d", strtotime($event->date))}}
                                tháng {{date("m", strtotime($event->date))}}
                                năm {{date("Y", strtotime($event->date))}}</label>
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
                    <div class="row">
                        <div class="col-md-12 input-with-label">
                            <label>Các tiết mục tiêu biểu: </label>
                        </div>
                        @foreach($event->bands as $item)
                            <div class=" col-sm-12 input-with-content">
                                <label>► <strong>{{ $item->pivot->act}}</strong> biểu diễn bởi: <strong><a style="text-decoration: none;" href="{{url(route('bands.show',$item->slug))}}">{{ $item->name}}</a></strong> </label>
                                <br/>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="col-sm-5 input-with-label">
                    <label>Mô Tả Chi Tiết:</label>
                </div>
                <div class=" col-sm-12 input-with-content">
                    <label>{!! $event->detail !!}</label>
                </div>
            </div>
            <div class="second-part-chgpass row">
                @if(Auth::id() != $event->member_id)
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-5 input-with-label">
                                <label>Số Lượng Vé :</label>
                            </div>
                            <div class=" col-sm-6 input-with-content">
                                <label>{{$event->vacancy}}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5 input-with-label">
                                <label>Số Lượng Vé Còn:</label>
                            </div>
                            <div class=" col-sm-6 input-with-content">
                                <label id="ticket_also">{{$event->ticket_also}}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5 input-with-label">
                                <label>Giá vé :</label>
                            </div>
                            <div class=" col-sm-6 input-with-content">
                                <label>{{ number_format($event->price) }} VNĐ</label>
                            </div>
                        </div>
                        @if($event->status == 1)
                            <form action="{{route('cart.store')}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="event_id" value="{{$event->id}}">
                                <div class="row">
                                    <div class="col-sm-5 input-with-label">
                                        <label>Số lượng:</label>
                                    </div>
                                    <div class=" col-sm-6 input-with-content">
                                        <input type="number" class="form-control" id="input-ticket"
                                               name="number_of_ticket" min="1" required>
                                        <label id="alert-label" style="color: red"></label>
                                    </div>
                                </div>
                                <div class="row">
                                    @if( $event->ticket_also != 0)
                                        <div class=" col-sm-6 input-with-content">
                                            <button id="addToCart" class="btn btn-danger">Mua vé</button>
                                        </div>

                                    @else
                                        <div class=" col-sm-6 input-with-content">
                                            <button disabled id="addToCart" class="btn btn-danger">Mua vé</button>
                                        </div>
                                        <span><p style="color: #9e2c2c;font-family: Arial;">Sự kiện đã bán hết vé!!!!</p></span>
                                    @endif
                                </div>
                            </form>
                        @else
                            <span><p style="color: #9e2c2c;font-family: Arial;">Sự kiện đã kết thúc!</p></span>

                        @endif
                    </div>
                @else
                    <p>Hãy xem sự kiện của bạn</p>
                @endif
            </div>

        </div>
    </div>
@endsection
@push('footer')
    <script>
        $(document).ready(function () {
            var ticket_also = $('#ticket_also').text();
            $('#input-ticket').attr({"max" : ticket_also});
        })
    </script>
@endpush