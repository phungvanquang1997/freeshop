<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Sản phẩm</h3>
    </div>
    <div class="panel-body">
        <table class="table no-margin">
            <tr>
                @if ($order->type === \App\OrderShipping::TYPE_IMAGE)
                    <th width="20%" class="text-center">Ảnh</th>
                @elseif ($order->type === \App\OrderShipping::TYPE_URL)
                    <th width="40%" class="text-center">URL</th>
                @endif
                <th class="text-center">Màu</th>
                <th class="text-center">Size</th>
                <th class="text-center">Số lượng</th>
                <th class="text-center">Giá (NDT)</th>
                <th class="text-center">Vận đơn</th>
                <th class="text-center">VC nội địa (đ)</th>
                <th class="text-center"></th>
            </tr>
            <tbody>
            @foreach ($items as $item)
                <tr>
                    @if ($order->type === \App\OrderShipping::TYPE_IMAGE)
                        <td align="center" class="preview-image">
                            <a href="{{ MyHtml::showImage($item->image, 'shipping') }}"
                               target="_blank">
                                <img src="{{ App\Helpers\MyHtml::showThumb($item->image, 'shipping') }}">
                            </a>
                        </td>
                    @elseif ($order->type === \App\OrderShipping::TYPE_URL)
                        <td>
                            <a href="{{ $item->url }}"
                               target="_blank">{{ strlen($item->url) > 80 ? substr($item->url, 0, 80) . '...' : $item->url }}</a>
                        </td>
                    @endif

                    <td class="text-center view-only">
                        <span>{{ $item->color }}</span>
                    </td>
                    <td class="editable hidden">
                        <input type="text" name="{{ $item->id . 'color' }}" class="form-control"
                               value="{{ $item->color }}">
                    </td>

                    <td class="text-center view-only">
                        <span>{{ $item->size }}</span>
                    </td>
                    <td class="editable hidden">
                        <input type="text" name="{{ $item->id . 'size' }}" class="form-control"
                               value="{{ $item->size }}">
                    </td>

                    <td class="text-center view-only">
                        <span>{{ $item->quantity }}</span>
                    </td>
                    <td class="editable hidden">
                        <input type="text" name="{{ $item->id . 'quantity' }}" class="form-control"
                               value="{{ $item->quantity }}">
                    </td>

                    <td class="text-center view-only">
                        <span>{!! Currency::display($item->price, 'cn') !!}</span>
                    </td>
                    <td class="editable hidden">
                        <input type="text" name="{{ $item->id . 'price' }}" class="form-control"
                               value="{{ $item->price }}">
                    </td>

                    <td class="text-center view-only">
                        <span>{{ $item->package_id > 0 ? $item->package->code : '' }}</span>
                    </td>
                    <td class="editable hidden">
                        <input type="text" name="{{ $item->id . 'package' }}" class="form-control"
                               value="{{ $item->package_id > 0 ? $item->package->code : '' }}">
                    </td>

                    <td class="text-center view-only">
                        <span>{!! Currency::display($item->cn_shipping_fee, 'vn') !!}</span>
                    </td>
                    <td class="editable hidden">
                        <input type="text" name="{{ $item->id . 'cn_shipping_fee' }}" class="form-control"
                               value="{{ $item->cn_shipping_fee }}">
                    </td>

                    <td>
                        <div class="editable hidden">
                            <a onclick="return confirm('Are you sure?')" class="btn btn-default btn-xs font14"
                               href="{{ url('admin/order_shipping/delitem/' . $item->id) }}">
                                <i class="fa fa-times-circle"></i> Remove
                            </a>
                        </div>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

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
                        <option {{ $order->add_expensive_fee_percent == 0 ? 'selected="selected"' : '' }} value="0">0</option>
                        <option {{ $order->add_expensive_fee_percent == 5 ? 'selected="selected"' : '' }} value="5">5%</option>
                    </select>
                </td>

                <td class="view-only">{!! Currency::display($order->add_broken_fee) !!}
                </td>
                <td class="editable hidden">
                    <select name="add_broken" class="form-control">
                        <option {{ $order->add_broken_fee_percent == 0 ? 'selected="selected"' : '' }} value="0">0</option>
                        <option {{ $order->add_broken_fee_percent == 3 ? 'selected="selected"' : '' }} value="3">3%</option>
                        <option {{ $order->add_broken_fee_percent == 5 ? 'selected="selected"' : '' }} value="5">5%</option>
                    </select>
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

                <td>{!! Currency::display($order->cn_shipping_fee) !!}</td>
                <td class="view-only">{!! Currency::display($order->shipping_fee) !!}</td>
                <td class="editable hidden">
                    <input type="text" name="shipping_fee" class="form-control"
                           value="{{ $order->shipping_fee }}"/>
                </td>

                <td class="">{!! Currency::display($order->bonus_used) !!}</td>

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