@extends('admin.layouts.boxed')

@section('head')
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.users')}}
            <small>{{trans('lang.user_amount')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li><a href="{{ url('admin/user') }}">{{trans('lang.list')}}</a></li>
            <li><a href="{{ url('admin/user/' . $user->id) }}">{{ $user->name }}</a></li>
            <li class="active">{{trans('lang.user_amount')}}</li>

        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            <!-- Form Open -->
            {!! \Form::open(['method' => 'PUT', 'url' => 'admin/user/put-recharge/' . $user->id, 'class' => 'form-horizontal']) !!}

            <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">

                    <li class="active"><a href="#tab_1" data-toggle="tab">{{trans('lang.change_amount')}} - {{ $user->name }}</a></li>
                    <li class="pull-right">
                        {!! App\Helpers\MyHtml::submit(trans('lang.submit'), ['class' => 'btn btn-primary']) !!}
                    </li>

                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="tab_1">
                        @include('admin.pages.user._form_recharge', ['user' => $user])
                    </div>

                </div>

            </div>

            <!-- Form Close -->
            {!! \Form::close() !!}

        </div>
    </div>
@stop
