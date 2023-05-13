@extends('admin.layouts.boxed')

@section('head')
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css') }}">
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{ $user->is_admin == 1 ? trans('lang.admin') : trans('lang.users') }}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
             @if($user->is_admin == 1)
            <li><a href="{{ url('admin/user?is_admin=1') }}">{{trans('lang.list')}}</a></li>
            @else 
            <li><a href="{{ url('admin/user') }}">{{trans('lang.name')}}</a></li>
            @endif
            <li class="active"><a href="#">{{ $user->name }}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">

            <!-- User information -->
            <div class="form-horizontal">
                {!! App\Helpers\MyHtml::show(trans('lang.full_name'), $user->name) !!}
                {!! App\Helpers\MyHtml::show(trans('lang.email'), $user->email) !!}
                {!! App\Helpers\MyHtml::show(trans('lang.phone'), $user->phone) !!}
                {!! App\Helpers\MyHtml::show(trans('lang.address'), $user->address) !!}
                @if (isset($orders))
                {!! App\Helpers\MyHtml::show('Tổng số đơn hàng:', count($orders)) !!}
                {!! App\Helpers\MyHtml::show('Tổng đơn (VNĐ):', number_format($totalAmount)) !!}
                {!! App\Helpers\MyHtml::show('Đã thanh toán (VNĐ):', number_format($totalPaymented)) !!}
                @endif
            </div>
            <!-- User's order list -->
            @if($user->is_admin == 0)
            <h4>Danh sách đơn hàng:</h4>

            <div class="row no-padding filter-container">
                {!! \Form::open(['method' => 'GET', 'url' => url('admin/user/' . $user->id)]) !!}
                <div class="form-group">
                    <div class="col-sm-2">
                        <input name="orderId" type="text" class=" form-control" value="{{ request()->has('orderId') ? request()->get('orderId') : '' }}" placeholder="Mã đơn hàng">
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group date">
                            <input name="date" type="text" class=" form-control" id="datepicker" value="{{ request()->has('date') ? request()->get('date') : '' }}">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <select data-type="status" class="form-control" name="status">

                            <option value="">Tất cả</option>
                            @forelse(\App\Order::allStatus() as $key => $value)
                                <option value="{{ $key }}" {{ request()->has('status') && request()->get('status') == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
                            @empty
                            @endforelse

                        </select>
                    </div>                    
                    <?php 
                        $date = isset($_GET['date']) ? $_GET['date'] : null;
                        $date = base64_encode($date);
                    ?>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>     
                </div>
               
                {!! \Form::close() !!}
            </div>

            <table id="data-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="10%">#</th>
                    <th width="30%">{{trans('lang.created_date')}}</th>
                    <th width="30%">{{trans('lang.total_amount')}}</th>
                    <th width="30%">{{trans('lang.status')}}</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($orders))
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ date('d/m/Y h:i A', strtotime($order->created_at)) }}</td>
                        <td>{!! \App\Helpers\Currency::display($order->total_amount)  !!}</td>
                        <td>{!! \App\Helpers\MyHtml::displayOrderStatus($order) !!}</td>
                    </tr>
                @endforeach
                @endif
                </tbody>

            </table>
            @else 
            @endif
        </div>
    </div>
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
        });
    </script>
@stop
