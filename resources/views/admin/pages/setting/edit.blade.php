@extends('admin.layouts.boxed')

@section('head')
  <link href="{{ asset('css/switchery/switchery.css') }}" rel="stylesheet">
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.settings')}}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li class="active"><a href="">{{trans('lang.settings')}}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">

            <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">

                    <li class="{{ ((old('active') && old('active') == 1) || !old('active')) ? 'active' : '' }}"><a href="#tab_1" data-toggle="tab">Cài đặt chung</a></li>
                    <li class="{{ (old('active') && old('active') == 2) ? 'active' : '' }}"><a href="#tab_2" data-toggle="tab">SEO</a></li>
                    <li class="{{ (old('active') && old('active') == 3) ? 'active' : '' }}"><a href="#tab_3" data-toggle="tab">Email</a></li>
                </ul>

                <div class="tab-content">
                   
                    <div class="tab-pane {{ (old('active') && old('active') == 1) || !old('active') ? 'active' : '' }}" id="tab_1">
                        @include('admin.pages.setting._form_general')
                    </div>
                    <div class="tab-pane {{ (old('active') && old('active') == 2) ? 'active' : '' }}" id="tab_2">
                        @include('admin.pages.setting._form_seo')
                    </div>
                    <div class="tab-pane {{ (old('active') && old('active') == 3) ? 'active' : '' }}" id="tab_3">
                        @include('admin.pages.setting._form_email')
                    </div>
                </div>

            </div>
           
        </div>
    </div>
@stop
@section('footer-content')
    <script src="{{ asset('js/switchery/switchery.js') }}"></script>
@stop