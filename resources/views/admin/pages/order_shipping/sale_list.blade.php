@extends('admin.layouts.boxed')

@section('head')
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
			Báo cáo doanh số
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
            <!-- Form Open -->
            
            <div class="nav-tabs-custom">

                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
						<table class="table table-bordered table-hover big-table-active">							
							<thead>
								<tr>
									<th colspan="9" align="center" height="25" valign="middle">TỔNG HỢP DOANH SỐ GIAO DỊCH VIÊN</th>
								</tr>
								<tr>
									<th colspan="9" align="center" height="25" valign="middle">Tên giao dịch viên: {{ $user->name }}</th>
								</tr>
								<tr>
									<th align="center" valign="middle">STT</th>
									<th align="center" valign="middle">Ngày</th>
									<th align="center" valign="middle">Mã đơn hàng</th>
									<th align="center" valign="middle">Mã giao dịch</th>
									<th align="center" valign="middle">Giá WEB</th>
									<th align="center" valign="middle">Giá thực tế</th>
									<th align="center" valign="middle">Ship WEB</th>
									<th align="center" valign="middle">Ship thực tế</th>
									<th align="center" valign="middle">Ghi chú</th>
								</tr>
							</thead>
							<tbody>
								@if($items)
									<?php $i = 1;?>
									<?php $count = 0;?>
									@foreach ($items as $item)
									<?php $count += $item->quantity;?>
									<tr>
										<td valign="middle" width="20" align="center" border="1">{{ $i }}</td>
										<td valign="middle" width="20">{{date('d/m/Y', strtotime($item->updated_at))}}</td>
										<td align="center" valign="middle" width="20">{{ $orderCode[$item->order_id] }}</td>
										<td valign="middle" width="20">{{ $item->purchase_codes }}</td>
										<td valign="middle" width="20">{{ $item->quantity * $item->price}}</td>
										<td valign="middle" width="20">{{ $item->cn_the_total_amount}}</td>
										<td valign="middle" width="20">{{ $item->cn_shipping_fee }}</td>
										<td valign="middle" width="20">{{ $item->cn_the_shipping_fee }}</td>
										<td valign="middle" width="20">{{ $item->note }}</td>
									</tr>
									<?php $i++;?>
									@endforeach
								@endif
							</tbody>
						</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer-content')
    <script>
        ion.sound.play("notify");
    </script>
@stop



