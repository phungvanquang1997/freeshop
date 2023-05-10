@extends('web.layouts.main')

@section('title')
    {{ 'Danh sách đơn hàng | ' . Auth::user()->name }}
@stop

@section('body')
    {{ 'category-page' }}
@stop

@section('content')
    <!--
    <div class="breadcrumb clearfix">
        <div class="container">
        <a class="home" href="/"><i class="fa fa-home"></i> Trang chủ</a>
        <span class="navigation-pipe">&nbsp;</span>
        <span class="navigation_page">Đơn hàng</span>            
        </div>
    </div>
    -->
    <div class="columns-container page-account">
        <div class="container" id="columns">
            <h2 class="page-heading">
                <span class="page-heading-title2">Danh sách đơn hàng</span>
            </h2>

            <div class="container account account-order">

                @include('web.pages.account._sidebar')

                <div class="col-sm-9">
                    <div class="table-responsive">
                    <table class="table order-table">
                        <tr>
                            <th>#</th>
                            <th>Ngày tạo</th>
                            <th>Tổng</th>
                            <th>Trạng thái</th>
                            <th>Ghi chú</th>
                            <th width="20px"></th>
                        </tr>

                        @forelse($orders as $order)

                            <tr class="general" rowid="{{ $order->id }}" title="Click để xem">
                                <td class="clickable">{{ $order->id }}</td>
                                <td class="clickable">{{ date('d/m/Y H:i', strtotime($order->created_at)) }}</td>
                                <td class="clickable">{!! Currency::display($order->total_amount) !!}</td>
                                <td>{!! MyHtml::displayOrderStatus($order) !!}</td>
                                <td>{{$order->note}}</td>
                                <td>
                                    @if ($order->status == 1)
                                        {!! Form::open(['url' => 'order/' . $order->id, 'method' => 'DELETE',
                                        'class' => 'inline']) !!}
                                        <button type="submit"
                                                onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng?')"
                                                class="btn btn-xs btn-default font14">
                                            <i class="fa fa-times-circle"></i> Hủy
                                        </button>
                                        {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-{{ $order->id }} detail-row" style="display: none;">
                                <td colspan="6">
                                    @if (!$order->items->isEmpty())
                                        <table class="table table-bordered detail-product-order" style="font-size: 13px;">
                                            <thead>
                                                <tr>
                                                    <td class="text-center">STT</td>
                                                    <td class="text-center">{{trans('lang.image')}} / {{trans('lang.name')}}</td>
                                                    <td class="text-center">{{trans('lang.thuoctinh')}}</td>
                                                    <td class="text-center">{{trans('lang.quantity')}}</td>
                                                    <td class="text-center">Giá</td>
                                                    <td class="text-center">Thành tiền</td>
                                                    <td class="text-center">{{trans('lang.note')}}</td>
                                                </tr>
                                            </thead>
                                            <?php $ci = 0; ?>
                                            @foreach ($order->items as $item)
                                                <?php $ci++ ?>
                                                <tr>
                                                    <td width="3%" style="vertical-align: middle;">{{ $ci }}</td>
                                                    <td width="27%" class="image-box">
                                                        @if ($item->product()->first()->mainImage()->image != '')
                                                        <img src="{{ \App\Helpers\MyHtml::showThumb($item->product()->first()->mainImage()->image, 'product', 'small') }}">
                                                        @endif
                                                        <p>{{ $item->product()->first()->name }}</p>
                                                    </td>
                                                    <td width="10%">Màu: {{ $item->color }}</td>
                                                    <td width="10%" class="text-right">{{ $item->quantity }}</td>
                                                    <td width="10%" class="text-right">{!! Currency::display($item->price, 'vn') !!}</td>
                                                    <td width="10%" class="text-right">{!! Currency::display($item->price * $item->quantity, 'vn') !!}</td>
                                                    <td width="15%">{{ $item->note }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="7">
                                                    <span style="width:24%; display: inline-block;">Tổng tiền hàng: {!! Currency::display($order->total_amount, 'vn') !!}</span>
                                                    <span style="width:24%; display: inline-block;">Phí gửi hàng: {!! Currency::display($order->shipping_cost, 'vn') !!}</span>
                                                    <span style="width:24%; display: inline-block;">Chiết khấu: {!! Currency::display($order->discount, 'vn') !!}</span>
                                                    <?php $gross = $order->total_amount + $order->shipping_cost - $order->discount > 0 ? $order->total_amount + $order->shipping_cost - $order->discount : 0;?>
                                                    <span style="width:24%; display: inline-block;">Phải thanh toán: <strong>{!! Currency::display($gross, 'vn') !!}</strong></span>
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7">{{ 'Bạn chưa có đơn hàng nào' }}</td>
                            </tr>
                        @endforelse

                    </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
@stop

@section('front-footer-content')
    <script>
        $('.general td.clickable').on('click', function() {
            var parent = $(this).parent();
            var rowid = parent.attr('rowid');
            var visible = $('.detail-' + rowid).is(":visible");
            $('.order-active-table tr.detail-row').each(function(){
                $(this).hide('fast');
            });
            if (visible) {
                $('.detail-' + rowid).hide('fast');
            } else {
                $('.detail-' + rowid).show('fast');
            }
        });
    </script>
@stop