@extends('admin.layouts.boxed')

@section('head')
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css') }}">
@stop

@section('style')
<style type="text/css" media="screen">
	table#data-table > thead > tr > th {
		padding: 5px 8px;
		text-align: center;
		vertical-align: middle;
		min-width: 80px;
	}
	table#data-table > thead > tr.lang-zh > th {
		font-size: 12px;
		background-color: #ffc4ca;
	}
	table#data-table > thead > tr.lang-vi > th {
		background: #44b8fc;
	}
	
	table#data-table > tbody > tr > td.white-space {
		white-space: nowrap;
	}
	table#data-table > tbody > tr.color-15 > td.bg-status {
		background-color: #ffd700;
	}
	table#data-table > tbody > tr.color-9 > td.bg-status {
		background-color: #ec4758;
	}
	table#data-table > tbody > tr.color-11 > td.bg-status {
		background-color: #3fab32;
	}
</style>
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
			Theo dõi đơn hàng
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li class="active">{{trans('lang.barcode')}}</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
        	@include('admin.pages.order_shipping._filter_list_orders')

            <!-- Form Open -->
            <div class="nav-tabs-custom">
            	<div class="table-responsive">                    
					<table id="data-table" class="table table-bordered table-hover big-table-active">
						<thead>
							<tr class="lang-vi">
								<th align="center" height="50" width="60" valign="middle">Ngày</th>
								<th align="center" height="50" width="100" valign="middle">Đơn hàng</th>
								<th align="center" height="50" width="100" valign="middle">Khách hàng</th>
								<th align="center" height="50" width="50" valign="middle">Mã vận đơn</th>
								<th align="center" height="50" width="90" valign="middle">Số cân nặng (Kg)</th>
								<th align="center" height="50" width="50" valign="middle">Thành tiền</th>
								<th align="center" height="50" width="50" valign="middle">Tiền lấy hàng</th>
								<th align="center" height="50" width="50" valign="middle">Ghi chú</th>
							</tr>
						</thead>
						<tbody>
							@if($orders)
								@foreach ($orders as $order)

									@if(!$order->packages->isEmpty() && !empty($order->packages))
										<?php $i = 1;?>
										@foreach ($order->packages as $item)
											<tr class="color-{{$item->status}}">
										        <td  width="20" height="20" valign="middle">{{date('d/m/Y', strtotime($order->created_at))}}</td>

										        <td  width="20" height="20" valign="middle">{{$order->order_code}}</td>

										        <td class="white-space" width="20" height="20" valign="middle">{{$order->user->name}}</td>

										        <td class="bg-status" width="20" height="20" valign="middle">{{ $item->transport_code }}</td>

										        <td  width="20" height="20" valign="middle">{{ number_format($item->weight) }}</td>

										        <td  width="20" height="20" valign="middle">{!! Currency::displayBold($item->weight_fee, 'vn') !!}</td>

												<td  width="20" height="20" valign="middle">{!! Currency::displayBold($item->cn_shipping_fee, 'cn') !!}</td>

												<td  width="20" height="20" valign="middle">{{$item->note}}</td>
												
										    </tr>
										    <?php $i++;?>
										@endforeach
									@endif
								@endforeach
							@endif
						</tbody>
					</table>
				</div>
            </div>
        </div>
    </div>
@stop
@section('footer-content')
    <script>
        ion.sound.play("notify");
    </script>

    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
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
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "order": []
            });
        });

    </script>

@stop





