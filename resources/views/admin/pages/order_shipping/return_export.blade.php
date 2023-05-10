<table style="font-size: 14px;table-layout: fixed;border-collapse: collapse;">
	<tr></tr>
	<thead>
		<tr>
			<th colspan="6" align="center" height="25" valign="middle">TIỀN TRẢ LẠI</th>
		</tr>
		<tr>
			<th style="background: #f5f5f5;border: 1px solid #000000;" align="center" valign="middle">STT</th>			
			<th style="background: #f5f5f5;border: 1px solid #000000;" align="center" valign="middle">Mã đơn hàng</th>
			<th style="background: #f5f5f5;border: 1px solid #000000;" align="center" valign="middle">Mã giao dịch</th>
			<th style="background: #f5f5f5;border: 1px solid #000000;" align="center" valign="middle">Tiền được trả lại (RMB)</th>
			<th style="background: #f5f5f5;border: 1px solid #000000;" align="center" valign="middle">Quy đổi VNĐ</th>
			<th style="background: #f5f5f5;border: 1px solid #000000;" align="center" valign="middle">Ngày khiếu nại</th>
		</tr>
	</thead>
	<tbody>
		@if($items)
			<?php $i = 1;?>
			@foreach ($items as $item)
			<tr>
				<td valign="middle" width="20" style="font-weight: normal;border: 1px solid #000000;" align="center" border="1">{{ $i }}</td>
				<td align="center" valign="middle" width="20" style="font-weight: normal;border: 1px solid #000000;">{{$item->order_code}}</td>
				<td valign="middle" width="20" style="font-weight: normal;border: 1px solid #000000;">{{$item->purchase_codes}}</td>
				<td valign="middle" width="20" style="font-weight: normal;border: 1px solid #000000;">{{$item->damage}}</td>
				<td valign="middle" width="20" style="font-weight: normal;border: 1px solid #000000;">{{$item->vnd}}</td>
				<td valign="middle" align="right" width="20" style="font-weight: normal;border: 1px solid #000000;">{{date('d/m/Y', strtotime($item->created_at))}}</td>
			</tr>
			<?php $i++;?>
			@endforeach
		@endif
	</tbody>
</table>