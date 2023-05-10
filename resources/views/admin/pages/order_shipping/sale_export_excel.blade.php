<table style="font-size: 14px;table-layout: fixed;border-collapse: collapse;">
	<tr></tr>
	<thead>
		<tr>
			<th colspan="9" align="center" height="25" valign="middle">TỔNG HỢP DOANH SỐ GIAO DỊCH VIÊN</th>
		</tr>
		<tr>
			<th colspan="9" align="center" height="25" valign="middle">Tên giao dịch viên: {{ $user->name }}</th>
		</tr>
		<tr>
			<th style="background: #f5f5f5;border: 1px solid #000000;" align="center" valign="middle">STT</th>
			<th style="background: #f5f5f5;border: 1px solid #000000;" align="center" valign="middle">Ngày</th>
			<th style="background: #f5f5f5;border: 1px solid #000000;" align="center" valign="middle">Mã đơn hàng</th>
			<th style="background: #f5f5f5;border: 1px solid #000000;" align="center" valign="middle">Mã giao dịch</th>
			<th style="background: #f5f5f5;border: 1px solid #000000;" align="center" valign="middle">Giá WEB</th>
			<th style="background: #f5f5f5;border: 1px solid #000000;" align="center" valign="middle">Giá thực tế</th>
			<th style="background: #f5f5f5;border: 1px solid #000000;" align="center" valign="middle">Ship WEB</th>
			<th style="background: #f5f5f5;border: 1px solid #000000;" align="center" valign="middle">Ship thực tế</th>
			<th style="background: #f5f5f5;border: 1px solid #000000;" align="center" valign="middle">Ghi chú</th>
		</tr>
	</thead>
	<tbody>
		@if($items)
			<?php $i = 1;?>
			<?php $count = 0;?>
			@foreach ($items as $item)
			<?php $count += $item->quantity;?>
			<tr>
				<td valign="middle" width="20" style="font-weight: normal;border: 1px solid #000000;" align="center" border="1">{{ $i }}</td>
				<td valign="middle" width="20" style="font-weight: normal;border: 1px solid #000000;">{{date('d/m/Y', strtotime($item->updated_at))}}</td>
				<td align="center" valign="middle" width="20" style="font-weight: normal;border: 1px solid #000000;">{{ $orderCode[$item->order_id] }}</td>
				<td valign="middle" width="20" style="font-weight: normal;border: 1px solid #000000;">{{ $item->purchase_codes }}</td>
				<td valign="middle" width="20" style="font-weight: normal;border: 1px solid #000000;">{{ $item->quantity * $item->price}}</td>
				<td valign="middle" width="20" style="font-weight: normal;border: 1px solid #000000;">{{ $item->cn_the_total_amount}}</td>
				<td valign="middle" width="20" style="font-weight: normal;border: 1px solid #000000;">{{ $item->cn_shipping_fee }}</td>
				<td valign="middle" width="20" style="font-weight: normal;border: 1px solid #000000;">{{ $item->cn_the_shipping_fee }}</td>
				<td valign="middle" width="20" style="font-weight: normal;border: 1px solid #000000;">{{ $item->note }}</td>
			</tr>
			<?php $i++;?>
			@endforeach
		@endif
	</tbody>
</table>