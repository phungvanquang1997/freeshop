@extends('web.layouts.main')

@section('title')
    {{ $page->title }}
@stop

@section('body')
    {{ 'category-page' }}
@stop

@section('content')

    <div id="main" style="padding-top: 30px;">
<div class="container">
    
<div class="col-lg-3 col-md-4 col-xs-12 m-clear">
    <div class="about-menu">
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <span>{{ $page->title }} </span>
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                @if (isset($pages) && count($pages) > 0)
                @foreach ($pages as $item)
                    @if ($item->id == $page->id)
                    <li><a href="{{ url ($item->slug . '.htm') }}"><strong>{{ $item->title }}</strong></a></li>
                    @else
                    <li><a href="{{ url ($item->slug . '.htm') }}">{{ $item->title }}</a></li>
                    @endif
                @endforeach
                @endif
                <li><a href="/lien-he.html">Liên hệ với Áo Giá Rỉ</a></li>
                <li><a href="/hop-tac-kinh-doanh.html">Hợp tác kinh doanh với Áo Giá Sỉ</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="col-lg-9 col-md-8 col-xs-12 m-clear">
    <div class="editor txtabout">
        <h1 class="page-title"><span><h1>{{ $page->title }}</h1></span></h1>
        
            <div class="content-other docs">
                {!! $page->content !!}
            </div>

            </div>
</div>
<div class="bottom-line"></div></div>
    </div>
@stop