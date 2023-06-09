@extends('admin.layouts.boxed')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/amazingslider-1.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/iCheck/all.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/jquery.Jcrop.min.css') }}"/>
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{ $product->name }}
            <small>cập nhật</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> Home</a></li>
            <li><a href="{{ url('admin/product') }}">Danh sách</a></li>
            <li class="active"><a href="#">{{ $product->name }}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">

            <!-- Form Open -->
            {!! \Form::open(array_merge(['url' => 'admin/product/' . $product->id, 'method' => 'PUT', 'files' => true], ['class' => 'form-horizontal'])) !!}

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">                    
                    <li class="@if (app('request')->input('tab') != 'img') active @endif"><a href="#tab_1" data-toggle="tab">{{ trans('lang.general_infos') }}</a></li>
                    <li class="@if (app('request')->input('tab') == 'img') active @endif"><a href="#tab_2" data-toggle="tab">Hình ảnh</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Sản phẩm gợi ý</a></li>
                    <li class="pull-right">
                        {!! App\Helpers\MyHtml::submit(trans('lang.submit_update'), ['class' => 'btn btn-primary']) !!}
                    </li>

                </ul>

                <div class="tab-content">

                    <div class="tab-pane @if (app('request')->input('tab') != 'img') active @endif" id="tab_1">

                        @include('admin.pages.product._form', ['product' => $product])

                    </div>

                    <div class="tab-pane @if (app('request')->input('tab') == 'img') active @endif" id="tab_2">

                        @include('admin.pages.product._image', ['product' => $product])

                    </div>
                    <div class="tab-pane" id="tab_3">
                        @include('admin.pages.product._form_related')
                    </div>
                </div>
            </div>

            <!-- Form Close -->
            {!! \Form::close() !!}

        </div>

    </div>
@stop

@section('footer-content')
    <script type="text/javascript" src="{{ asset('js/amazingslider.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/initslider-1.js') }}"></script>    
    <script type="text/javascript" src="{{ asset('js/jquery.Jcrop.min.js') }}"></script>
@stop