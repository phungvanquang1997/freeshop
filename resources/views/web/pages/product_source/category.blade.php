@extends('kute.layouts.main')

@section('body')
    {{ 'category-page' }}
@stop

@section('title')
    {{ $category->name }}
@stop

@section('content')
    <div class="breadcrumb clearfix">
        <div class="container">
        <a class="home" href="/"><i class="fa fa-home"></i> Trang chủ</a>
        <span class="navigation-pipe">&nbsp;</span>
        <span class="navigation_page">{{ $category->name }}</span>                      
        </div>              
    </div>
    <div class="columns-container">
        <div class="container" id="columns">
            @if ($children->count())
            <div class="source-children">
                <ul>
                    @forelse ($children as $child)
                        <li><a href="{{ url('nguon-hang-tot/' . $child->id) }}">{{ $child->name}} <span class="badge">{{ $child->source_count }}</span></a></li>
                    @empty
                    @endforelse
                </ul>
            </div>
            @endif
            <div class="product-source-box">
                <div class="tb-product-sources">
                    <div class="col-sm-12 source-brand">
                        <h2><span><small>Nguồn hàng tốt</small> Taobao.com</span></h2>
                    </div>
                    <div class="tb-source-list">
                        <div class="row-fluid">
                        @forelse ($taobaoSources as $item)
                            <div class="col-md-2 col-sm-3">
                                <div class="source-item">
                                    <div class="img-box">
                                        <a href="{{ $item->link }}" target="_blank" title="Xem chi tiết trên taomao.com"><img src="{{ MyHtml::showThumb($item->image, 'brand', 'thumb') }}"></a>
                                    </div>
                                    <h4><a href="{{ $item->link }}" target="_blank" title="Xem chi tiết trên taomao.com">{{ $item->name }}</a></h4>
                                </div>
                            </div>
                        @empty
                            <div class="col-sm-12">Nguồn hàng chưa cập nhật!</div>
                        @endforelse
                        </div>
                    </div>
                    
                </div>

                <div class="tb-product-sources">
                    <div class="col-sm-12 source-brand">
                        <h2><span><small>Nguồn hàng tốt</small> Tmall.com</span></h2>
                    </div>
                    <div class="tb-source-list">
                        <div class="row-fluid">
                        @forelse ($tmallSources as $item)
                            <div class="col-md-2 col-sm-3">
                                <div class="source-item">
                                    <div class="img-box">
                                        <a href="{{ $item->link }}" target="_blank" title="Xem chi tiết trên taomao.com"><img src="{{ MyHtml::showThumb($item->image, 'brand', 'thumb') }}"></a>
                                    </div>
                                    <h4><a href="{{ $item->link }}" target="_blank" title="Xem chi tiết trên taomao.com">{{ $item->name }}</a></h4>
                                </div>
                            </div>
                        @empty
                            <div class="col-sm-12">Nguồn hàng chưa cập nhật!</div>
                        @endforelse
                        </div>
                    </div>
                    
                </div>

                <div class="tb-product-sources">
                    <div class="col-sm-12 source-brand">
                        <h2><span><small>Nguồn hàng tốt</small> 1688.com</span></h2>
                    </div>
                    <div class="tb-source-list">
                        <div class="row-fluid">
                        @forelse ($s1688Sources as $item)
                            <div class="col-md-2 col-sm-3">
                                <div class="source-item">
                                    <div class="img-box">
                                        <a href="{{ $item->link }}" target="_blank" title="Xem chi tiết trên taomao.com"><img src="{{ MyHtml::showThumb($item->image, 'brand', 'thumb') }}"></a>
                                    </div>
                                    <h4><a href="{{ $item->link }}" target="_blank" title="Xem chi tiết trên taomao.com">{{ $item->name }}</a></h4>
                                </div>
                            </div>
                        @empty
                            <div class="col-sm-12">Nguồn hàng chưa cập nhật!</div>
                        @endforelse
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@stop

@section('front-footer-content')
    <script type="text/javascript">
        $(document).ready(function() {
        });
    </script>
@stop

