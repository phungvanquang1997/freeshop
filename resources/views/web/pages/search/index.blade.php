@extends('web.layouts.main')

@section('title')
    Tìm kiếm
@stop

@section('content')
<div id="main" style="padding: 30px;">
    <div class="container">
        <div class="heading">
            <div class="breadcrumb">
                <ul>
                    <li><a href="#" title="">Tìm kiếm</a></li>
                    <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="itemscope">
                        <a href="{{ url('/tim-kiem?keyword=' . $keyword)}}" class="linkpage_current" title="{{ $keyword }}" itemprop="url">
                        <span itemprop="title">{{ $keyword }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="alert alert-success" role="alert">            
            <h3 style="margin: 0px;">Tìm thấy <b>{{ @count($products) }}</b> sản phẩm</h3>
        </div>
        <div class="product-group clearfix">
            <div class="row products">
                @if (isset($products) && count($products) > 0)
                    @foreach ($products as $product)
                        @include ('web.pages.product._single_product', ['product' => $product])
                    @endforeach
                @else

                @endif
            </div>

            @if (isset($products) && count($products) > 0)
            <div class="button">
                <div class="paging">
                    <ul class="pagination">
                        {!! with(new App\SearchPaginationLinks($products))->render() !!}
                    </ul>
                </div>
                @if ($products->currentPage() < $products->lastPage())
                <a class="button-1" href="{{ url('tim-kiem/' . $keyword)}}/trang-{{$currentPage+1}}.html" title="">Xem thêm sản phẩm<span><i class="fa fa-angle-right"></i></span></a>
                @endif
            </div>
            @endif
        </div>
        <!--product-group-->
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

