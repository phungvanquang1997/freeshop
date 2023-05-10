@extends('web.layouts.main')

@section('title')
    {{ $post->name }}
@stop

@section('body')
    {{ 'category-page' }}
@stop

@section('content')
    <!-- breadcrumb -->
    <!--
    <div class="breadcrumb clearfix">
        <div class="container">
        <a class="home" href="{{ url('/') }}"><i class="fa fa-home"></i> {{trans('lang.home')}}</a>
        <span class="navigation-pipe">&nbsp;</span>
        <span class="navigation_page">{{ isset($category) ? $category->name : '' }}</span>
        </div>
    </div>-->
    <!-- ./breadcrumb -->
    <div id="main" style="padding-top: 30px;">
        <div class="container" id="columns">
            <!-- row -->
            <div class="row">
                <!-- ./ Center colunm -->
                @include('web.pages.posts._sidebar_content')
                <!-- Center colunm-->
                <div class="col-lg-9 col-md-12">
                    <div class="list-news">
                        <div class="heading">
                            <div class="breadcrumb">
                                <ul>
                                    {!! \App\Helpers\MyHtml::generateBreadcrumb($category, 'tin-tuc') !!}
                                </ul>
                            </div>
                        </div>
                        <div class="news-detail" itemscope itemtype="http://schema.org/NewsArticle">
                            <div class="news-info">
                                <div class="news-title">
                                    <h1 itemprop="headline">{{ $post->title }}</h1>
                                </div>
                            </div>
                            <!--product-group-->
                            <div class="news-content">
                                {!! $post->content !!}
                            </div>
                        </div>
                        <!--product-group-->
                    </div>
                </div>
            </div>
            <!-- ./row-->
        </div>
    </div>
@stop

@section('front-footer-content')

@stop
