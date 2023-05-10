@extends('admin.layouts.boxed')

@section('head')
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.menus')}}
            <small>{{trans('lang.create')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li class="active"><a href="{{ url('admin/menu') }}">{{trans('lang.list')}}</a></li>
            <li class="active"><a href="">{{trans('lang.create')}}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">

            <!-- Form Open -->
            <form method="POST" action="{{ url('admin/menu') }}" class="form-horizontal">
                @csrf
                @method('POST')
                <div class="nav-tabs-custom">

                    <ul class="nav nav-tabs">

                        <li class="active"><a href="#tab_1" data-toggle="tab">{{trans('lang.general_infos')}}</a></li>
                        <li class="pull-right">
                            {!! App\Helpers\MyHtml::submit(trans('lang.submit'), ['class' => 'btn btn-primary']) !!}
                        </li>

                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane active" id="tab_1">
                            @include('admin.pages.menus._form')
                        </div>

                    </div>

                </div>

            </form>

        </div>
    </div>
@stop
