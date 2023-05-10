@extends('admin.layouts.boxed')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.news')}}
            <small>{{trans('lang.add_new')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li><a href="{{ url('admin/page') }}">{{trans('lang.list')}}</a></li>
            <li class="active"><a href="#">{{trans('lang.add_new')}}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">

        <div class="box-body">

            <form method="POST" action="{{ url('admin/page') }}" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                @method('POST')
            <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">

                    <li class="active"><a href="#tab_1" data-toggle="tab">{{ trans('lang.general_infos') }}</a></li>
                    <li class="pull-right">
                        {!! App\Helpers\MyHtml::submit(trans('lang.add_new'), ['class' => 'btn btn-primary']) !!}
                    </li>

                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="tab_1">
                        @include('admin.pages.pages._form')
                    </div>

                </div>

            </div>

            </form>

        </div>

    </div>
@stop

