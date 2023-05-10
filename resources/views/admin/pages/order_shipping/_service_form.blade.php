<div class="panel panel-default">
    <div class="panel-body">
        <table id="data-table" class="table table-product-items">
            <tbody>
                <form method="POST" action="/admin/order_shipping/{{ $order->id }}">
                @method('PUT')
                @csrf
                <tr>
                    <td colspan="8" class="no-padding">
                        <div class="order-express-info">
                            <h2 class="heading">{{trans('lang.order_info')}}</h2>
                            <div class="row">
                                
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group underline-group">
                                                <label class="col-md-8 col-sm-6">{{trans('lang.ty_gia')}}</label>
                                                <label class="label-content">1 {!! Currency::signals('cn') !!} = {{ $cny_to_vnd }} {!! Currency::signals('vn') !!}</label>
                                            </div>
                                            <div class="form-group underline-group">
                                                <label class="col-md-8 col-sm-6">{{trans('lang.can_nang')}} (Kg)</label>
                                                <label class="label-content weight"><strong>{{ $order->weight }}</strong> Kg</label>
                                                
                                            </div>
                                             <div class="form-group underline-group">
                                                <label class="col-md-8 col-sm-6">{{trans('lang.ship_nd_tq')}}</label>
                                                <label class="label-content cn_shipping_fee">{!! Currency::displayBold(isset($order->cn_shipping_fee) ? $order->cn_shipping_fee : 0, 'cn') !!}</label>

                                            </div>
                                            <div class="form-group underline-group">
                                                <label class="col-md-8 col-sm-6">{{trans('lang.ship_tq_vn')}}</label>
                                                <label class="label-content shipping_fee">{!! Currency::displayBold(isset($order->shipping_fee) ? $order->shipping_fee : 0, 'vn') !!}</label>
                                                
                                            </div>
                                            <div class="form-group underline-group">
                                                <label class="col-md-8 col-sm-6">{{trans('lang.ship_nd_vn')}}</label>
                                                <label class="label-content vn_shipping_fee order-view-only">{!! Currency::displayBold(isset($order->vn_shipping_fee) ? $order->vn_shipping_fee : 0, 'vn') !!}</label>
                                                <div class="order-editable hidden">
                                                    <input type="number" name="vn_shipping_fee" value="{{ $order->vn_shipping_fee }}" class="form-control td-text vn_shipping_fee_input">                                                </div>
                                            </div>
                                            <div class="form-group underline-group">
                                                <label class="col-md-8 col-sm-6">{{trans('lang.dong_kien')}}</label>
                                                <label class="label-content package_fee order-view-only">{!! Currency::displayBold(isset($order->package_fee) ? $order->package_fee : 0, 'vn') !!}</label>
                                                <div class="order-editable hidden">
                                                    <input type="number" name="package_fee" value="{{ $order->package_fee }}" class="form-control td-text package_fee_input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group warehouse-box">
                                                <label class="warehouse-label">{{trans('lang.hang_ve')}}: </label>
                                                <label for="warehouse-1" class="label-standard active">
                                                <input type="radio" value="{{ App\OrderShipping::WAREHOUSE_HN }}" name="warehouse" id="warehouse-1" class="flat-red  warehouse_input" @if($order->warehouse == App\OrderShipping::WAREHOUSE_HN) checked @endif >
                                                {{trans('lang.kho_hn')}}</label>
                                                <label for="warehouse-2" class="label-vip">
                                                <input type="radio" value="{{ App\OrderShipping::WAREHOUSE_SG }}" name="warehouse" id="warehouse-2" class="flat-red warehouse_input" @if($order->warehouse == App\OrderShipping::WAREHOUSE_SG) checked @endif>
                                                {{trans('lang.kho_sg')}}</label>
                                            </div>
                                            <div class="form-group">
                                                <label>{{trans('lang.note')}}:</label>
                                                <div class="order-note order-view-only">
                                                    <textarea name="note" rows="3" class="form-control td-textarea" placeholder="Ghi chú đơn hàng" readonly>{{ $order->note }}</textarea>
                                                </div>
                                                <div class="order-editable hidden">
                                                    <textarea name="note" rows="3" class="form-control td-textarea" placeholder="Thông tin ghi chú">{{ $order->note }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>{{trans('lang.diachi_nhanhang')}}:</label>
                                                <div class="order-address order-view-only" >
                                                    <textarea name="address" rows="3" class="form-control td-textarea" placeholder="Địa chỉ nhận hàng" readonly>{{ $order->address }}</textarea>
                                                </div>
                                                <div class="order-editable hidden">
                                                    <textarea name="address" rows="3" class="form-control td-textarea" placeholder="Địa chỉ nhận hàng">{{ $order->address }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4"> 
                                    
                                    <div class="form-group static-group">
                                        <label class="col-md-6 col-sm-6">{{trans('lang.total_amount')}}</label>
                                        <label class="total_vnd label-content">{!! Currency::displayBold($order->vn_total_amount, 'vn') !!}</label>
                                    </div>
                                    <div class="form-group static-group">
                                        <label class="col-md-6 col-sm-6">{{trans('lang.down_payment')}}</label>
                                        <label class="total_vnd label-content label-deposit">{!! Currency::displayBold($order->deposit, 'vn') !!}</label>
                                    </div>
                                    <div class="form-group static-group">
                                            <label class="col-md-6 col-sm-6">Thanh toán NH</label>
                                            <label class="total_vnd label-content label-deposit">{!! Currency::displayBold($order->received_pay, 'vn') !!}</label>
                                        </div>
                                    <div class="form-group static-group">
                                        <label class="col-md-6 col-sm-6">{{trans('lang.unpaid')}}</label>
                                        <label class="total_vnd label-content label-debt">{!! Currency::displayBold(($order->vn_total_amount - $order->deposit - $order->received_pay), 'vn') !!}</label>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="btn-cart-action col-sm-12">
                                            <button type="submit" class="btn btn-primary btn-update-order-info hidden">@lang('lang.update')</button>
                                            <a class="btn btn-xs btn-default btn-edit-order-info" href=""><i class="fa fa-edit"></i> {{trans('lang.edit')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                    <input type="hidden" name="active" value="1">
                </form>
            </tbody>
            
        </table>
    </div>
</div>
