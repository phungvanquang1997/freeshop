@extends('web.layouts.main')

@section('title')
    {{ 'Giỏ hàng' }}
@stop

@section('head')
  <link href="{{ asset('css/switchery/switchery.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/iCheck/square/blue.css') }}">
@stop

@section('body')
    {{ 'category-page' }}
@stop

@section('content')
    <div class="columns-container">
        <div class="container order-bill" id="columns">
            <div class="content-result-box cart-content-box">
                <div class="cart-action-bottom">
                    <a class="button-2" href="{{url('/')}}" title=""><i class="fa fa-angle-left"></i> Tiếp tục mua hàng</a>
                    <div class="support"><strong>Hỗ trợ mua hàng</strong>{{$hotline}}</div>
                </div>

                @if($cart->count(false) >= 1)
                <!-- table Open -->
                    <table id="data-table" class="table table-bordered table-product-items">
                        <thead>
                            <tr>
                                <td width="5">STT</td>
                                <td width="25">Thông tin sản phẩm</td>
                                <td width="5">Số lượng</td>
                                <td width="15" class="text-right">Giá</td>
                                <td width="15">Thành tiền</td>
                                <td width="5">Xóa</td>
                            </tr>
                        </thead>
                        <tbody class="product-container">
                            <?php
                            $total_price = 0;
                            $i = 1;
                            ?>
                            @forelse ($cart as $item)
                                <tr id="cart-item-{{ $item->rowid }}">
                                    <td class="td-stt text-center">{{ $i }}</td>
                                    <td class="td-image">
                                        <div class="img-b">
                                            @if ($item->options->image != '')
                                            <img src="{{ \App\Helpers\MyHtml::showThumb($item->options->image, 'product', 'small') }}">
                                            @endif
                                        </div>
                                        <ul>
                                            <li>
                                                <a href="{{url($item->id . '-' . (isset($item->options['url']) ? $item->options['url'] : ''))}}">{{$item->name}}</a>
                                            </li>
                                            <li>Màu: {{ $item->options->color }}</li>
                                        </ul>
                                    </td>
                                    <td class="td-quantity">
                                        <input type="number" name="items[{{ $item->id }}][quantity]"
                                               value="{{ $item->qty }}" class="form-control td-text cart_quantity_input"
                                               data-rowid="{{ $item->rowid }}">
                                    </td>
                                    <td class="td-price text-right">
                                        {!! Currency::display($item->qty * $item->price, 'vn') !!}
                                    </td>
                                    <td class="td-total-price label-total-price text-right">{!! Currency::display($item->qty * $item->price, 'vn') !!}</td>
                                    
                                    <td class="td-action text-center">
                                        <a class="btn btn-kute btn-kute-xs btn-remove-cart" data-rowid="{{ $item->rowid }}" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @empty
                                Chưa có sản phẩm nào!
                            @endforelse
                           
                        </tbody>
                    </table>
                @else
                    <p class="cart-null">Chưa có sản phẩm nào trong giỏ hàng!</p>
                @endif
                
            </div>
            <div class="">
                @if($cart->count(false) >= 1)
                <form method="POST" action="{{url('/checkout/create')}}" name="frm_cart_checkout">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="buyer-info row">
                        <div class="col-lg-7 block">
                            <p class="title"><span>Thông tin giao hàng</span></p>

                            <div class="form">
                                <div class="form-group ">
                                    <label class="field-name">Họ và tên <span class="req">*</span>:</label>
                                    <div class="input-container "><input type="text" class="form-control" name="name" id="name" value="{{ old('name') != null ? old('name') : (Auth::guest() ? '' : Auth::user()->name)}}"/></div>
                                </div>
                                <div class="form-group ">
                                    <label class="field-name">Điện thoại di động <span class="req">*</span>:</label>
                                    <div class="input-container"><input type="text" class="form-control "  name="phone" id="phone" value="{{ old('phone') != null ? old('phone') : (Auth::guest() ? '' : Auth::user()->phone)}}" /></div>
                                </div>
                                {{-- 
                                <div class="form-group ">
                                    <label class="field-name">Email <span class="req">*</span>:</label>
                                    <div class="input-container"><input type="text" class="form-control "  name="email" id="email" value="{{ old('email') != null ? old('email') : (Auth::guest() ? '' : Auth::user()->email)}}" /></div>
                                </div>
                                --}}
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-sm-6">
                                        <label class="field-name">Tỉnh /Thành phố <span class="req">*</span>:</label>
                                        <div class="input-container">
                                            <select name="province_id" class="form-control">
                                                @foreach (App\Province::listProvince() as $id => $name)
                                                    <option value="{{ $id }}" {{ old('province_id', (Auth::user()?->province_id ?? null)) == $id ? 'selected' : '' }}>
                                                        {{ $name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="field-name">Huyện/ Quận<span class="req">*</span>:</label>
                                        <div class="input-container">
                                            <select name="district_id" class="form-control">
                                                @if(Auth::guest())
                                                    @foreach([] as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach(App\Province::listDistrict(Auth::user()->province_id) as $key => $value)
                                                        <option value="{{ $key }}" {{ old('district_id') == $key || (!old('district_id') && Auth::user()->district_id == $key) ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="field-name">Địa chỉ <span class="req">*</span>:</label>
                                    <div class="input-container"><input type="text" class="form-control" name="address" id="address" value="{{ old('address') != null ? old('address') : (Auth::guest() ? '' : Auth::user()->address)}}"/></div>
                                </div>                                
                                <div class="form-group">
                                    <label class="field-name">Ghi chú</label>
                                    <div class="input-container"><textarea rows="2" cols="1" name="note">{{old('note')}}</textarea></div>
                                </div>
                                <div class="note">
                                    <p class="req">* Mua thêm phí vận chuyển (nếu có) không đổi</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-5">
                            <div class="cart-coupon-apply row block-right">
                                <form class="form-inline">

                                    <div class="form-group pull-left col-md-9">
                                        <input type="text" class="form-control" name="p_cart_coupon" id="p_cart_coupon" value="" placeholder="Nhập mã khuyến mãi">
                                    </div>

                                    <div class="form-group col-md-3 pull-right">
                                        <input type="button" value="Áp dụng" class="btn btn-primary btn-apply-coupon">
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="col-lg-5 block-right">
                            <p class="title"><span>Hoàn tất đơn hàng</span></p>
                            <div class="total-info">
                                <p><span>Đơn hàng</span><span class="total-show">{!! Currency::displayBold($total, 'vn') !!}</span></p>
                                
                                <p class="cart-discount-section"><span>Khuyến mãi</span><span class="cart_discount_amount">{!! Currency::displayBold($discount, 'vn') !!}</span></p>
                                <p class="gross"><span>Tổng cộng</span><span class="gross-show">{!! Currency::displayBold($gross, 'vn') !!}</span></p>
                            </div>
                            <div class="form-group form-footer">
                                <input type="submit" value="Đặt hàng" class="btn btn-default">
                            </div>
                        </div>
                    </div>
                </form>
                @endif
            </div>

        </div>
    </div>

@stop
@section('front-footer-content')
    <script type="text/javascript">
        $( document).ready(function() {
            $('select[name=province_id]').change(function(){
                var province_id = $(this).val();
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url : siteUrl + '/account/get-districts',
                    method : 'post',
                    data : {id:province_id, _token:_token},
                    success : function(res){
                        $('select[name=district_id]').html(res);
                    }
                });
            });

            $('.btn-apply-coupon').click(function(){
                var voucher = $('#p_cart_coupon').val();
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url : siteUrl + '/checkout/check-coupon',
                    method : 'post',
                    data : {voucher:voucher, _token:_token},
                    success : function(res){
                        console.log(res);
                        // return;
                        var res = $.parseJSON(res);
                        if (res.code == 1) {
                            $('.cart_discount_amount').html(res.discount);
                            $('.gross .gross-show').html(res.gross);
                        }
                    }
                });
            })
        });
    </script>
@stop
    
