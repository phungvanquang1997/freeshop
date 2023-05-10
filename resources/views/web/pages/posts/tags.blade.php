@extends('web.layouts.main')

@section('title')
    @if (isset($category->name) && !is_null($category))
    {{ $category->name }}
    @else 
    Tin tức
    @endif
@stop

@section('body')
    {{ 'category-page' }}
@stop

@section('content')
    <!-- breadcrumb -->

    <!-- ./breadcrumb -->
    <div id="main" style="padding-top: 30px;">
        <div class="container" id="columns">
            <!-- row -->
            <div class="row">
                <!-- Center colunm-->
                <div class="col-lg-9 col-md-12">
                    <div class="list-news">
                    @if (isset($category->name) && !is_null($category))
                        <div class="heading">
                            <div class="breadcrumb">
                                <ul>
                                    {!! \App\Helpers\MyHtml::generateBreadcrumb($category, 'tin-tuc') !!}
                                </ul>
                            </div>
                        </div>
                    @else 
                    <div class="heading">
                        <div class="breadcrumb">
                            <ul>
                                <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="itemscope">
                                    <a href="{{ url('/') }}" title="Trang chủ"><span itemprop="title">Trang chủ</span></a>
                                </li>
                                <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="itemscope">
                                    <a href="{{ url('tin-tuc.html') }}" title="Tin tức"><span itemprop="title">Tin tức</span></a>
                                    @if (isset($categories) && count($categories) > 0)                                    
                                    <ul>
                                    	@foreach ($categories as $item)
                                        <li><a href="{{ url('tin-tuc/' . $item->slug) }}.html">{{$item->name}}</a></li>
                                        @endforeach
                                    </ul>
                                    @endif                          
                                </li>
                            </ul>
                        </div>
                    </div>                    
                    @endif
                        <div class="news-group clearfix">
                            <div class="news">
                                @foreach ($dataPosts as $dataPostsDetail)

                                    <div class="col-lg-12 col-md-12 news-item">
                                        <h3 class="title">
                                            <a href="{{ url('tin-tuc/' . $dataPostsDetail->id . '-' .$dataPostsDetail->slug . '.htm') }}" title="{!! $dataPostsDetail->title !!}">{{ $dataPostsDetail->title }}</a>
                                        </h3>
                                        <div class="thumb">
                                            <a href="{{ url('tin-tuc/' . $dataPostsDetail->id . '-' .$dataPostsDetail->slug . '.htm') }}" title="{!! $dataPostsDetail->title !!}">
                                                <img src="{{ \App\Helpers\MyHtml::showThumb($dataPostsDetail->image, 'blog', 'medium') }}" alt="{!! $dataPostsDetail->title !!}" title="{!! $dataPostsDetail->title !!}" />
                                                <span class="overlay"></span>
                                            </a>
                                        </div>
                                        <div class="content">
                                            <div class="description">
                                                {{ $dataPostsDetail->description }}
                                            </div>
                                            @if ($dataPostsDetail->tags!='')
                                            <?php 
                                                $i = 0;
                                                $keywords = @explode(',', $dataPostsDetail->tags);                            
                                            ?>
                                            <div class="tags">
                                                <strong>Tags: </strong>
                                                @foreach ($keywords as $keyword)
                                                <?php $i++;?>
                                                <a href="{{ url('tin-tuc' . '/tags/' . $postId . '-' .\Str::slug($keyword) . '.html') }}">{{$keyword}}</a>
                                                <?php if ($i < count($keywords)) echo ',' ;?>
                                                @endforeach
                                            </div>
                                            @endif                                             
                                        </div>
                                    </div>

                                @endforeach

                            </div>
                            <div class="paging">
                                <ul class="pagination">                                    
                                    {!! with(new App\ArticleTagsPaginationLinks($dataPosts))->render() !!}
                                </ul>
                            </div>
                        </div>
                        <!--product-group-->
                    </div>
                </div>
                <!-- ./ Center colunm -->
                @include('web.pages.posts._sidebar')
            </div>
            <!-- ./row-->
        </div>
    </div>
@stop

@section('front-footer-content')

@stop
