<div class="panel panel-default">
    <div class="panel-body">
        
        <!-- Form Open -->
            <table id="data-table" class="table table-product-items">
                <thead>
                    <tr>
                        <td width="2">{{trans('lang.num_oder')}}</td>
                        <td width="20">{{trans('lang.image')}}</td>
                        <td width="8">{{trans('lang.quantity')}}</td>
                        <td width="10">{{trans('lang.unit_price')}} ({!! Currency::signals('cn') !!})</td>
                        <td width="10">{{trans('lang.subtotal')}} ({!! Currency::signals('cn') !!})</td>
                        <td width="10">{{trans('lang.ship_nd')}}</td>
                        <td width="20">{{trans('lang.note')}}</td>
                        <td width="8"></td>
                    </tr>
                </thead>
                <tbody class="product-container">
                    <?php
                    $total_price = 0;
                    $i = 1;
                    $count = 0;
                    ?>
                    
                    @forelse ($items as $item)
                        <?php $count += $item->quantity; ?>

                        <form method="POST" action="/admin/order_shipping/update-item/{{$item->id}}" enctype="multipart/form-data">
                            @method('PUT')
                            <tr class="order-item-{{ $item->id }}">
                            
                            <td class="td-stt" rowspan="3"> <span>{{ $i }}</span></td>
                            <td class="td-image" rowspan="3">
                                <div class="img-b">
                                    @if (!empty($item->image))
                                    <a href="{{$item->image}}" title="Bấm xem ảnh lớn" target="_blank" data-toggle="tooltip">
                                    <img src="{{ $item->image . '_150x150.jpg' }}">
                                    </a>
                                    @endif
                                </div>
                                <ul>

                                    <li>
                                        <div class="item-view"> 
                                        @if($item->title != 'NoName' && $item->title != '')
                                        {{ $item->title }}
                                        @endif
                                        </div>
                                        <div class="item-editable hidden">
                                            <input type="text" class="form-control td-text order_title_input" placeholder="Tên sản phẩm" data-id="{{ $item->id }}" name="items[{{ $item->id }}][title]" value="{{ ($item->title != 'NoName' && $item->title != '') ? $item->title : null }}">
                                        </div>
                                        
                                    </li>
                                    <li>{{ $item->color }}</li>
                                    <li><a href="{{ $item->url }}" target="_blank" title="{{trans('lang.link_goc')}}">{{trans('lang.link_goc')}}</a></li>
                                </ul>
                            </td>
                            <td class="td-quantity">
                                <div class="item-view">
                                <strong>{{ $item->quantity }}</strong>
                                </div>
                                <div class="item-editable hidden">
                                    <input type="number" name="items[{{ $item->id }}][quantity]" value="{{ $item->quantity }}" class="form-control td-text order_quantity_input" data-id="{{ $item->id }}">
                                </div>
                            </td>
                            <td class="td-price">
                                <div class="item-view">
                                {!! Currency::displayBold($item->price, 'cn') !!}
                                </div>
                                <div class="item-editable hidden">

                                    <input type="number" class="form-control td-text order_price_input" name="items[{{ $item->id }}][price]" value="{{ $item->price }}" data-id="{{ $item->id }}">
                                </div>
                            </td>
                            
                            <td class="td-total-price label-total-price">{!! Currency::displayBold($item->quantity * $item->price, 'cn') !!}</td>

                            <td class="td-cn-shipping-fee">
                                <div class="item-view">
                                {!! Currency::displayBold($item->cn_shipping_fee, 'cn') !!}
                                
                                </div>
                                <div class="item-editable hidden">
                                    <input type="number" name="items[{{ $item->id }}][cn_shipping_fee]" value="{{ $item->cn_shipping_fee }}" class="form-control td-text cn_shipping_fee_input" data-id="{{ $item->id }}">
                                </div>
                            </td>

                            <td class="td-note" rowspan="2">
                                <div class="item-view">{{ $item->note }}</div>
                                <div class="item-editable hidden">
                                    <textarea name="items[{{ $item->id }}][note]" rows="2" class="td-textarea form-control order_note_input" data-id="{{ $item->id }}">{{ $item->note }}</textarea>
                                </div>
                            </td>
                            
                            <td class="td-action" rowspan="2">
                                @if (Auth::user()->group == \App\User::IS_ADMINISTRATOR || (Auth::user()->group == \App\User::IS_TELLER && in_array($order->status, \App\OrderShipping::$statusTellerAble)) || (Auth::user()->group == \App\User::IS_STOREKEEPER && in_array($order->status, \App\OrderShipping::$statusStorekeeperAble)) )
                                <a class="btn-edit-item" href="" data-toggle="tooltip" title="{{trans('lang.edit')}}" data-id="{{ $item->id }}"><i class="fa fa-edit"></i></a>

                                    <button type="submit" class="btn btn-primary btn-save-item hidden">{{ trans('lang.save') }}</button>
                                <a class="btn-remove-product item-view" data-toggle="tooltip" title="{{trans('lang.del')}}" href="{{ url('/admin/order_shipping/delitem/' . $item->id) }}" onclick="return del_product_confirm()"><i class="glyphicon glyphicon-remove"></i></a>
                               @endif
                            </td>
                        </tr>
                        
                        <tr class="order-item-{{ $item->id }}">
                            <th class="text-center">{{trans('lang.cn_ship_fee_real')}}:</th>
                            <td class="td-purchase-codes">
                                <div class="item-view">
                                {!! Currency::displayBold($item->cn_the_shipping_fee, 'cn') !!}
                                </div>
                                <div class="item-editable hidden">
                                    <input type="text" name="items[{{$item->id}}][cn_the_shipping_fee]" value="{{$item->cn_the_shipping_fee}}" class="form-control td-text order_cn_the_shipping_fee_input" data-id="{{$item->id}}">
                                </div>
                            </td>
                            <th class="text-center">{{trans('lang.pay_real')}}:</th>
                            <td class="td-purchase-codes">
                                <div class="item-view">
                                {!! Currency::displayBold($item->cn_the_total_amount, 'cn') !!}
                                </div>
                                <div class="item-editable hidden">
                                    <input type="text" name="items[{{ $item->id }}][cn_the_total_amount]" value="{{ $item->cn_the_total_amount }}" class="form-control td-text order_cn_the_total_amount_input" data-id="{{ $item->id }}">
                                </div>
                            </td>
                        </tr>

                        <tr class="order-item-{{ $item->id }}">
                            <th class="text-center">{{trans('lang.purchase_code')}}:</th>
                            <td class="td-purchase-codes">
                                <div class="item-view">
                                {{ $item->purchase_codes }}
                                </div>
                                <div class="item-editable hidden">
                                    <input type="text" name="items[{{$item->id}}][purchase_codes]" value="{{$item->purchase_codes}}" class="form-control td-text order_purchase_codes_input" data-id="{{$item->id}}">
                                </div>
                            </td>
                            <th class="text-center">{{trans('lang.mavandon')}}:</th>
                            <td class="td-purchase-codes">
                                <div class="item-view">
                                {{ $item->transport_code }}
                                </div>
                                <div class="item-editable hidden">
                                    <input type="text" name="items[{{ $item->id }}][transport_code]" value="{{ $item->transport_code }}" class="form-control td-text order_transport_code_input" data-id="{{ $item->id }}" title="Nếu có nhiều hơn 1 mã vận đơn, các mã VĐ viết ngăn cách nhau bởi dấu ';'">
                                </div>
                            </td>
                        </tr>                        
                        </form>
                        <?php $i++; ?>
                    @empty
                        <tr><td colspan="7">
                        Không có sản phẩm
                        </td></tr>
                    @endforelse
                   
                </tbody>
                <tfoot>
                <form method="POST" action="/admin/order_shipping/{{$order->id}}">
                    @method('PUT')
                    @csrf                    <tr>
                        <td colspan="8" class="no-padding">
                            <div class="order-express-info">
                                <h2 class="heading">{{trans('lang.order_info')}}</h2>
                                <div class="row">
                                    
                                    <div class="col-sm-8">
                                        <div class="form-group order-attr-box">
                                            <label for="attr-1" class="label-standard @if($order->order_attr == App\OrderShipping::ORDER_STANDARD) active @endif">
                                            <input type="radio" value="{{ App\OrderShipping::ORDER_STANDARD }}" name="order_attr" id="attr-1" disabled @if($order->order_attr == App\OrderShipping::ORDER_STANDARD) checked @endif>
                                            {{trans('lang.order_standard')}}</label>
                                            <label for="attr-2" class="label-vip @if($order->order_attr == App\OrderShipping::ORDER_VIP) active @endif">
                                            <input type="radio" value="{{ App\OrderShipping::ORDER_VIP }}" name="order_attr" id="attr-2" disabled @if($order->order_attr == App\OrderShipping::ORDER_VIP) checked @endif>
                                            {{trans('lang.order_vip')}}</label>
                                        </div>
                                        <div class="post-link-box">
                                            <a href="{{ url('/blog/tin-cong-ty/don-hang-tieu-chuan') }}" target="_blank">- {{trans('lang.timhieu_donhang_tieuchuan')}}</a>
                                            <a href="{{ url('/blog/tin-cong-ty/don-hang-vip') }}" target="_blank">- {{trans('lang.timhieu_donhang_vip')}}</a>
                                        </div>
                                         <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group underline-group">
                                                    <label class="col-md-8 col-sm-6">{{trans('lang.tong_tien_hang')}}</label>
                                                    <label class="label-content total_price_cny">{!! Currency::displayBold($order->cn_total_amount, 'cn') !!}</label>
                                                </div>
                                                <div class="form-group underline-group">
                                                    <label class="col-md-8 col-sm-6">{{trans('lang.ty_gia')}}</label>
                                                    <label class="label-content">1 {!! Currency::signals('cn') !!} = {{ $cny_to_vnd }} {!! Currency::signals('vn') !!}</label>
                                                </div>
                                                <div class="form-group underline-group">
                                                    <label class="col-md-8 col-sm-6">{{trans('lang.tien_hang')}} (VNĐ)</label>
                                                    <label class="label-content total_price_vnd">{!! Currency::displayBold($order->cn_total_amount * $cny_to_vnd , 'vn') !!}</label>
                                                </div>
                                                <div class="form-group underline-group">
                                                    <label class="col-md-8 col-sm-6"><a href="{{ url('/blog/tin-cong-ty/bang-gia-dich-vu-nhan-hang') }}" title="Xem bảng giá dịch vụ & nhận hàng" target="_blank">{{trans('lang.phi_dichvu')}} <i class="fa fa-link fa-active" aria-hidden="true"></i></a></label>
                                                    <label class="label-content service_fee">{!! Currency::displayBold(isset($order->service_fee) ? $order->service_fee : 0, 'vn') !!}</label>
                                                    
                                                </div>
                                                <div class="form-group underline-group">
                                                    <label class="col-md-8 col-sm-6"><a href="{{ url('/blog/tin-cong-ty/bang-gia-dich-vu-nhan-hang') }}" title="Xem bảng giá dịch vụ & nhận hàng" target="_blank">{{trans('lang.phi_nhanhang')}} <i class="fa fa-link fa-active" aria-hidden="true"></i></a></label>
                                                     <label class="label-content received_fee">{!! Currency::displayBold(isset($order->received_fee) ? $order->received_fee : 0, 'vn') !!}</label>
                                                   
                                                </div>
                                                <div class="form-group underline-group">
                                                    <label class="col-md-8 col-sm-6">{{trans('lang.can_nang')}} (Kg)</label>
                                                    <label class="label-content weight"><strong>{{ $order->weight }}</strong> Kg</label>
                                                    <input type="number" name="weight" value="{{ $order->weight }}" class="form-control td-text weight_input">
                                                </div>
                                                <div class="form-group underline-group">
                                                    <label class="col-md-8 col-sm-6">{{trans('lang.ship_nd_tq')}}</label>
                                                    <label class="label-content cn_shipping_fee">{!! Currency::displayBold(isset($order->cn_shipping_fee) ? $order->cn_shipping_fee : 0, 'cn') !!}</label>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                
                                                <div class="form-group underline-group">
                                                    <label class="col-md-8 col-sm-6">{{trans('lang.ship_tq_vn')}}</label>
                                                    <label class="label-content shipping_fee">{!! Currency::displayBold(isset($order->shipping_fee) ? $order->shipping_fee : 0, 'vn') !!}</label>
                                                    
                                                </div>
                                                <div class="form-group underline-group">
                                                    <label class="col-md-8 col-sm-6">{{trans('lang.ship_nd_vn')}}</label>
                                                    <label class="label-content vn_shipping_fee order-view-only">{!! Currency::displayBold(isset($order->vn_shipping_fee) ? $order->vn_shipping_fee : 0, 'vn') !!}</label>
                                                    <div class="order-editable hidden">
                                                        <input type="number" name="vn_shipping_fee" value="{{$order->vn_shipping_fee}}" class="form-control td-text vn_shipping_fee_input">

                                                    </div>
                                                </div>

                                                <div class="form-group underline-group">
                                                    <label class="col-md-8 col-sm-6"><a href="{{ url('/blog/tin-cong-ty/bang-gia-bao-hiem-hang-hoa') }}" title="Xem bảng giá bảo hiểm" target="_blank">{{trans('lang.baohiemhang_devo')}}<i class="fa fa-link fa-active" aria-hidden="true"></i></a></label>
                                                     <label class="label-content add_broken_fee">{!! Currency::displayBold(isset($order->add_broken_fee) ? $order->add_broken_fee : 0, 'vn') !!}</label>
                                                    <input type="checkbox" class="js-switch_1 add_broken_fee_checkbox" value="1" name="" @if($order->add_broken_fee > 0) checked @endif disabled />
                                                    <!--
                                                    <div class="broken-options order-editable hidden">
                                                        <label class="label-standard active">
                                                        <input type="radio" value="5" name="add_broken_fee_percent" @if($order->add_broken_fee_percent == 5) checked @endif>
                                                        5%</label>
                                                        <label class="label-vip">
                                                        <input type="radio" value="10" name="add_broken_fee_percent" @if($order->add_broken_fee_percent == 10) checked @endif>
                                                        10%</label>
                                                     </div>
                                                     -->
                                                </div>
                                                <div class="form-group underline-group">
                                                    <label class="col-md-8 col-sm-6"><a href="{{ url('/blog/tin-cong-ty/bang-gia-bao-hiem-hang-hoa') }}" title="Xem bảng giá bảo hiểm" target="_blank">{{trans('lang.baohiemhanghoa')}} <i class="fa fa-link fa-active" aria-hidden="true"></i></a></label>
                                                    <label class="label-content add_expensive_fee">{!! Currency::displayBold(isset($order->add_expensive_fee) ? $order->add_expensive_fee : 0, 'vn') !!}</label>
                                                    <input type="checkbox" class="js-switch_2 add_expensive_fee_checkbox" value="1" name="" @if($order->add_expensive_fee > 0) checked @endif disabled />
                                                    <input type="number" name="add_expensive_fee" value="{{ $order->add_expensive_fee }}" class="form-control td-text add_expensive_fee_input">

                                                </div>
                                                <div class="form-group underline-group">
                                                    <label class="col-md-8 col-sm-6"><a href="{{ url('/blog/tin-cong-ty/bang-gia-dong-kien-kiem-dem') }}" title="Xem bảng giá đóng kiện" target="_blank">{{trans('lang.dong_kien')}} <i class="fa fa-link fa-active" aria-hidden="true"></i></a></label>
                                                    <label class="label-content package_fee order-view-only">{!! Currency::displayBold(isset($order->package_fee) ? $order->package_fee : 0, 'vn') !!}</label>
                                                    <input type="checkbox" class="js-switch_3 package_fee_checkbox" value="1" name="" @if($order->is_package_fee == 1) checked @endif disabled />
                                                    <div class="order-editable hidden">
                                                        <input type="number" name="package_fee" value="{{ $order->package_fee }}" class="form-control td-text package_fee_input">
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-group underline-group">
                                                    <label class="col-md-8 col-sm-6"><a href="{{ url('/blog/tin-cong-ty/bang-gia-dong-kien-kiem-dem') }}" title="Xem bảng giá kiểm đếm" target="_blank">{{trans('lang.kiem_dem')}} <i class="fa fa-link fa-active" aria-hidden="true"></i></a></label>
                                                    <label class="label-content check_goods_fee">{!! Currency::displayBold(isset($order->check_goods_fee) ? $order->check_goods_fee : 0, 'vn') !!}</label>
                                                    <input type="checkbox" class="js-switch_4 check_goods_fee_checkbox" value="1" name="" @if($order->is_check_goods_fee == 1) checked @endif disabled />

                                                    <input type="number" name="check_goods_fee" value="{{ $order->check_goods_fee }}" class="form-control td-text check_goods_fee_input">
                                                </div>
                                                <div class="form-group underline-group">
                                                    <label class="col-md-8 col-sm-6">{{trans('lang.phi_luu_kho')}}</label>
                                                    <label class="label-content storage_fee order-view-only">{!! Currency::displayBold(isset($order->storage_fee) ? $order->storage_fee : 0, 'vn') !!}</label>
                                                    
                                                    <div class="order-editable hidden">
                                                        <input type="number" name="storage_fee" value="{{ $order->storage_fee }}" class="form-control td-text storage_fee_input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4"> 
                                        <div class="form-group warehouse-box">
                                            <label class="warehouse-label">{{trans('lang.hang_ve')}}: </label>
                                            <label for="warehouse-1" class="label-standard active">
                                            <input type="radio" value="{{ App\OrderShipping::WAREHOUSE_HN }}" name="warehouse" id="warehouse-1" class="flat-red  warehouse_input" readonly="true" @if($order->warehouse == App\OrderShipping::WAREHOUSE_HN) checked @endif >
                                            {{trans('lang.kho_hn')}}</label>
                                            <label for="warehouse-2" class="label-vip">
                                            <input type="radio" value="{{ App\OrderShipping::WAREHOUSE_SG }}" name="warehouse" id="warehouse-2" class="flat-red warehouse_input" readonly="true" @if($order->warehouse == App\OrderShipping::WAREHOUSE_SG) checked @endif>
                                            {{trans('lang.kho_sg')}}</label>
                                        </div>
                                        <div class="form-group">
                                            <label>{{trans('lang.note')}}</label>
                                            <div class="order-note order-view-only">
                                                <textarea name="note" rows="3" class="form-control td-textarea" placeholder="Ghi chú đơn hàng" readonly="readonly">{{$order->note}}</textarea>
                                            </div>
                                            <div class="order-editable hidden">
                                                <textarea name="note" rows="3" class="form-control td-textarea" placeholder="Note"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>{{trans('lang.diachi_nhanhang')}}</label>
                                            <div class="order-address order-view-only" >
                                                <textarea name="address" rows="3" class="form-control td-textarea" placeholder="Địa chỉ nhận hàng" readonly>{{ $order->address }}</textarea>
                                            </div>
                                            <div class="order-editable hidden">
                                                <textarea name="address" rows="3" class="form-control td-textarea" placeholder="Địa chỉ nhận hàng">{{ $order->address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group static-group">
                                            <label class="col-md-6 col-sm-6">{{trans('lang.total_amount')}}</label>
                                            <label class="total_vnd label-content">{!! Currency::displayBold($order->vn_total_amount, 'vn') !!}</label>
                                        </div>
                                        <div class="form-group static-group">
                                            <label class="col-md-6 col-sm-6">{{trans('lang.down_payment')}}</label>
                                            <label class="total_vnd label-content label-deposit">{!! Currency::displayBold($order->deposit, 'vn') !!}</label>
                                        </div>
                                        <div class="form-group static-group">
                                            <label class="col-md-6 col-sm-6">{{trans('lang.pay_received')}}</label>
                                            <label class="total_vnd label-content label-deposit">{!! Currency::displayBold($order->received_pay, 'vn') !!}</label>
                                        </div>
                                        <div class="form-group static-group">
                                            <label class="col-md-6 col-sm-6">{{trans('lang.unpaid')}}</label>
                                            <label class="total_vnd label-content label-debt">{!! Currency::displayBold(($order->vn_total_amount - $order->deposit - $order->received_pay), 'vn') !!}</label>
                                        </div>
                                        @if (Auth::user()->group == \App\User::IS_ADMINISTRATOR || (Auth::user()->group == \App\User::IS_TELLER && in_array($order->status, \App\OrderShipping::$statusTellerAble)) || ((Auth::user()->group == \App\User::IS_STOREKEEPER && Auth::user()->group == \App\User::IS_SHIPER) || $order->status == \App\OrderShipping::STATUS_RELEASE))
                                        <div class="form-group">
                                            <div class="btn-cart-action col-sm-12">

                                                <button type="submit" class="btn btn-primary btn-update-order-info hidden">{{ trans('lang.update') }}</button>
                                            <a class="btn btn-xs btn-default btn-edit-order-info" href=""><i class="fa fa-edit"></i> {{trans('lang.edit')}}</a>
                                            
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <input type="hidden" name="active" value="1">
                </form>
                </tfoot>
                
            </table>
    
    </div>
</div>