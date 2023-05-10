@extends('web.layouts.main')

@section('title')
    {{ $product->name }}
@stop

@section('body')
    {{ 'product-page' }}
@stop

@section('content')
    <div id="main" style="padding-top: 30px;">      
        <div class="container">
            <div class="body_right" id="body_right">
                <div class="header-info-fix" style="display: none;">
                    <div class="container">
                        <div class="content-left">
                            <div class="box-info">
                                <div class="thumbnail">
                                    <img src="{{ \App\Helpers\MyHtml::showThumb($product->mainImage()->image, 'product', 'small') }}" alt="{!! $product->name !!}" title="{!! $product->name !!}">
                                </div>
                                <div class="product-info">
                                    <div class="product-name">
                                        {{ $product->name }}
                                    </div>
                                    <div class="product-price">
                                    <span class="sale-price">
                                    @if ($product->price > 0)
                                    {{ number_format($product->price) }}đ
                                    @else 
                                        Liên hệ
                                    @endif
                                    </span>                                                                             
                                        (<span class="regular-price">{!! \App\Helpers\Currency::display($product->market_price) !!}</span>)
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-right">
                            <div class="support"><strong>Hỗ trợ mua hàng</strong>@if ($hotline) {{$hotline}} @endif</div>
                            <div class="button"><input type="button" value="Mua ngay" class="btn btn-default btn-buy btn-add-to-cart"></div>
                        </div>
                    </div>
                    <div class="overlay"></div>
                </div>
                <div class="heading">
                    <div class="breadcrumb">
                        <ul>                        
                            {!! \App\Helpers\MyHtml::generateBreadcrumb($category) !!}
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10 col-md-12">
                        <div class="product-detail" itemscope="" itemtype="http://schema.org/Product">
                            <div class="top-detail">
                                <div class="photo">
                                    <div class="preview"><img itemprop="image" src="{{ \App\Helpers\MyHtml::showImage($product->mainImage()->image, 'product') }}" alt="{!! $product->name !!}" title="{!! $product->name !!}"></div>
                                    @if (count($images))
                                    <div class="thumbs">
                                        <div class="inner">
                                            <ul>
                                                @foreach ($images as $image)
                                                <li><a href="{{ \App\Helpers\MyHtml::showImage($image->image, 'product', 'small') }}" title="{!! $product->name !!}"><img src="{{ \App\Helpers\MyHtml::showThumb($image->image, 'product', 'small') }}" alt="{!! $product->name !!}" title="{!! $product->name !!}"><span class="frame"></span></a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="caption">
                                    <h1 itemprop="name" title="{!!$product->name!!}">{!!$product->name!!}</h1>
                                    <div class="meta">                                        
                                        <div class="addthis">
                                            <ul>
                                                <li class="facebook_like">
                                                <div class="fb-like" data-href="{{URL::current()}}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                                                </li>
                                                <li class="google_plus">
                                                    <div class="g-plusone" data-href="{{URL::current()}}" data-size="medium" data-width="70"></div>
                                                </li>
                                                <li class="pinterest">
                                                    <a data-pin-config="beside" href="//pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png"></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="code">
                                        <strong>Mã SP : <span itemprop="mpn">{{ $product->sku }}</span></strong>
                                    </p>
                                    <div class="desc" itemprop="description">
                                        <p>{!! $product->description !!}</p>
                                    </div>
                                    <div class="price">
                                        <p class="primary-price">Giá gốc: <span itemprop="highPrice">{!! \App\Helpers\Currency::display($product->market_price) !!}</span></p>
                                        <p class="best-price"><strong>
                                        <span itemprop="lowPrice">
                                        @if ($product->price > 0)
                                        {{ number_format($product->price) }}đ
                                        @else 
                                            Liên hệ
                                        @endif                                            
                                        </span>
                                        </strong></p>
                                    </div>
                                    <div class="option clearfix">
                                        <div class="size clearfix">
                                            <div class="col-sm-3">
                                                <label class="name">Tùy chọn:</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select name="item_option_se" class="item_option_se form-control">
                                                    @if (!empty($product->colors()))
                                                        @foreach ($product->colors() as $color)
                                                            <option value="{{$color}}">{{$color}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="number clearfix">
                                            <div class="col-sm-3">
                                                <label class="name">Số lượng:</label>
                                            </div>
                                            <div class="g-opt col-sm-9">
                                                <div class="input-group number-spinner">
                                                   <span class="input-group-btn data-dwn">
                                                   <a class="btn btn-default btn-info" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></a>
                                                   </span>
                                                    <input type="text" class="form-control text-center" name="item_qty_se" value="1" min="1" max="10">
                                                   <span class="input-group-btn data-up">
                                                   <a class="btn btn-default btn-info" data-dir="up"><span class="glyphicon glyphicon-plus"></span></a>
                                                   </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottombar">
                                        <div class="button"><input type="button" value="Mua ngay" class="btn btn-default btn-buy btn-add-to-cart"></div>
                                        <div class="total"><strong><span class="ordered_number">{{ number_format($product->total_views)}}</span> người</strong>đã mua</div>
                                        <div class="support"><strong>Hỗ trợ mua hàng</strong>@if ($hotline) {{$hotline}} @endif</div>
                                    </div>
                                    <div class="bottombar mobilebar fixed">
                                        <div class="price">
                                            <p class="primary-price">Giá gốc: {!! \App\Helpers\Currency::display($product->market_price) !!}</p>
                                            <p class="best-price"><strong>
                                            @if ($product->price > 0)
                                            {{ number_format($product->price) }}đ
                                            @else 
                                                Liên hệ
                                            @endif                                                
                                            </strong></p>
                                        </div>
                                        <div class="button"><input type="button" value="Mua ngay" class="btn btn-default btn-buy btn-add-to-cart"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row services">
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="item">
                                        <div class="icon"><img src="{{ asset('images/service-1.png') }}" title="An toàn và đảm bảo"></div>
                                        <a href="#">
                                            <p class="caption"><strong>Thanh toán<br>khi nhận hàng</strong>An toàn và đảm bảo</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="item">
                                        <div class="icon"><img src="{{ asset('images/service-2.png') }}" alt="Giao hàng tận nơi nhanh chóng" title="Giao hàng tận nơi nhanh chóng"></div>
                                        <p class="caption"><strong>Giao Hàng<br>Toàn Quốc</strong>Giao hàng tận nơi nhanh chóng</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="item">
                                        <div class="icon"><img src="{{ asset('images/service-3.png') }}" alt="Đổi trả hàng" title="Đổi trả hàng"></div>
                                        <a href="#">
                                            <p class="caption"><strong>Đổi trả<br>trong 7 ngày</strong>Xem quy định đổi trả hàng</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="item">
                                        <div class="icon"><img src="{{ asset('images/service-4.png') }}" alt="Liên hệ giá sỉ/buôn"></div>
                                        <p class="caption"><strong>Liên hệ<br>mua giá sỉ/buôn</strong><span style="white-space: pre-line; margin-top: -20px;">{{$saler_phone}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="product-info">
                                <h2 class="title"><span>Đặc điểm nổi bật</span></h2>
                                <div class="editor">
                                    {!! $product->special !!}
                                </div>
                            </div>
                            <div class="product-info">
                                <h2 class="title"><span>Thông tin sản phẩm</span></h2>
                                <div class="editor">
                                    {!! $product->content !!}
                                </div>

                                @if ($product->tags!='')
                                <?php 
                                    $i = 0;
                                    $keywords = @explode(',', $product->tags);                            
                                ?>
                                <div class="tags">
                                    <strong>Tags: </strong>
                                    @foreach ($keywords as $keyword)
                                    <?php $i++;?>
                                    <a href="{{url('/tag/' . $product->id . '-' . \Str::slug($keyword) . '.html')}}">{{$keyword}}</a>
                                    <?php if ($i < count($keywords)) echo ',' ;?>
                                    @endforeach
                                </div>
                                @endif

                                <div class="bottombar">
                                    <div class="price">
                                        @if ($product->market_price != 0 || $product->market_price != null)
                                        <p class="primary-price">Giá gốc: {!! \App\Helpers\Currency::display($product->market_price) !!}</p>
                                        @endif
                                        <p class="best-price"><strong>
                                        @if ($product->price > 0)
                                        {{ number_format($product->price) }}đ
                                        @else 
                                            Liên hệ
                                        @endif
                                        </strong></p>
                                    </div>
                                    <div class="total"><strong><span class="ordered_number">{{ number_format($product->total_views) }}</span> người</strong>đã mua</div>
                                    <div class="support"><strong>Hỗ trợ mua hàng</strong>@if ($hotline) {{$hotline}} @endif</div>
                                    <div class="button"><input type="submit" value="Mua ngay" class="btn btn-default btn-buy btn-add-to-cart"></div>
                                </div>
                            </div>
                            <div class="comment">
                                <h2 class="title"><span>Đánh giá và bình luận</span></h2>
                                <div class="rmn-comment">
                                    <form method="post" action="{{url('/comment')}}" name="form_comment" class="form_comment">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="post_id" value="{{$product->id}}">
                                        <div class="comment-box-post">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="product-rating-control">Cho điểm sản phẩm</label>
                                                    <div class="rating-container rating-xs rating-animate">
                                                        <input id="product-rating-control" name="comment_rating" class="rating hide" value="5" data-min="0" data-max="5" data-step="1" data-show-clear="false" data-show-caption="false" data-size="xs">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control comment_name" name="comment_name" value="" placeholder="Vui lòng nhập họ tên">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control comment_name" name="comment_email" value="" placeholder="Vui lòng nhập Email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <textarea class="form-control comment_content" name="comment_content" placeholder="Mời bạn để lại bình luận"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="button" class="btn btn-primary submit_comment" name="submit_comment" value="Gửi thông tin">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div>
                                        <ul class="comment-list">
                                            
                                            @foreach($comments as $item)
                                            <li class="comment-item comment-parent row" data-id="0">
                                                <div class="content-left col-md-1">
                                                    <a href="#">
                                                        <div class="avatar">
                                                            {{$item->name}}
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="content-right col-md-11">
                                                    <div class="comment-rating">
                                                        <div class="rating-container rating-xs rating-animate">
                                                            <div class="rating">
                                                            <span class="empty-stars">
                                                                <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                                                <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                                                <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                                                <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                                                <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                                                            </span>
                                                            <span class="filled-stars">
                                                                @for ($i = 1; $i <= (int) $item->star; $i++)
                                                                    <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                                                                @endfor
                                                                
                                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="comment-content">
                                                        {{$item->content}}
                                                    </p>
                                                    <div class="comment-child-section">
                                                        <ul class="comment-list-child">
                                                            @if (!$item->children()->get()->isEmpty())
                                                                @foreach($item->children()->get() as $child)
                                                                    <li><span style="color:red">{{$child->name}}</span>: <span>{{$child->content}}</span></li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="comment">
                                <h2 class="title"><span>Bình luận trên Facebook</span></h2>
                                <div class="fbplugin">
                                    <div class="fb-comments fb_iframe_widget" data-href="{{URL::current()}}" data-numposts="5" data-width="740" data-num-posts="10"></div>
                                </div>
                            </div>                           
                            @if (isset($relatedProducts) && count($relatedProducts) > 0) 
                            <div class="product-group">
                                <h2 class="title"><span>Sẽ đẹp hơn với</span></h2>
                                <div class="row products">
                                    <ul class="list-product">
                                    @foreach ($relatedProducts as $item)
                                        <li class="col-lg-a col-md-3 col-sm-4 col-xs-6">
                                            <div class="item">
                                                @if ($item->mainImage()->image)
                                                <div class="thumb">
                                                    <a href="{{ url( $item->id . '-' . $item->slug) }}" title="{!! $item->name !!}">
                                                        <img src="{{ \App\Helpers\MyHtml::showThumb($item->mainImage()->image, 'product', 'medium') }}" alt="{!! $item->name !!}" title="{!! $item->name !!}">
                                                        <span class="overlay"></span>
                                                    </a>
                                                </div>
                                                @endif
                                                <div class="caption">
                                                    <h3 class="title"><a href="{{ url( $item->id . '-' . $item->slug) }}" title="{!! $item->name !!}" target="_blank">{{$item->name}}</a></h3>
                                                    <p class="meta"><span class="price">
                                                    @if ($item->price > 0)
                                                    {{ number_format($item->price) }}đ
                                                    @else 
                                                        Liên hệ
                                                    @endif
                                                    </span><span class="count">{{ number_format($item->total_views) }}</span></p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                    </ul>
                                    <ul class="slider">
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @if (isset($viewedProducts) && count($viewedProducts) > 0) 
                            <div class="product-group">
                                <h2 class="title"><span>Sản phẩm đã xem</span></h2>
                                <div class="row products">
                                    <ul class="slider">
                                    @foreach ($viewedProducts as $item)
                                        <li class="col-lg-a col-md-3 col-sm-4 col-xs-6">
                                            <div class="item">
                                                <?php 
                                                    $p = \App\Product::findBySlug($item->slug);
                                                ?>
                                               @if ($p->mainImage()->image)
                                                <div class="thumb">
                                                    <a href="{{ url( $item->id . '-' . $item->slug) }}" title="{!! $item->name !!}">
                                                        <img src="{{ \App\Helpers\MyHtml::showThumb($p->mainImage()->image, 'product', 'medium') }}" alt="{{$item->name}}" title="{{$item->name}}">
                                                        <span class="overlay"></span>
                                                    </a>
                                                </div>
                                                @endif                                                
                                                <div class="caption">
                                                    <h3 class="title"><a href="{{ url( $item->id . '-' . $item->slug) }}" title="{{$item->name}}" target="_blank">{{$item->name}}</a></h3>
                                                    <p class="meta"><span class="price">
                                                    @if ($item->price > 0)
                                                    {{ number_format($item->price) }}đ
                                                    @else 
                                                        Liên hệ
                                                    @endif
                                                    </span><span class="count">{{ number_format($p->total_views) }}</span></p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif                            
                        </div>
                        <div class="fb-tracking-data" data-content-ids="{{ $product->id }}" data-product-id="{{ $product->id }}" data-product-price="{{ $product->price }}" data-product-category="{{ $product->name }}"></div>
                    </div>
                    
                    <div class="col-lg-2 no-padding">
                        @if (count($related))
                        <div class="relative-products">
                            <h2 class="title">Sản phẩm tương tự</h2>
                            <div class="products clearfix">
                                @foreach ($related as $item)
                                <div class="item">
                                    @if ($item->mainImage()->image)
                                    <div class="thumb">
                                        <a href="{{ url( $item->id . '-' . $item->slug) }}" title="{{$item->name}}">
                                            <img src="{{ \App\Helpers\MyHtml::showThumb($item->mainImage()->image, 'product', 'medium') }}" alt="{!! $item->name !!}" title="{!! $item->name !!}">
                                            <span class="overlay"></span>
                                        </a>
                                    </div>
                                    @endif
                                    <div class="caption">
                                        <h3 class="title"><a href="{{ url( $item->id . '-' . $item->slug) }}" title="{!! $item->name !!}" target="_blank">{{$item->name}}</a></h3>
                                        <p class="meta"><span class="price">
                                        @if ($item->price > 0)
                                        {{ number_format($item->price) }}đ
                                        @else 
                                            Liên hệ
                                        @endif
                                        </span><span class="count">{{ number_format($item->total_views) }}</span></p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @if (count($lasts))
                        <div class="relative-products">
                            <h2 class="title">Sản phẩm mới</h2>
                            <div class="products clearfix">
                                @foreach ($lasts as $item)
                                <div class="item">
                                    @if ($item->mainImage()->image)
                                    <div class="thumb">
                                        <a href="{{ url( $item->id . '-' . $item->slug) }}" title="{{$item->name}}">
                                            <img src="{{ \App\Helpers\MyHtml::showThumb($item->mainImage()->image, 'product', 'medium') }}" alt="{!! $item->name !!}" title="{!! $item->name !!}">
                                            <span class="overlay"></span>
                                        </a>
                                    </div>
                                    @endif
                                    <div class="caption">
                                        <h3 class="title"><a href="{{ url( $item->id . '-' . $item->slug) }}" title="{!! $item->name !!}" target="_blank">{{$item->name}}</a></h3>
                                        <p class="meta"><span class="price">
                                        @if ($item->price > 0)
                                        {{ number_format($item->price) }}đ
                                        @else 
                                            Liên hệ
                                        @endif
                                        </span><span class="count">{{ number_format($item->total_views) }}</span></p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
        <!--container-->
    </div>
    <items  
        item-name="{{$product->name}}"  
        item-price="{{$product->price}}"  
        item-id="{{$product->id}}"  
        item-sku="{{$product->sku}}"  
        item-slug="{{$product->slug}}"  
        item-image="@if (count($images)) {{trim($images[0]->image)}} @endif" >  
    </items>
@stop

@section('front-footer-content')

<script type="text/javascript" src="{{ asset('js/jquery.noty.packaged.min.js') }}" defer=""></script>
<script type="text/javascript" src="{{ asset('js/product_detail.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/star-rating.css') }}" type="text/css">
<script type="text/javascript" src="{{ asset('js/star-rating.js') }}" defer=""></script>
<script type="text/javascript">
    var loadZopim = 0;
</script>
@stop
@section('google_remarketing')
	@if(!empty($product->code_remarketing))
		{!! $product->code_remarketing !!}
	@endif
@stop
