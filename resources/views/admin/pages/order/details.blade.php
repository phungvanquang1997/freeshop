<!-- Modal Order Details-->
<div class="modal fade order-details" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
            {!! Form::open(['method' => 'PUT', 'url' => 'admin/order/' . $order->id]) !!}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Đơn hàng: #{{ $order->id }}</h4>
                </div>
                <div class="modal-body">
                    <a href="javascript:void(0);" id="edit-order" class="btn btn-xs btn-info font14">
                        <i class="fa fa-pencil"></i> Edit</a>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Thông tin khách hàng</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                    <th>{{ trans('lang.Name') }}</th>
                                    <th>{{ trans('lang.Phone') }}</th>
                                    <th>{{ trans('lang.Email') }}</th>
                                    <th>{{ trans('lang.Address') }}</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="view-only">{{ $order->name }}</td>
                                        <td class="editable hidden">
                                            <input type="text" name="name" class="form-control" value="{{ $order->name }}" placeholder="Name" required>
                                        </td>
                                        <td class="view-only">{{ $order->phone }}</td>
                                        <td class="editable hidden">
                                            <input type="text" name="phone" class="form-control" value="{{ $order->phone }}" placeholder="Phone" required>
                                        </td>
                                        <td class="view-only">{{ $order->email }}
                                        <td class="editable hidden">
                                            <input type="email" name="email" class="form-control" value="{{ $order->email }}" placeholder="Email" required>
                                        </td>
                                        <td class="view-only">{{ App\Order::fullAddress($order)}}</td>
                                        <td class="editable hidden">
                                            <input type="text" name="address" class="form-control" value="{{ $order->address }}" placeholder="Address" required>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if (trim($order->note) != '')
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Ghi chú</h3>
                            </div>
                            <div class="panel-body">
                                <p class="view-only">{{ $order->note }}</p>
                                <textarea type="text" name="note" class="form-control editable hidden">
                                    {{ $order->note }}
                                </textarea>
                            </div>
                        </div>
                    @endif

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Sản phẩm</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <th class="text-center">{{ trans('lang.SKU') }}</th>
                                <th class="text-center">{{ trans('lang.Product name') }}</th>
                                <th class="text-center">{{ trans('lang.Image') }}</th>
                                <th class="text-center">{{ trans('lang.Quantity') }}</th>
                                <th class="text-center">{{ trans('lang.Price') }}</th>
                                </thead>
                                <tbody>
                                @foreach ($items as $item)
                                    <?php $product = \App\Product::find($item->product_id) ?>
                                    <tr>
                                        <td class="text-center">{{ $product->sku  }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('/' . $product->id .'-'. $product->slug) }}" title="{{ $product->name }}" target="_blank">
                                                {{ $product->name  }}
                                            </a>
                                            @if ($item->color)
                                            <p>Màu sắc: {{$item->color}}</p>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if (file_exists(\App\Helpers\ImageManager::getThumb($product->mainImage()->image, 'product', 'small')))
                                                <a href="{{ url('/' . $product->id .'-'. $product->slug) }}" title="{{ $product->name }}" target="_blank">
                                                    <img src="{{ asset(\App\Helpers\ImageManager::getThumb($product->mainImage()->image, 'product', 'small') ) }}" alt="{{ $product->name }}"/>
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-center">{!! Currency::display($item->price) !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Thông tin khác</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                    <th width="33%">Phí vận chuyển</th>
                                    <th width="33%">Chiết khấu/ Khuyến mại</th>
                                    <th width="33%">Trạng thái</th>
                                    <th width="34%">Thời gian</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="view-only">{!! Currency::display($order->shipping_cost) !!}</td>
                                        
                                        <td class="editable hidden">
                                            <input type="text" name="shipping_cost" class="form-control"
                                                   value="{{ $order->shipping_cost }}" placeholder="Phí vận chuyển">
                                        </td>
                                        <td class="">
                                            {!! Currency::display($order->discount) !!}<br/>
                                            {{ isset($voucher) ? 'Mã: ' . $voucher : ''}}
                                        </td>
                                        <td class="view-only">{{ $order->status() }}</td>
                                        <td class="editable hidden">
                                            <?php $status = App\Order::allStatus() ?>
                                            <select class="form-control" name="status">
                                                @foreach ($status as $value => $label)
                                                    <option value="{{ $value }}" @if ($order->status == $value) selected @endif>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>{{ date('d/m/Y H:i', strtotime($order->created_at)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <?php $gross = ($order->total_amount + $order->shipping_cost - $order->discount) > 0 ? $order->total_amount + $order->shipping_cost - $order->discount : 0;?>
                    <span class="detail-total">{{ trans('lang.Total') }}: {!! Currency::displayBold($gross) !!}</span>
                    <button type="submit" class="btn btn-primary center-block editable hidden">Cập nhật</button>
                    <button type="button" class="btn btn-default close-modal-order view-only" data-dismiss="modal">{{ trans('lang.Close') }}</button>
                </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.close-modal-order').on('click', function() {
            $('#order-details').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        });

        $('#edit-order').on('click', function(e) {
            e.preventDefault();
            $('.view-only').addClass('hidden');
            $('.editable').removeClass('hidden');
        });
    });
</script>
