@extends('web.layouts.main')

@section('body')
    {{ 'category-page' }}
@stop

@section('title')
    {{ $category->name }}
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
                <?php
                    $breadcrumb = $category;
                    $breadcrumb->name = '<h1>' . $breadcrumb->name . '</h1>';
                ?>
                    {!! \App\Helpers\MyHtml::generateBreadcrumb($breadcrumb) !!}
                </ul>            
            </div>
            <div class="nav">
                <div class="inner">
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="icon"></span>
                        Loại sản phẩm
                        </button>
                        @if (isset($children) && count($children) > 0)
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <ul>
                            @foreach ($children as $item)
                                <li><a href="{{ url ($item->slug . '.html') }}">{{ $item->name }}</a>
                                </li>
                            @endforeach
                            </ul>
                        </ul>
                        @endif
                    </div>
                    <a class="active" href="{{ url ('san-pham-moi.html') }}" title="">Mới nhất</a>
                    <a href="{{ url ($category->slug . '/deal-hot.html') }}">Bán chạy</a>
                </div>
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
                                    <p class="meta">
                                    <span class="price">
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
                        {!! with(new App\CustomPaginationLinks($products))->render() !!}
                    </ul>                    
                </div>
                @if ($products->currentPage() < $products->lastPage())
                <a class="button-1" href="{{ url($category->slug)}}/trang-{{$currentPage+1}}.html" title="">Xem thêm sản phẩm<span><i class="fa fa-angle-right"></i></span></a>
                @endif
            </div>
            @endif
        </div>
        <!--product-group-->
        <div class="description col-12-md" style="margin-top: 10px">
            <div class="panel panel-danger">
                <div class="panel-body">                        
                    {!! $category->content !!}
                </div>
            </div>
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

