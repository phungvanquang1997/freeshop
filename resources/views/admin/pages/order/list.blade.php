@extends('admin.layouts.boxed')

@section('head')
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css') }}">
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Đơn hàng
            <small>danh sách</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> Home</a></li>
            <li><a href="{{ url('admin/order') }}">Đơn hàng</a></li>
            <li class="active"><a href="#">Danh sách</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">

            @include('admin.pages.order._filter')

            <table id="data-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Tiền hàng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th width="10%"></th>
                        <th>Thời Gian</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            @if ($order->user_id > 0)
                            <a href="/admin/user/{{$order->user_id}}" title="">{{ $order->name }}</a>
                            @else 
                            {{ $order->name }}
                            @endif
                        </td>
                        <td>{{ $order->phone }}</td>
                        <td>{!! Currency::display($order->total_amount) !!}</td>
                        <td>
                        <?php $gross = ($order->total_amount + $order->shipping_cost - $order->discount) > 0 ? $order->total_amount + $order->shipping_cost - $order->discount : 0;?>
                        {!! Currency::display($gross) !!}
                        </td>
                        <td>{!! MyHtml::displayOrderStatus($order, 'normal') !!}</td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-xs btn-default font14 btn-action" data-toggle="tooltip" title="{{trans('lang.view')}}" onclick="$.showOrderDetail('{{ $order->id }}')">
                                <i class="fa fa-eye"></i></a>
                                {{-- 
                            {!! Form::open(['method' => 'DELETE', 'url' => 'admin/order/' . $order->id, 'class' => 'inline']) !!}
                                    <button type="submit" data-toggle="tooltip" title="{{trans('lang.del')}}" onclick="return del_menu_confirm()" class="btn btn-xs btn-danger font14"><i class="fa fa-trash-o"></i></button>
                                {!! Form::close() !!}

                                --}}
                        </td>
                        <td>{{ date('d/m/Y H:i', strtotime($order->created_at)) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="modal-order-detail"></div>
@stop

@section('footer-content')
    <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#datepicker').daterangepicker({
                format: 'DD/MM/YYYY'
            });
        });
    </script>
    <script>
        $(function () {
            $('#data-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "order": []
            });

            $.showOrderDetail = function(orderId) {

                $.get(siteUrl + '/admin/order/' + orderId, function(data) {
                    $("#modal-order-detail").html(data);
                    $(".order-details").modal('show');
                });
            };
        });
    </script>

@stop

