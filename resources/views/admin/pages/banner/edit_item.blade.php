@extends('admin.layouts.boxed')
@section('breadcrumb')
    <section class="content-header">
        <h1>
            Quảng cáo : {{ $bannerItem->banner->name }}
            <small>{{trans('lang.update')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li class="active"><a href="{{ url('admin/banner') }}">{{trans('lang.list')}}</a></li>
            <li class="active"><a href="{{ url('admin/banner/' . $bannerItem->banner->id) }}">{{ $bannerItem->banner->name }}</a></li>
            <li class="active"><a href="">{{trans('lang.update')}}</a></li>
        </ol>
    </section>
@stop
@section('content')
    <div class="box">
        <div class="box-body">
            <!-- Form Open -->
            {!! Form::open(array_merge(['url' => 'admin/banner/item-update/' . $bannerItem->id, 'method' => 'PUT', 'files' => true],
            ['class' => 'form-horizontal'])) !!}
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">{{trans('lang.general_infos')}}</a></li>
                    <li class="pull-right">
                        {!! App\Helpers\MyHtml::submit(trans('lang.update'), ['class' => 'btn btn-primary']) !!}
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        @include('admin.pages.banner._form_item', ['menuItem' => $bannerItem])
                    </div>
                </div>
            </div>
            <!-- Form Close -->
            {!! Form::close() !!}
        </div>
    </div>
@stop

