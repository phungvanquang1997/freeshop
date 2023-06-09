@extends('admin.layouts.boxed')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.categories')}}
            <small>{{trans('lang.add_new')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li><a href="{{ url('admin/product-category') }}">{{trans('lang.list')}}</a></li>
            <li class="active"><a href="#">{{trans('lang.add_new')}}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">

            <!-- Form Open -->
            {!! \Form::open(array_merge(['url' => 'admin/category/product'], ['class' => 'form-horizontal'])) !!}

            <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">

                    <li class="active"><a href="#tab_1" data-toggle="tab">{{ trans('lang.general_infos') }}</a></li>
                    <li class="pull-right">
                        {!! App\Helpers\MyHtml::submit( '' . trans('lang.add_new'), ['class' => 'btn btn-primary']) !!}
                    </li>

                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="tab_1">
                        @include('admin.pages.product_category._form')
                    </div>

                </div>

            </div>

            <!-- Form Close -->
            {!! \Form::close() !!}

        </div>
    </div>
@stop

