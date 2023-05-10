<table class="table no-margin">
    <tr>
        <th>Trạng thái</th>
        <th>Vận đơn</th>
        <th>Tổng trọng lượng (kg)</th>
        <th>Ghi chú</th>
    </tr>
    <tbody>
        <tr>
            <td>{!! MyHtml::displayOrderStatus($order) !!}</td>
            <?php $transport_codes = explode(',', $order->transport_codes);?>
            <td>
                <ul class="transport-code-show">
                @forelse($transport_codes as $item)
                    <li>{{ $item }}</li>
                @empty

                @endforelse
                </ul>
            </td>
            <td>{{ $order->weight }}</td>
            <td>{{ $order->note }}</td>
        </tr>
    </tbody>
</table>