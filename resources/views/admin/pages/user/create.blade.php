@extends('admin.layouts.boxed')

@section('head')
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.users')}}
            <small>{{trans('lang.register')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li class="active"><a href="{{ url('admin/user') }}">{{trans('lang.list')}}</a></li>
            <li class="active"><a href="">{{trans('lang.register')}}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">

            <!-- Form Open -->
            {!! \Form::open(['method' => 'POST', 'url' => 'admin/auth/register', 'class' => 'form-horizontal']) !!}

            <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">

                    <li class="active"><a href="#tab_1" data-toggle="tab">{{ trans('lang.admin_infos') }}</a></li>
                    <li class="pull-right">
                        {!! App\Helpers\MyHtml::submit(trans('lang.register'), ['class' => 'btn btn-primary']) !!}
                    </li>

                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="tab_1">
                        @include('admin.pages.user._form')
                    </div>

                </div>

            </div>

            <!-- Form Close -->
            {!! \Form::close() !!}

        </div>
    </div>
@stop
