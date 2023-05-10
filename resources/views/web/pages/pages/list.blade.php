@extends('web.layouts.main')

@section('title')
    {{ $category->name }}
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
                        <div class="news-group clearfix">
                            <div class="row news">
                                @foreach ($dataPosts as $dataPostsDetail)

                                    <div class="col-lg-12 col-md-12 news-item">
                                        <h3 class="title">
                                            <a href="{{ $dataPostsDetail->slug }}" title="{{ $dataPostsDetail->title }}">{{ $dataPostsDetail->title }}</a>
                                        </h3>
                                        <div class="thumb">
                                            <a href="{{ \App\Helpers\MyHtml::showThumb($dataPostsDetail->image, 'blog', 'medium') }}" title="{{ $dataPostsDetail->title }}">
                                                <img src="{{ \App\Helpers\MyHtml::showThumb($dataPostsDetail->image, 'blog', 'medium') }}" alt="{{ $dataPostsDetail->title }}" title="{{ $dataPostsDetail->title }}" />
                                                <span class="overlay"></span>
                                            </a>
                                        </div>
                                        <div class="content">
                                            <div class="description">
                                                {{ $dataPostsDetail->description }}
                                            </div>
                                        </div>
                                    </div>

                                @endforeach

                            </div>
                            <div class="paging">
                                <ul class="pagination">
                                    {!!  $dataPosts->render() !!}
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
