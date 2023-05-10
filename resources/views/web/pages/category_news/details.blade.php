@extends('web.layouts.main')

@section('content')

<div id="main">
    <div class="container">
        <div class="col-lg-9 col-md-12">
            <div class="heading">
                <div class="breadcrumb">
                    <ul>
                        <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="itemscope">
                            <a href="http://www.remoingay.com" title="Trang chủ"><span itemprop="title">Trang chủ</span></a>
                        </li>
                        <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="itemscope">
                            <a href="http://www.remoingay.com/tin-tuc.html" title="Tin tức" itemprop="url">
                                <span itemprop="title">Tin tức</span>
                            </a>
                        </li>
                        <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="itemscope">
                            <a href="http://www.remoingay.com/tin-tuc/tin-tuc.html" title="Tin tức" itemprop="url">
                                <span itemprop="title">Tin tức</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="news-detail" itemscope itemtype="http://schema.org/NewsArticle">
                        <div class="news-info">
                            <div class="news-title">
                                <h1 itemprop="headline">{{ $dataPost->title }}</h1>
                            </div>
                            <div class="extra-info">
                                <span class="news-updated-date">{{ date("Y-m-d") }}</span>
                            </div>
                        </div>
                        <div class="news-description" itemprop="description">
                            {{ $dataPost->description }}
                        </div>
                        <ul class="list-news-new">
                            @foreach ($dataRelative as $dataRelativeDetail)
                                <li>
                                    <a href="{{ $dataPost->slug }}">{{ $dataPost->title }}</a>
                                </li>
                            @endforeach

                        </ul>
                        <!--product-group-->
                        <div class="news-content">
                            {{ $dataPost->content }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 visible-lg-block">
            <div class="hot-news sidebar">
                <h2 class="title">Xem nhiều</h2>
                <div class="list-hot-news clearfix">

                    @foreach ($dataPostMostView as $dataPostMostViewDetail)
                        <div class="news-item">
                            <div class="thumb">
                                <a href="{{ $dataPostMostViewDetail->slug }}" title="{{ $dataPostMostViewDetail->title }}">
                                    <img src="{{ url($dataPostMostViewDetail->image) }}"  alt="{{ $dataPostMostViewDetail->title }}" />
                                    <span class="overlay"></span>
                                </a>
                            </div>
                            <div class="caption">
                                <h3 class="title">
                                    <a href="{{ $dataPostMostViewDetail->slug }}" title="{{ $dataPostMostViewDetail->title }}" target="_blank">{{ $dataPostMostViewDetail->title }}</a>
                                </h3>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <ul class="footer-nav">
            <li class="cate-parent-1" >
                <a href="http://www.remoingay.com/thoi-trang-nu.html" title="Thời trang nữ">
                    <span>Thời trang nữ</span>
                </a>
                <ul class="list-cate-2">
                    <li class="cate-parent-2">
                        <strong><a href="http://www.remoingay.com/dam-thoi-trang.html"><span class="cate-parent-2">Đầm</span></a></strong>
                        <ul class="list-cate-3">
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/dam-da-tiec.html">Đầm dạ tiệc</a></li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/dam-dao-pho.html">Đầm dạo phố</a></li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/dam-cong-so.html">Đầm công sở</a></li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/dam-maxi.html">Đầm maxi
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/dam-ren.html">Đầm ren
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/dam-xoe.html">Đầm xoè
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/dam-body.html">Đầm body
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/dam-suong.html">Đầm suông
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/dam-yem.html">Đầm yếm</a></li>
                        </ul>
                    </li>
                    <li class="cate-parent-2">
                        <strong><a href="http://www.remoingay.com/ao-nu.html"><span class="cate-parent-2">Áo nữ</span></a></strong>
                        <ul class="list-cate-3">
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/ao-thun-nu.html">Áo thun nữ</a></li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/ao-so-mi-nu.html">Áo sơ mi nữ</a></li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/ao-voan-nu.html">Áo voan nữ</a></li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/ao-kieu-nu.html">Áo kiểu nữ</a></li>
                        </ul>
                    </li>
                    <li class="cate-parent-2">
                        <strong><a href="http://www.remoingay.com/ao-khoac-nu.html"><span class="cate-parent-2">Áo Khoác Nữ</span></a></strong>
                        <ul class="list-cate-3">
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/ao-vest-nu.html">Áo vest nữ</a></li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/ao-khoac-manto-nu.html">Áo khoác Manto nữ
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/ao-khoac-ni-nu.html">Áo khoác nỉ nữ
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/ao-khoac-da-nu.html">Áo khoác da nữ
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/ao-khoac-phao-nu.html">Áo khoác phao nữ
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/ao-len-nu.html">Áo len nữ
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/ao-khoac-canh-doi-nu.html">Áo khoác cánh dơi nữ
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="cate-parent-2">
                        <strong><a href="http://www.remoingay.com/set-do-bo.html"><span class="cate-parent-2">Bộ đồ nữ</span></a></strong>
                        <ul class="list-cate-3">
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/do-the-thao-nu.html">Đồ thể thao nữ
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/do-mac-nha-nu.html">Đồ mặc nhà nữ
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/do-lot-nu.html">Đồ lót nữ
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/set-bo-cong-so-nu.html">Set bộ công sở nữ
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/set-bo-dao-pho-nu.html">Set bộ dạo phố nữ
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/set-bo-culottes-nu.html">Set bộ Culottes nữ
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/jumpsuit-nu.html">Jumpsuit nữ
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/bikini.html">Bikini</a></li>
                        </ul>
                    </li>
                    <li class="cate-parent-2">
                        <strong><a href="http://www.remoingay.com/quan-nu.html"><span class="cate-parent-2">Quần nữ</span></a></strong>
                        <ul class="list-cate-3">
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/quan-jean-nu.html">Quần Jean nữ</a></li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/quan-tay-nu.html">Quần Tây nữ</a></li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/quan-kaki-nu.html">Quần Kaki nữ</a></li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/quan-legging-nu.html">Quần Legging nữ</a></li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/quan-short-nu.html">Quần Short nữ</a></li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/quan-culottes-nu.html">Quần Culottes nữ</a></li>
                        </ul>
                    </li>
                    <li class="cate-parent-2">
                        <strong><a href="http://www.remoingay.com/vay.html"><span class="cate-parent-2">Chân Váy</span></a></strong>
                        <ul class="list-cate-3">
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/chan-vay-xoe.html">Chân Váy xoè
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/chan-vay-chu-a.html">Chân Váy chữ A
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/chan-vay-jean.html">Chân váy jean
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/chan-vay-ngan.html">Chân váy ngắn
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/chan-vay-but-chi.html">Chân Váy bút chì
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="cate-parent-2">
                        <strong><a href="http://www.remoingay.com/phu-kien-nu.html"><span class="cate-parent-2">Phụ kiện nữ</span></a></strong>
                        <ul class="list-cate-3">
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/dong-ho-trang-suc.html">Đồng hồ - Trang sức</a></li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/giay-dep-balo-tui-xach.html">Giày dép - Balô - Túi xách</a></li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/mu-non-nu.html">Mũ - Nón nữ
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/mat-kinh-nu.html">Mắt kính nữ
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/noi-y-vo.html">Nội y - Đồ Ngủ - Vớ</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="cate-parent-1" >
                <a href="http://www.remoingay.com/thoi-trang-nam.html" title="Thời trang nam">
                    <span>Thời trang nam</span>
                </a>
                <ul class="list-cate-2">
                    <li class="cate-parent-2">
                        <strong><a href="http://www.remoingay.com/ao-nam.html"><span class="cate-parent-2">Áo nam</span></a></strong>
                        <ul class="list-cate-3">
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/ao-so-mi-nam.html">Áo sơ mi nam</a></li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/ao-thun-nam.html">Áo thun nam</a></li>
                        </ul>
                    </li>
                    <li class="cate-parent-2">
                        <strong><a href="http://www.remoingay.com/ao-khoac-nam.html"><span class="cate-parent-2">Áo khoác nam</span></a></strong>
                        <ul class="list-cate-3">
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/ao-khoac-manto-nam.html">Áo khoác Manto nam
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/ao-khoac-da-nam.html">Áo khoác da nam
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/ao-khoac-phao-nam.html">Áo khoác phao nam
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="cate-parent-2">
                        <strong><a href="http://www.remoingay.com/phu-kien-nam.html"><span class="cate-parent-2">Phụ Kiện Nam</span></a></strong>
                        <ul class="list-cate-3">
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/giay-the-thao-nam.html">Giày thể thao nam
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/dong-ho-nam.html">Đồng hồ nam
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/giay-tay-nam.html">Giày Tây Nam
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/bop-vi-nam.html">Bóp Ví Nam
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/mat-kinh-nam.html">Mắt kính nam
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="cate-parent-2">
                        <strong><a href="http://www.remoingay.com/quan-nam.html"><span class="cate-parent-2">Quần nam</span></a></strong>
                        <ul class="list-cate-3">
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/quan-jean-nam.html">Quần jean nam
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/quan-tay-nam.html">Quần tây nam
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/quan-kaki-nam.html">Quần kaki nam
                                </a>
                            </li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/quan-short-nam.html">Quần short nam
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="cate-parent-2">
                        <strong><a href="http://www.remoingay.com/bo-do-nam.html"><span class="cate-parent-2">Bộ đồ nam</span></a></strong>
                        <ul class="list-cate-3">
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/bo-do-the-thao-nam.html">Bộ đồ thể thao nam</a></li>
                            <li class="cate-parent-3"><a href="http://www.remoingay.com/bo-do-mac-nha-nam.html">Bộ đồ mặc nhà nam
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="cate-parent-2"><strong><a href="http://www.remoingay.com/do-doi-nam.html"><span class="cate-parent-2">Đồ đôi 2017</span></a></strong>
                </ul>
            </li>
            <li class="cate-parent-1" style="width:25%;">
                <a href="http://www.remoingay.com/me-va-be.html" title="Mẹ và bé">
                    <span>Mẹ và bé</span>
                </a>
                <ul class="list-cate-2"></ul>
            </li>
            <li class="cate-parent-1" style="width:25%;">
                <a href="http://www.remoingay.com/thoi-trang-hot-girl.html" title="THỜI TRANG HOTGIRL">
                    <span>THỜI TRANG HOTGIRL</span>
                </a>
                <ul class="list-cate-2"></ul>
            </li>
            <li class="cate-parent-1" style="width:25%;">
                <a href="http://www.remoingay.com/c-a-t.html" title="C.A.T">
                    <span>C.A.T</span>
                </a>
                <ul class="list-cate-2"></ul>
            </li>
            <li class="cate-parent-1" style="width:25%;">
                <a href="http://www.remoingay.com/deal-hot.html" title="Deal hot">
                    <span>Deal hot</span>
                </a>
                <ul class="list-cate-2"></ul>
            </li>
        </ul>
        <!-- end menu -->
    </div>
    <!--container-->
</div>
<!--main-->
@stop