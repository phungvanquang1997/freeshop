<style type="text/css" media="screen">
	tr>td {
		border: 1px solid #000000;
	}
	tr>th {
		border: 1px solid #000000;
	}
	table > tbody > tr.color-15 > td.bg-status {
		background-color: #ffd700;
	}
	table > tbody > tr.color-9 > td.bg-status {
		background-color: #ec4758;
	}
	table > tbody > tr.color-11 > td.bg-status {
		background-color: #3fab32;
	}
</style>
<table style="font-size: 14px;">
	<thead>
		<tr>
			<th style="background: #bfffe6" align="center" height="50" valign="middle">Ngày</th>
			<th style="background: #bfffe6" align="center" height="50" valign="middle">Đơn hàng</th>
			<th style="background: #bfffe6" align="center" height="50" valign="middle">Khách hàng</th>
			<th style="background: #bfffe6" align="center" height="50" valign="middle">Mã vận đơn</th>
			<th style="background: #bfffe6" align="center" height="50" valign="middle">Số cân (Kg)</th>
			<th style="background: #bfffe6" align="center" height="50" valign="middle">Thành tiền</th>
			<th style="background: #bfffe6" align="center" height="50" valign="middle">Tiền lấy hàng</th>
			<th style="background: #bfffe6" align="center" height="50" valign="middle">Ghi chú</th>
		</tr>
		<tr>
			<th style="font-size: 10px;background-color: #ffefed" align="center" height="30" valign="middle">日期</th>
			<th style="font-size: 10px;background-color: #ffefed" align="center" height="30" valign="middle">订单</th>
			<th style="font-size: 10px;background-color: #ffefed" align="center" height="30" valign="middle">客户</th>
			<th style="font-size: 10px;background-color: #ffefed" align="center" height="30" valign="middle">运单号</th>
			<th style="font-size: 10px;background-color: #ffefed" align="center" height="30" valign="middle">重量</th>
			<th style="font-size: 10px;background-color: #ffefed" align="center" height="30" valign="middle">成钱</th>
			<th style="font-size: 10px;background-color: #ffefed" align="center" height="30" valign="middle">凭祥取货费</th>
			<th style="font-size: 10px;background-color: #ffefed" align="center" height="30" valign="middle">注意</th>
		</tr>
	</thead>
	<tbody>
		@if($orders)
			@foreach ($orders as $order)

				@if(!$order->packages->isEmpty())
					<?php $i = 1;?>
					@foreach ($order->packages as $item)
						<tr class="color-{{$item->status}}">
					        <td  width="20" height="20" valign="middle">{{date('d/m/Y', strtotime($order->created_at))}}</td>

					        <td  width="20" height="20" valign="middle">{{$order->order_code}}</td>

					        <td  width="20" height="20" valign="middle">{{$order->user->name}}</td>

					        <td class="bg-status" width="20" height="20" valign="middle">{{$item->transport_code}}</td>

					        <td  width="20" height="20" valign="middle">{{$item->weight}}</td>

					        <td  width="20" height="20" valign="middle">{{$item->weight_fee}}</td>

					        <td  width="20" height="20" valign="middle">{{$item->cn_shipping_fee}}</td>
							<td  width="20" height="20" valign="middle">{{$item->note}}</td>
					    </tr>
					    <?php $i++;?>
					@endforeach
				@endif
			@endforeach
		@endif
	</tbody>
</table>