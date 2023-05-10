
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Các loại phí</h3>
    </div>
    <div class="panel-body">
        <table class="table no-margin">
            <tr>
                <th width="16%">Tổng</th>
                <th width="16%">Phí DV</th>
                <th width="16%">Phí NH</th>
                <th width="16%">BH hàng hóa</th>
                <th width="16%">BH dễ vỡ</th>
                <th width="16%">Vận đơn</th>
                <th width="">Cân nặng(kg)</th>
            </tr>
            <tbody>
            <tr>

                <td class="">{!! Currency::display($order->cn_total_amount, 'cn') !!}</td>

                <td class="view-only">{!! Currency::display($order->service_fee) !!}</td>
                <td class="editable hidden">
                    <input type="text" name="service_fee" class="form-control"
                           value="{{ $order->service_fee }}">
                </td>

                <td class="view-only">{!! Currency::display($order->received_fee) !!}</td>
                <td class="editable hidden">
                    <input type="text" name="received_fee" class="form-control"
                           value="{{ $order->received_fee }}">
                </td>

                <td class="view-only">{!! Currency::display($order->add_expensive_fee)!!}
                </td>
                <td class="editable hidden">
                    <select name="add_expensive" class="form-control">
                        <option value="0">0</option>
                        <option value="5">5%</option>
                    </select>
                </td>

                <td class="view-only">{!! Currency::display($order->add_broken_fee) !!}
                </td>
                <td class="editable hidden">
                    <select name="add_broken" class="form-control">
                        <option value="0">0</option>
                        <option value="3">3%</option>
                        <option value="5">5%</option>
                    </select>
                </td>

                <td class="view-only">{{ $order->transport_codes }}</td>
                <td class="editable hidden">
                    <input type="text" name="transport_codes" class="form-control"
                           value="{{ $order->transport_codes }}"/>
                </td>

                <td class="view-only">{{ $order->weight }}</td>
                <td class="editable hidden">
                    <input type="text" name="weight" class="form-control" value="{{ $order->weight }}"/>
                </td>

            </tr>
            </tbody>
        </table>

        <table class="table no-margin">
            <tr>
                <th width="16%">VC nội địa</th>
                <th width="16%">VC TQ-VN</th>
                <th width="16%">Tiền thưởng</th>
                <th width="16%">Tổng</th>
                <th width="16%">Đặt cọc</th>
                <th width="">Còn lại</th>
            </tr>
            <tbody>
            <tr>

                <td class="view-only">{!! Currency::display($order->cn_shipping_fee) !!}</td>
                <td class="editable hidden">
                    <input type="text" name="cn_shipping_fee" class="form-control"
                           value="{{ $order->cn_shipping_fee }}"/>
                </td>

                <td class="">{!! Currency::display($order->bonus_used) !!}</td>

                <td class="">{!! Currency::display($order->deposit) !!}

                <td>{!! Currency::display($order->vn_total_amount) !!}</td>

                <td class="view-only">{!! Currency::display($order->deposit) !!}
                </td>
                <td class="editable hidden">
                    <input type="text" name="deposit" class="form-control"
                           value="{{ $order->deposit }}">
                </td>

                <td>
                    <span class="red">{!! Currency::display($order->vn_total_amount - $order->deposit) !!}</span>
                </td>

            </tr>
            </tbody>
        </table>
    </div>
</div>