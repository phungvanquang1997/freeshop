@extends('web.layouts.main')

@section('title')
    {{'Gửi đơn hàng'}}
@stop

@section('body')
    {{ 'category-page' }}
@stop

@section('content')

    <div class="order-bill">
        <div class="inner">
            <div class="container">
                <div class="order-bill-2 buyer-info row">
                    <div class="col-lg-8 block">
                        <div class="order-result">
                            <p class="title"><span>đặt hàng thành công</span></p>
                            <p class="title-m">Cảm ơn đơn đặt hàng của bạn!</p>
                            <p>Áo Giá Sỉ sẽ liên hệ quý khách trong vòng 24h làm việc</p>
                            <p class="str">Luôn giữ điện thoại bên cạnh bạn nhé!</p>
                            <div class="info">
                                <div class="idcode">Số đơn hàng<strong>#{{$order->id}}</strong></div>
                                <div class="desc">
                                    <strong>Người nhận:</strong> {{$order->name}}<br />
                                    <strong>Địa chỉ:</strong> {{$order::fullAddress($order)}}<br />
                                    <strong>Điện thoại:</strong> {{$order->phone}}</div>
                            </div>
                        </div>

                        <div class="product-group">
                            <p class="title"><span>sản phẩm nên mua thêm</span></p>
                            <div class="products row">
                                @forelse ($suggest as $item)
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="item">
                                        <div class="thumb">
                                            @if (isset($item->mainImage()->image))
                                                <a href="/{{$item->id}}-{{$item->slug}}" title="{{$item->name}}">
                                                    <img width="50" src="{{ MyHtml::showThumb($item->mainImage()->image, 'product') }}" alt="">
                                                    <span class="overlay"></span>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="caption">
                                            <p class="title"><a href="/{{$item->id}}-{{$item->slug}}" title="{{$item->name}}">{{$item->name}}</a></p>
                                            <p class="meta"><span class="price">{!! number_format($item->price) !!} đ</span><i class="i-new"></i><span class="count">{{number_format($item->total_sales)}}</span></p>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 block">
                        <div class="shopbag">
                            <p class="title"><span>Tóm tắt đơn hàng</span></p>
                            <!-- item -->
                            @forelse ($order->items()->get() as $item)

                            <div class="item">
                                <div class="thumb">
                                @if (isset($item->product()->first()->mainImage()->image))
                                <a href="/{{$item->product->id}}-{{$item->product->slug}}" title="{{$item->product->name}}"><img src="{{ MyHtml::showThumb($item->product()->first()->mainImage()->image, 'product') }}" alt="{{$item->product->name}}"/></a>
                                @endif
                                </div>
                                <div class="caption">
                                    <p class="name"><a href="/{{$item->product->id}}-{{$item->product->slug}}" title="">{{$item->product->name}}</a></p>
                                    <p>Đơn giá: {{number_format($item->price)}} đ</p>
                                    <p>Số lượng:  {{number_format($item->quantity)}}</p>
                                </div>
                            </div>
                            @empty
                            @endforelse
                        <!-- end item -->
                        </div>
                        <div class="total-info small">
                            <p><span>Đơn hàng</span><span>{{number_format($order->total_amount)}} đ</span></p>
                            <p><span>Phí giao</span><span>{{number_format($order->shipping_cost)}} đ</span></p>
                            <p><span>Chiết khấu</span><span>{{number_format($order->discount)}} đ</span></p>
                            <p class="total"><span>Tổng cộng</span><span><b>{{number_format($order->total_amount + $order->shipping_cost - $order->discount)}} đ</b></span></p>
                            <div class="button">
                                <a title="" href="{{url('/')}}" class="button-2">Tiếp tục mua hàng<i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                        <div class="followus">
                            <p class="title"><span>Theo dõi chúng tôi</span></p>
                            <ul>
                                <li><a class="btn-s-4" href="@if (isset($facebook_link)) {{$facebook_link}} @endif">Facebook</a></li>
                                <li><a class="btn-s-5" href="@if (isset($zalo_link)) {{$zalo_link}} @endif" title="Áo Giá Sỉ trên Zalo">Zalo</a></li>
                                <li><a class="btn-s-6" href="@if (isset($google_plus_link)) {{$google_plus_link}} @endif" title="Áo Giá Sỉ trên Google">Google</a></li>
                                <li><a class="btn-s-7" href="@if (isset($instagram_link)) {{$instagram_link}} @endif">Instaram</a></li>
                            </ul>
                        </div>
                        <div class="button center">
                            <a class="button-1" href="{{url('/')}}" title="">Trở về trang chủ<span><i class="fa fa-angle-right"></i></span></a>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>    
@stop

@section('front-footer-content')
    @foreach($order->items()->get() as $item)
        {!! $item->product->code_adword !!}
    @endforeach
@stop
