<style type="text/css" media="screen">
	tr>td {
		border: 1px solid #000000;
	}
	tr>th {
		border: 1px solid #000000;
	}
</style>
<table style="font-size: 14px;">
	<thead>
		<tr>
			<th colspan="12" align="center" height="25" valign="middle">THÔNG TIN CỤ THỂ ĐƠN HÀNG SỐ: {{ $order->order_code }}</th>
		</tr>
		<tr>
			<th colspan="12" align="center" height="25" valign="middle">Tỷ giá: {{ $order->cny_to_vnd }}</th>
		</tr>
		<tr>
			<th colspan="12" align="center" height="25" valign="middle">Ngày: {{ date('d/m/Y') }}</th>
		</tr>
		<tr>
			<th style="background: #f5f5f5" align="center" valign="middle">Tổng tiền hàng (VNĐ)</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Ship nội địa TQ (VNĐ)</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Phí dịch vụ (VNĐ)</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Phụ phí NH (VNĐ)</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Phí vận chuyển TQ-VN</th>
			<th style="background: #f5f5f5" align="center" valign="middle">BH dễ vỡ (VNĐ)</th>
			<th style="background: #f5f5f5" align="center" valign="middle">BH hàng hóa (VNĐ)</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Kiểm hàng VNĐ</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Đóng kiện (VNĐ)</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Phí lưu kho (VNĐ)</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Tồng (VNĐ)</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Ghi chú đơn hàng</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td width="20" height="20" valign="middle" style="font-weight: normal;">{{ $order->cn_total_amount * $order->cny_to_vnd }}</td>
			<td width="20" height="20" valign="middle" style="font-weight: normal;">{{ $order->cn_shipping_fee }}</td>
			<td width="20" height="20" valign="middle" style="font-weight: normal;">{{ $order->service_fee }}</td>
			<td width="20" height="20" valign="middle" style="font-weight: normal;">{{ $order->received_fee }}</td>
			<td width="20" height="20" valign="middle" style="font-weight: normal;">{{ $order->shipping_fee }}</td>
			<td width="20" height="20" valign="middle" style="font-weight: normal;">{{ $order->add_broken_fee }}</td>
			<td width="20" height="20" valign="middle" style="font-weight: normal;">{{ $order->add_expensive_fee }}</td>
			<td width="20" height="20" valign="middle" style="font-weight: normal;">{{ $order->check_goods_fee }}</td>
			<td width="20" height="20" valign="middle" style="font-weight: normal;">{{ $order->package_fee }}</td>
			<td width="20" height="20" valign="middle" style="font-weight: normal;">{{ $order->storage_fee }}</td>
			<td width="20" height="20" valign="middle" style="font-weight: normal;">{{ $order->vn_total_amount }}</td>
			<td width="20" height="20" valign="middle" style="font-weight: normal;">{{ $order->note }}</td>
		</tr>
	</tbody>
</table>

<table style="font-size: 14px;table-layout: fixed;border-collapse: collapse;">
	<tr></tr>
	<thead>
		<tr>
			<th style="background: #f5f5f5" align="center" valign="middle">STT</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Link mua hàng</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Tên hàng</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Màu sắc</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Size</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Số lượng</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Đơn giá (RMB)</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Thành tiền (RMB)</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Ship nội địa TQ(RMB)</th>
			<th style="background: #f5f5f5" align="center" valign="middle">Ghi chú</th>
		</tr>
	</thead>
	<tbody>
		@if($items)
			<?php $i = 1;?>
			<?php $count = 0;?>
			@foreach ($items as $item)
			<?php $count += $item->quantity;?>
			<tr>
				<td valign="middle" width="20" style="font-weight: normal;" align="center" border="1">{{ $i }}</td>
				<td valign="middle" width="20" style="font-weight: normal;">{{ $item->url }}</td>
				<td valign="middle" width="20" style="font-weight: normal;">{{ $item->title }}</td>
				<td valign="middle" width="20" style="font-weight: normal;">{{ $item->color }}</td>
				<td valign="middle" width="20" style="font-weight: normal;">{{ $item->size }}</td>
				<td valign="middle" width="20" style="font-weight: normal;">{{ $item->quantity }}</td>
				<td valign="middle" width="20" style="font-weight: normal;">{{ $item->price }}</td>
				<td valign="middle" width="20" style="font-weight: normal;">{{ $item->price * $item->quantity }}</td>
				<td valign="middle" width="20" style="font-weight: normal;">{{ $item->cn_shipping_fee }}</td>
				<td valign="middle" width="20" style="font-weight: normal;">{{ $item->note }}</td>
			</tr>
			<?php $i++;?>
			@endforeach
			<tr>
				<td valign="middle" height="25" colspan="5" align="center">Tổng</td>
				<td valign="middle" height="25" height="20" style="font-weight: normal;">{{ $count }}</td>
				<td valign="middle" height="25" height="20" style="font-weight: normal;"></td>
				<td valign="middle" height="25" height="20" style="font-weight: normal;">{{ $order->cn_total_amount }}</td>
				<td valign="middle" height="25" height="20" style="font-weight: normal;">{{ $order->cn_shipping_fee }}</td>
				<td valign="middle" height="25"></td>
			</tr>
		@endif
	</tbody>
</table>