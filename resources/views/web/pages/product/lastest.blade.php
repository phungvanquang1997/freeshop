@extends('web.layouts.main')

@section('body')
    {{ 'category-page' }}
@stop

@section('title')
    Sản phẩm mới
@stop

@section('content')
<div id="main" style="padding-top: 30px;">
    @if (count($sliders) > 0)
        <div class="feature-adv">
            <div class="slider">
                <ul>
                    @foreach($sliders as $item)
                    <li><a href="{{ $item->link }}" title="{{ $item->name }}"><img src="{{ \App\Helpers\MyHtml::showImage($item->image, 'banner') }}" alt="{{ $item->name }}" /></a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="container">
        <div class="heading">
            <div class="breadcrumb">
				<ul>
                    <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="itemscope"><a href="{{ url('/') }}" title="Thời trang" itemprop="url"><span itemprop="title">Trang chủ</span></a></li><li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="itemscope"><a href="{{ url('san-pham-moi.html') }}" title="Sản phẩm mới" itemprop="url"><span itemprop="title"><h1>Sản phẩm mới</h1></span></a></li>
                </ul>           
            </div>
            <div class="nav">
            </div>
        </div>
        <div class="product-group clearfix">
            <div class="products">
                @if (isset($products) && count($products) > 0)
                <?php $i = 0 ;?>
                    @foreach ($products as $product)
                    @if ($i % 4 == 0)
                    <div class="row">
                    @endif 
                    <?php $i++ ;?> 
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                            <div class="item">
                                @if (strlen($product->mainImage()->image))
                                <div class="thumb">
                                    <a href="{{ url($product->id . '-' . $product->slug) }}" title="{!! $product->name !!}">
                                    <img src="{{ \App\Helpers\MyHtml::showImage($product->mainImage()->image, 'product') }}" alt="{!! $product->name !!}" title="{{ $product->name }}">
                                    <span class="overlay"></span>
                                    </a>
                                </div>
                                @endif
                                <div class="caption">
                                    <h3 class="title"><a href="{{ url($product->id . '-' . $product->slug) }}" title="{!! $product->name !!}">{{ $product->name }}</a></h3>
                                    <p class="meta"><span class="price">
                        @if ($product->price > 0)
                        {{ number_format($product->price) }}đ
                        @else 
                            Liên hệ
                        @endif
                                    </span>
                                    @if ($product->is_hot == 1)
                                    <i class="i-hot"></i>
                                    @endif                                    
                                    <span class="count">{{ number_format($product->total_views) }}</span></p>
                                </div>
                            </div>
                        </div>
                    @if($i % 4 == 0 || $i == count($products))
                    </div>
                    @endif                      
                    @endforeach
                @else

                @endif
            </div>
            @if (isset($products) && count($products) > 0)
            <div class="button">
                <div class="paging">
                    <ul class="pagination">
                        {!! with(new App\NewProductPaginationLinks($products))->render() !!}
                    </ul>
                </div>
                @if ($products->currentPage() < $products->lastPage())
                <a class="button-1" href="{{ url('san-pham-moi')}}/trang-{{$currentPage+1}}.html" title="">Xem thêm sản phẩm<span><i class="fa fa-angle-right"></i></span></a>
                @endif
            </div>
            @endif
        </div>
        <!-- end menu -->
    </div>
    <!--container-->    
</div>
@stop

@section('front-footer-content')
    <script type="text/javascript">
        $(document).ready(function() {
        });
    </script>
@stop

