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
	table#data-table > tbody > tr.statistic > th{
		background-color: #ddffaa;
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
								<th align="center" height="50" width="85" valign="middle">Đơn hàng</th>
								<th align="center" height="50" width="100" valign="middle">Khách hàng</th>
								<th align="center" height="50" width="100" valign="middle">Mặt hàng</th>
								<th align="center" height="50" width="50" valign="middle">S.Lượng</th>
								<th align="center" height="50" width="90" valign="middle">Mã GD</th>
								<th align="center" height="50" width="50" valign="middle">Giá web</th>
								<th align="center" height="50" width="50" valign="middle">Ship NĐ</th>
								<th align="center" height="50" width="50" valign="middle">TT thực tế</th>
								<th align="center" height="50" width="100" valign="middle">Phí nhận hàng</th>
								<th align="center" height="50" width="50" valign="middle">P.Thu của khách</th>
								<th align="center" height="50" width="100" valign="middle">Đã T.Toán</th>
								<th align="center" height="50" width="50" valign="middle">Còn nợ</th>
								<th align="center" height="50" width="50" valign="middle">Số dư TK của khách</th>
								<th align="center" height="50" width="50" valign="middle">Tỷ giá</th>
								<th align="center" height="50" width="50" valign="middle">Giao dịch viên</th>
								<th align="center" height="50" width="60" valign="middle">Ngày phát hàng</th>

								<th align="center" height="50" width="80" valign="middle">Mã vận đơn</th>
								<th align="center" height="50" width="50" valign="middle">Cân nặng</th>
								<th align="center" height="50" width="50" valign="middle">Ngày nhận kho TQ</th>
								<th align="center" height="50" width="50" valign="middle">Ngày nhận kho HN</th>
								<th align="center" height="50" width="50" valign="middle">Ngày gửi cho khách hàng</th>
								<th align="center" height="50" width="50" valign="middle">Theo dõi TT hàng</th>
								<th align="center" height="50" valign="middle">Ghi chú</th>
							</tr>
							<tr class="lang-zh">
								<th align="center" height="30" valign="middle">日期</th>
								<th align="center" height="30" valign="middle">订单</th>
								<th align="center" height="30" valign="middle">客户</th>
								<th align="center" height="30" valign="middle">产品</th>
								<th align="center" height="30" valign="middle">数量</th>
								<th align="center" height="30" valign="middle">订单号</th>
								<th align="center" height="30" valign="middle">商品价格</th>
								<th align="center" height="30" valign="middle">物流价格</th>
								<th align="center" height="30" valign="middle">实付价格</th>
								<th align="center" height="30" valign="middle">链接服务费用</th>
								<th align="center" height="30" valign="middle">客户需付款</th>
								<th align="center" height="30" valign="middle">已付款</th>
								<th align="center" height="30" valign="middle">结余（客户欠我们为+我们欠客户为-）</th>
								<th align="center" height="30" valign="middle">结算客户账户结余</th>
								<th align="center" height="30" valign="middle">汇率</th>
								<th align="center" height="30" valign="middle">客服</th>
								<th align="center" height="30" valign="middle">发货时间</th>
								<th align="center" height="30" valign="middle">运单号</th>
								<th align="center" height="30" valign="middle">货物重量(Kg)</th>
								<th align="center" height="30" valign="middle">到凭祥日期</th>
								<th align="center" height="30" valign="middle">到河内日期</th>
								<th align="center" height="30" valign="middle">发给客户日期</th>
								<th align="center" height="30" valign="middle">货物跟踪信息</th>
								<th align="center" height="30" valign="middle">货物备注</th>
							</tr>
						</thead>
						<tbody>
							@if($orders)
							<tr class="statistic">
								<th align="center" height="20" width="60" valign="middle"></th>
								<th align="center" height="20" width="85" valign="middle"></th>
								<th align="center" height="20" width="100" valign="middle"></th>
								<th align="center" height="20" width="100" valign="middle"></th>
								<th class="text-right" align="center" height="20" width="50" valign="middle">{{number_format($statistic['quantity_total'])}}</th>
								<th align="center" height="20" width="90" valign="middle"></th>
								<th align="center" height="20" width="50" valign="middle"></th>
								<th class="text-right" align="center" height="20" width="50" valign="middle">{!! Currency::displayBold($statistic['cn_shipping_fee'], 'cn') !!}</th>
								<th class="text-right" align="center" height="20" width="50" valign="middle">{!! Currency::displayBold($statistic['cn_the_total_amount'], 'cn') !!}</th>
								<th class="text-right" align="center" height="20" width="100" valign="middle">{!! Currency::displayBold($statistic['service_fee'], 'vn') !!}</th>
								<th class="text-right" align="center" height="20" width="50" valign="middle">{!! Currency::displayBold($statistic['vn_total_amount'], 'vn') !!}</th>
								<th class="text-right" align="center" height="20" width="100" valign="middle">{!! Currency::displayBold($statistic['payed_total'], 'vn') !!}</th>
								<th class="text-right" align="center" height="20" width="50" valign="middle">{!! Currency::displayBold($statistic['debt_total'], 'vn') !!}</th>
								<th align="center" height="20" width="50" valign="middle"></th>
								<th align="center" height="20" width="50" valign="middle"></th>
								<th align="center" height="20" width="50" valign="middle"></th>
								<th align="center" height="20" width="60" valign="middle"></th>
								<th align="center" height="20" width="80" valign="middle"></th>
								<th class="text-right" align="center" height="20" width="50" valign="middle">{{number_format($statistic['weight_total'])}}</th>
								<th align="center" height="20" width="50" valign="middle"></th>
								<th align="center" height="20" width="50" valign="middle"></th>
								<th align="center" height="20" width="50" valign="middle"></th>
								<th align="center" height="20" width="50" valign="middle"></th>
								<th align="center" height="20" valign="middle"></th>
							</tr>
							
								@foreach ($orders as $order)

									@if(!$order->items->isEmpty() && !empty($order->items))
										<?php $i = 1;?>
										@foreach ($order->items as $item)
											@if ($item->package != null)
												<tr class="color-{{$item->package->status}}">
											@else
												<tr>
											@endif
										        <td  width="20" height="20" valign="middle">{{date('d/m/Y', strtotime($order->created_at))}}</td>

										        <td  width="20" height="20" valign="middle"><a href="/admin/order_shipping/{{$order->id}}" title="Xem chi tiết đơn hàng">{{$order->order_code}}</a></td>

										        <td class="white-space" width="20" height="20" valign="middle"><a href="/admin/user/{{$order->user_id}}" title="Xem khách hàng" >{{$order->user->name}}</a></td>

										        <td  width="20" height="20" valign="middle">{{$item->title}}</td>

										        <td class="text-right" width="20" height="20" valign="middle">{{ number_format($item->quantity) }}</td>

										        <td  width="20" height="20" valign="middle">{{$item->purchase_codes}}</td>

										        <td class="text-right" width="20" height="20" valign="middle">{!! Currency::displayBold($item->price, 'cn') !!}</td>

												<td class="text-right" width="20" height="20" valign="middle">{!! Currency::displayBold($item->cn_shipping_fee, 'cn') !!}</td>

												<td class="text-right" width="20" height="20" valign="middle">{!! Currency::displayBold($item->cn_the_total_amount, 'cn') !!}</td>

												@if ($i == 1)
													@if($order->order_attr == \App\OrderShipping::ORDER_STANDARD)
														<td class="text-right" width="20" height="20" valign="middle">{!! Currency::displayBold($order->service_fee, 'vn') !!}</td>
													@else ($order->order_attr == \App\OrderShipping::ORDER_VIP)
														<td class="text-right" width="20" height="20" valign="middle">{!! Currency::displayBold($order->received_fee, 'vn') !!}</td>
													@endif
													<td class="text-right" width="20" height="20" valign="middle">{!! Currency::displayBold($order->vn_total_amount, 'vn') !!}</td>
													<td class="text-right" width="20" height="20" valign="middle">{!! Currency::displayBold($order->deposit + $order->received_fee, 'vn') !!}</td>
													<td class="text-right" width="20" height="20" valign="middle">
													{!! Currency::displayBold(($order->deposit + $order->received_pay) - $order->vn_total_amount, 'vn') !!}</td>
													<td class="text-right" width="20" height="20" valign="middle">{!! Currency::displayBold($order->user->acc_money, 'vn') !!}</td>
													<td class="text-right" width="20" height="20" valign="middle">{!! Currency::displayBold($order->cny_to_vnd, 'vn') !!}</td>
													@if($order->admin != null)
														<td  width="20" height="20" valign="middle">{{$order->admin->name}}</td>
													@else
														<td  width="20" height="20" valign="middle"></td>
													@endif
												@else
													<td  width="20" height="20" valign="middle"></td>
													<td  width="20" height="20" valign="middle"></td>
													<td  width="20" height="20" valign="middle"></td>
													<td  width="20" height="20" valign="middle"></td>
													<td  width="20" height="20" valign="middle"></td>
													<td  width="20" height="20" valign="middle"></td>
													<td  width="20" height="20" valign="middle"></td>
												@endif
												@if($item->package != null && $item->package->updated_release_st != 0)
													<td  width="20" height="20" valign="middle">{{date('d/m/Y', strtotime($item->package->updated_release_st))}}</td>
												@else 
													<td  width="20" height="20" valign="middle"></td>
												@endif
												
												<td class="bg-status" width="20" height="20" valign="middle">{{$item->transport_code}}</td>
												@if($i == 1)
													<td class="text-right" width="20" height="20" valign="middle">{{number_format($order->weight)}}</td>
												@else 
													<td class="text-right" width="20" height="20" valign="middle"></td>
												@endif
												@if($item->package != null && $item->package->updated_storage_cn_st != 0)
													<td  width="20" height="20" valign="middle">{{date('d/m/Y', strtotime($item->package->updated_storage_cn_st))}}</td>
												@else 
													<td  width="20" height="20" valign="middle"></td>
												@endif
												@if($item->package != null && $item->package->updated_storage_vn_st != 0)
													<td  width="20" height="20" valign="middle">{{date('d/m/Y', strtotime($item->package->updated_storage_vn_st))}}</td>
												@else 
													<td  width="20" height="20" valign="middle"></td>
												@endif
												@if($item->package != null && $item->package->updated_shipping_vn_st != 0)
													<td  width="20" height="20" valign="middle">{{date('d/m/Y', strtotime($item->package->updated_shipping_vn_st))}}</td>
												@else 
													<td  width="20" height="20" valign="middle"></td>
												@endif
												<td  width="20" height="20" valign="middle"></td>
												<td height="20" valign="middle">{{$item->note}}</td>
												
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





