@extends('layouts.master')
@push('header')
    <link rel="stylesheet" href="{{url('css/member.css')}}">
    {{--<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

    //css data tables
@endpush
@section('content')
    <div class="card-outside">
        <div class="cart_status row">

            <div class="col-sm-3 menu_left">

                <div class="rounded-circle">
                    <div>
                        <p>
                            <img src="{{url($member->avatar)}}" style="height: 255px; width: 255px;">
                        </p>
                    </div>
                    <div class="textUser" style="">
                        <div style="text-align: center">
                            <h4>{{$member->name}}</h4>
                        </div>
                    </div>
                </div>
                @if($member->id == Auth::id())
                    <div class="change-user-infor">
                        <div class="row">
                            <div class="col-sm-2">
                                <i class="fa fa-user-circle"></i>
                            </div>
                            <div>
                                <label >Thông tin cá nhân</label>
                            </div>
                        </div>
                        <div class="menu-child">

                            <a href="{{route('members.edit', $member->id)}}"> <label class="pointer-user" >Chỉnh sửa thông tin</label></a>
                        </div>

                    </div>
                    <div class="lesson-menu">
                        <div class="row">
                            <div class="col-sm-2">
                                <i class="fa fa-bell" aria-hidden="true"></i>
                            </div>
                            <div>
                                <a href="{{route('member.noti',$member->id)}}">
                                    <label class="pointer-user">
                                        Thông báo
                                    </label>
                                    <label for="" style="color: red; margin-left: 2px;">
                                        ({{ count($member->notifications)}})
                                    </label>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="change-user-infor">
                        <div class="row">
                            <div class="col-sm-2">
                                <i class="fa fa-usd" aria-hidden="true"></i>
                            </div>
                            <div>
                                <a href="{{ route('members.manageBill',$member->id) }}">
                                    <label class="pointer-user">Lịch sử giao dịch</label>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="change-user-infor">
                        <div class="row">
                            <div class="col-sm-2">
                                <i class="fa fa-ticket"></i>
                            </div>
                            <div>
                                <a href="{{ route('members.manageBook',$member->id) }}">
                                    <label class="pointer-user">Quản lý đơn hàng</label>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="menu-right-chgpass">
                <div class="col-sm-12" id="id_info">
                    <div class="second-part-chgpass ">
                        <div class="row">

                            <div class="col-sm-4 input-with-label">
                                <label><i class="fa fa-motorcycle"></i> Tổng các sự kiện đã tạo: </label>
                                <label for=""><strong>{{ count($event) }}</strong></label>
                            </div>


                        </div>
                    </div>

                    <div id="pending-content" class="tab-content" style="display: block;">
                        <br>
                        <div class="text-center margin-10">
                            <h2>Quản lý chi tiết các sự kiện đã tạo</h2>
                            <br>
                            <div class="da-hoc-content row">
                                <form action="" class="table_book">
                                    <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                        <div class="dataTables_length" id="myTable_length">

                                            <table style=" width: 101%;" class="table table-bordered" id="eventsTable">
                                                <thead>
                                                <tr>
                                                    <th>Tên sự kiện</th>
                                                    <th>Số lượng vé</th>
                                                    <th>Giá vé (VND)</th>
                                                    <th>Số vé còn</th>

                                                </tr>
                                                </thead>
                                            </table>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer')
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('#eventsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('members.dataBook') }}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'vacancy', name: 'vacancy'},
                    {data: 'price', name: 'price'},
                    {data: 'ticket_also', name: 'ticket_also'},
                ],
                language: {
                    "lengthMenu": "Hiển thị _MENU_ bản ghi " +
                        "mỗi trang",
                    "zeroRecords": "Không tìm thấy kết quả phù hợp",
                    "info": "Hiển thị trang  _PAGE_ trên tổng _PAGES_",
                    "infoEmpty": "Không có bản ghi phù hợp",
                    "infoFiltered": "(Tổng số kết quả _MAX_ )",
                    "search":"Tìm kiếm:",
                }
            });
        });
    </script>
@endpush