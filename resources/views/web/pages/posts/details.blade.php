@extends('web.layouts.main')

@section('title')
    {{ $dataPost->title }}
@stop

@section('body')
    {{ 'category-page' }}
@stop

@section('content')
    <div id="main" style="padding-top: 30px;">
        <div class="container" id="columns">
            <!-- row -->            
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="heading">
                        <div class="breadcrumb">
                            <ul>
                                <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="itemscope">
                                    <a href="{{ url('/') }}" title="Trang chủ"><span itemprop="title">Trang chủ</span></a>
                                </li>
                                <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="itemscope">
                                    <a href="{{ url('tin-tuc.html') }}" title="Tin tức"><span itemprop="title">Tin tức</span></a>                       
                                </li>
                                <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="itemscope">
                                    <a href="{{ url('tin-tuc' . '/' . $category->slug . '.html') }}" title="Tin tức"><span itemprop="title">{{ $category->name}}</span></a>                       
                                </li>                                
                            </ul>
                        </div>
                    </div>
                    <div class="news-detail" itemscope itemtype="http://schema.org/NewsArticle">
                        <div class="news-info">
                            <div class="news-title">
                                <h1 itemprop="headline">{{ $dataPost->title }}</h1>
                            </div>
                            <div class="extra-info">
                                <span class="news-updated-date">{{ date("d/m/Y", strtotime($dataPost->created_at)) }}</span>
                            </div>
                        </div>
                        <div class="news-description" itemprop="description">
                            {!! $dataPost->description !!}
                        </div>
                        <!--product-group-->
                        <div class="news-content">
                            {!! $dataPost->content !!}
                        </div>
                        @if ($dataPost->tags!='')
                        <?php 
                            $i = 0;
                            $keywords = @explode(',', $dataPost->tags);                            
                        ?>
                        <div class="tags">
                            <strong>Tags: </strong>
                            @foreach ($keywords as $keyword)
                            <?php $i++;?>
                            <a href="{{ url('tin-tuc' . '/tags/' . $dataPost->id . '-' . \Str::slug($keyword) . '.html') }}">{{$keyword}}</a>
                            <?php if ($i < count($keywords)) echo ',' ;?>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @include('web.pages.posts._sidebar')
            </div>

        </div>
    </div>
@stop