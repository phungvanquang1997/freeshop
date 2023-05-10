@extends('admin.layouts.boxed')

@section('head')
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Phiếu giảm giá: {{ $coupons->name }}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li class="active"><a href="{{ url('admin/coupons') }}">{{trans('lang.list')}}</a></li>
            <li class="active"><a href="">{{ $coupons->name }}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-2 pull-right text-right">
                    <a class="btn btn-default" href="{{ url('admin/coupons') }}">Quay lại</a>
                </div>
            </div>
            <div class="form-horizontal">
                {!! App\Helpers\MyHtml::show('Mã khuyến mại', $coupons->voucher) !!}
                {!! App\Helpers\MyHtml::show('Tên', $coupons->name) !!}
                {!! App\Helpers\MyHtml::show('Giá trị', $coupons->value) !!}
                {!! App\Helpers\MyHtml::show('Loại', App\Coupons::$types[$coupons->type]) !!}
                {!! App\Helpers\MyHtml::show('Ngày bắt đầu', date('d/m/Y', strtotime($coupons->start_date))) !!}
                {!! App\Helpers\MyHtml::show('Ngày kêt thúc', date('d/m/Y', strtotime($coupons->end_date))) !!}
                {!! App\Helpers\MyHtml::show('Số lần sử dụng', $coupons->num) !!}
                {!! App\Helpers\MyHtml::show('Số lần/ khách', $coupons->num_per_user) !!}
                {!! App\Helpers\MyHtml::show('Số lần đã sử dụng', $coupons->num_used) !!}
                {!! App\Helpers\MyHtml::show('Trạng thái', trans(App\Coupons::$status[$coupons->status])) !!}
            </div>
            <table class="table table-bordered table-striped dataTable" role="grid">
                <thead>
                    <tr role="row">
                        <th tabindex="0" class="text-center">Đơn hàng</th>
                        <th tabindex="0" class="text-center">Khách hàng</th>
                        <th tabindex="0" class="text-center">Ngày sử dụng</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$coupons->couponUserOrders()->get()->isEmpty())
                        @foreach ($coupons->couponUserOrders()->get() as $item)
                    
                        <tr>    
                            <td class="text-center">
                                {{ $item->order->id}}
                            </td>                      
                            <td class="text-center">{{ $item->user->name}}</td>
                           
                            <td class="text-center">{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                            
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="3" class="text-center">
                        Chưa có đơn hàng nào sử dụng phiếu giảm giá này</td>
                    </tr>                        
                    @endif                   
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('footer-content')
    <script>
        $(function () {
            $('#data-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "order": [1,2]
            });

            $('.select-type').on('change', function () {
                $(location).attr('href', '{{ URL::current() }}?type=' + $(this).val());
            });
        });
        function del_menu_confirm()
        {
            var text = "{{trans('lang.del_menu_confirm')}}";
            return confirm(text);
        }
    </script>

@stop

