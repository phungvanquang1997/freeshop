@if ($order != null)
<table border="1">
	<tr>
	<td colspan="3">Lịch trình đơn hàng: {{ $order->order_code }}</td></tr>
	<thead>
		<tr>
			<th align="center" height="30">STT</th>
			<th align="center" height="30">Trạng thái</th>
			<th align="center" height="30">Ngày giờ</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>1</td>
			<td>Đơn mới tạo</td>
			<td>
			@if ($order->updated_init_st != null)
				{{ date('d/m/Y', strtotime($order->updated_init_st)) }}
			@endif
			</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Đơn chờ xử lý</td>
			<td>
			@if ($order->updated_pending_st != null)
				{{ date('d/m/Y', strtotime($order->updated_pending_st)) }}
			@endif
			</td>
		</tr>
		<tr>
			<td>3</td>
			<td>Đơn đã báo giá</td>
			<td>
			@if ($order->updated_quocted_st != null)
				{{ date('d/m/Y', strtotime($order->updated_quocted_st)) }}
			@endif
			</td>
		</tr>
		<tr>
			<td>4</td>
			<td>Đơn đã đặt cọc</td>
			<td>
			@if ($order->updated_deposit_st != null)
				{{ date('d/m/Y', strtotime($order->updated_deposit_st)) }}
			@endif
			</td>
		</tr>
		<tr>
			<td>5</td>
			<td>Đơn đang mua hàng</td>
			<td>
			@if ($order->updated_process_st != null)
				{{ date('d/m/Y', strtotime($order->updated_process_st)) }}
			@endif
			</td>
		</tr>
		<tr>
			<td>6</td>
			<td>Đơn đã mua hàng xong</td>
			<td>
			@if ($order->updated_bought_st != null)
				{{ date('d/m/Y', strtotime($order->updated_bought_st)) }}
			@endif
			</td>
		</tr>
		<tr>
			<td>7</td>
			<td>Đơn đã phát hàng</td>
			<td>
			@if ($order->updated_release_st != null)
				{{ date('d/m/Y', strtotime($order->updated_release_st)) }}
			@endif
			</td>
		</tr>
		<tr>
			<td>8</td>
			<td>Đơn vận chuyển nội địa Trung Quốc</td>
			<td>
			@if ($order->updated_shipping_cn_st != null)
				{{ date('d/m/Y', strtotime($order->updated_shipping_cn_st)) }}
			@endif
			</td>
		</tr>
		<tr>
			<td>9</td>
			<td>Đơn về kho Trung Quốc</td>
			<td>
			@if ($order->updated_storage_cn_st != null)
				{{ date('d/m/Y', strtotime($order->updated_storage_cn_st)) }}
			@endif
			</td>
		</tr>
		<tr>
			<td>10</td>
			<td>Đơn đang vận chuyển về Việt Nam</td>
			<td>
			@if ($order->updated_shipping_st != null)
				{{ date('d/m/Y', strtotime($order->updated_shipping_st)) }}
			@endif
			</td>
		</tr>
		<tr>
			<td>11</td>
			<td>Đơn về tới kho Việt Nam</td>
			<td>
			@if ($order->updated_storage_vn_st != null)
				{{ date('d/m/Y', strtotime($order->updated_storage_vn_st)) }}
			@endif
			</td>
		</tr>
		<tr>
			<td>12</td>
			<td>Đơn vận chuyển nội địa Việt Nam</td>
			<td>
			@if ($order->updated_shipping_vn_st != null)
				{{ date('d/m/Y', strtotime($order->updated_shipping_vn_st)) }}
			@endif
			</td>
		</tr>
		<tr>
			<td>13</td>
			<td>Đơn khiếu nại</td>
			<td>
			@if ($order->updated_complain_st != null)
				{{ date('d/m/Y', strtotime($order->updated_complain_st)) }}
			@endif
			</td>
		</tr>
		<tr>
			<td>14</td>
			<td>Đơn lưu kho</td>
			<td>
			@if ($order->updated_storage_fee_st != null)
				{{ date('d/m/Y', strtotime($order->updated_storage_fee_st)) }}
			@endif
			</td>
		</tr>
		<tr>
			<td>15</td>
			<td>Đơn thành công</td>
			<td>
			@if ($order->updated_success_st != null)
				{{ date('d/m/Y', strtotime($order->updated_success_st)) }}
			@endif
			</td>
		</tr>
		<tr>
			<td>16</td>
			<td>Đơn hủy bỏ</td>
			<td>
			@if ($order->updated_inactive_st != null)
				{{ date('d/m/Y', strtotime($order->updated_inactive_st)) }}
			@endif
			</td>
		</tr>

	</tbody>
</table>
@else 
Đơn hàng không tồn tại
@endif