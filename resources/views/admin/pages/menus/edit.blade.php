@extends('admin.layouts.boxed')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.menus')}} : {{ $menu->name }}
            <small>{{trans('lang.update')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li class="active"><a href="{{ url('admin/menu') }}">{{trans('lang.list')}}</a></li>
            <li class="active"><a href="">{{trans('lang.update')}}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">

        <div class="box-body">

            <!-- Form Open -->
            <form method="POST" action="{{ url('admin/menu/' . $menu->id) }}" enctype="multipart/form-data" class="form-horizontal">
                @method('PUT')
                @csrf

                <div class="nav-tabs-custom">

                    <ul class="nav nav-tabs">

                        <li class="active"><a href="#tab_1" data-toggle="tab">{{trans('lang.general_infos')}}</a></li>
                        <li class="pull-right">
                            {!! App\Helpers\MyHtml::submit(trans('lang.update'), ['class' => 'btn btn-primary']) !!}
                        </li>

                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane active" id="tab_1">
                            @include('admin.pages.menus._form', ['menu' => $menu])
                        </div>

                    </div>

            </div>

            </form>

        </div>

    </div>
@stop

