@extends('web.layouts.main')

@section('content')
<div id="main">
    @if (isset($sliders) && count($sliders) > 0)
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
<!--feature adv-->
<div class="container">

<div class="fproduct-home product-group clearfix">
    <h2 class="title-row"><span>Sản phẩm mới</span></h2>
    <div class="products">
@if (isset($featuredProducts) && count($featuredProducts) > 0)
    <?php $i = 0 ;?>
    @foreach ($featuredProducts as $item)
        @if ($i % 4 == 0)
        <div class="row">
        @endif 
        <?php $i++ ;?>         
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                <div class="item">
                    <div class="thumb">
                        <a target="_blank" href="{{ url($item->id . '-' . $item->slug . '') }}" title="{{ $item->name }}">
                        @if (isset($item->mainImage()->image))
                        <img src="{{ MyHtml::showImage($item->mainImage()->image, 'product') }}" alt="{{ $item->name }}">
                        @endif
                        <span class="overlay"></span>
                        </a>
                    </div>
                    <div class="caption">
                        <h3 class="title">
                            <a target="_blank" href="{{ url($item->id . '-' . $item->slug . '') }}" title="{{ $item->name }}">{{ $item->name }}</a>
                        </h3>
                        <p class="meta">
                        <span class="price">
                        @if ($item->price > 0)
                        {{ number_format($item->price) }}đ
                        @else 
                            Liên hệ
                        @endif
                        </span>
                        @if ($item->is_hot == 1)
                        <i class="i-hot"></i>
                        @endif
                        <span class="count">{{ number_format($item->total_views) }}</span></p>
                    </div>
                </div>
            </div>
        @if($i % 4 == 0 || $i == count($featuredProducts))
        </div>
        @endif
    @endforeach
@endif
    </div>
    <div class="button">
        <a class="button-1" href="{{ url('san-pham-moi.html') }}" title="Sản phẩm mới">Xem tất cả<span><i class="fa fa-angle-right"></i></span></a>
    </div>    
</div>

@foreach ($categoryProducts as $category)
<div class="fproduct-home product-group clearfix">
    <h2 class="title-row"><span>{{ $category->name }}</span></h2>
    <div class="products">
    @if ($category->items)
        <?php $i = 0 ;?>
        @foreach ($category->items as $item)
        @if ($i % 4 == 0)
        <div class="row">
        @endif 
        <?php $i++ ;?>
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
            <div class="item">
                <div class="thumb">
                    <a target="_blank" href="{{ url($item->id . '-' . $item->slug) }}" title="{{ $item->name }}">
                    @if (isset($item->mainImage()->image))
                    <img src="{{ MyHtml::showImage($item->mainImage()->image, 'product') }}" alt="{{ $item->name }}">
                    @endif
                    <span class="overlay"></span>
                    </a>
                </div>
                <div class="caption">
                    <h3 class="title">
                        <a target="_blank" href="{{ url($item->id . '-' . $item->slug) }}" title="{{ $item->name }}">{{ $item->name }}</a>
                    </h3>
                    <p class="meta">
                        <span class="price">
                        @if ($item->price > 0)
                        {{ number_format($item->price) }}đ
                        @else 
                            Liên hệ
                        @endif
                        </span>                    
                    @if ($item->is_hot == 1)
                    <i class="i-hot"></i>
                    @endif                    
                    <span class="count">{{ number_format($item->total_views) }}</span></p>
                </div>
            </div>
        </div>
        @if($i % 4 == 0 || $i == count($category->items))
        </div>
        @endif        
        @endforeach
    @endif
    </div>
    <div class="button">
        <a class="button-1" href="{{ url($category->slug . '.html') }}" title="{{ $category->name }}">Xem tất cả<span><i class="fa fa-angle-right"></i></span></a>
    </div>
</div>    
@endforeach
<!--product-group-->
<ul class="footer-nav">
    @if (!empty($cateParents))
    @foreach($cateParents as $item)
    <li class="cate-parent-1" >
        <a href="/{{$item->slug}}.html" title="{{$item->name}}">
        <span>{{$item->name}}</span>
        </a>
        @if (!$item->children()->get()->isEmpty())
        <ul class="list-cate-2">
            @foreach ($item->children()->get() as $child)
            <li class="cate-parent-2">
                <strong><a href="/{{$child->slug}}.html"><span class="cate-parent-2">{{$child->name}}</span></a></strong>
                @if (!$child->children()->get()->isEmpty())
                <ul class="list-cate-3">
                    @foreach ($child->children()->get() as $son)
                    <li class="cate-parent-3"><a href="/{{$son->slug}}.html">{{$son->name}}</a></li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
        @endif
    </li>
    @endforeach
    @endif
</ul>
<!-- end menu -->
<div class="box-web-description footer box-footer">
    <h2 class="title-row"><span>
        @if (isset($home_seo_title))
            {!! $home_seo_title !!}
        @endif        
    </span></h2>
    <div class="description">
        @if (isset($home_seo_content))
            {!! $home_seo_content !!}
        @endif
    </div>
</div>

<div class="box-new-news footer box-footer">
    <h2 class="title-row"><span>Xu hướng và mặc đẹp</span></h2>
    <div class="list-news-new row">
        @forelse($lastnews as $item)
        <div class="news-item">
            <div class="thumb">
                <a href="{{ url('tin-tuc/' . $item->id . '-' .$item->slug . '.htm') }}" title="{{$item->title}}">
                <img src="{{ \App\Helpers\MyHtml::showThumb($item->image, 'blog', 'medium') }}" alt="{{$item->title}}" title="{{$item->title}}" />
                <span class="overlay"></span>
                </a>
            </div>
            <div class="caption">
                <a href="{{ url('tin-tuc/' . $item->id . '-' .$item->slug . '.htm') }}" title="{{$item->title}}" target="_blank" class="">{{$item->title}}</a>
            </div>
        </div>
        @empty
        @endforelse
    </div>
</div>
<!-- end menu -->
</div>
<!--container-->    
</div>
@stop