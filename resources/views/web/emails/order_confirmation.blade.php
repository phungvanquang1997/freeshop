
<p>Xin chào {{ $name }},</p>
<p>Áo giá sỉ gửi bạn báo giá đơn hàng {{ $orderCode }} bạn đặt trên website <?php echo $_SERVER['SERVER_NAME'];?> như sau:</p>

<table style="border: 1px solid #666; border-collapse: collapse;width: 100%">
	<thead>
		<tr>
			<th style="border: 1px solid #666; border-collapse: collapse; text-align:center;height:32px;padding:5px; vertical-align: middle;">Tổng tiền hàng</th>
			<th style="border: 1px solid #666; border-collapse: collapse; text-align:center;height:32px;padding:5px; vertical-align: middle;">Phí gửi hàng</th>
			<th style="border: 1px solid #666; border-collapse: collapse; text-align:center;height:32px;padding:5px; vertical-align: middle;">Chiết khấu</th>
			<th style="border: 1px solid #666; border-collapse: collapse; text-align:center;height:32px;padding:5px; vertical-align: middle;">Phải thanh toán</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style="border: 1px solid #666; border-collapse: collapse;text-align: right;height: 30px;padding:5px">{!! Currency::displayBold($total_amount) !!}</td>
			<td style="border: 1px solid #666; border-collapse: collapse;text-align: right;height: 30px;padding:5px">{!! Currency::displayBold($shipping_cost) !!}</td>
			<td style="border: 1px solid #666; border-collapse: collapse;text-align: right;height: 30px;padding:5px">{!! Currency::displayBold($discount) !!}</td>
			<td style="border: 1px solid #666; border-collapse: collapse;text-align: right;height: 30px;padding:5px">{!! Currency::displayBold($gross) !!}</td>
		</tr>
	</tbody>
</table>

<p>Quý khách vui lòng đăng nhập hệ thống aogiasi.com để xem chi tiết</p>
<p>Trân trọng!</p>

<p>Quý khách vui lòng không trả lời thư này.</p>