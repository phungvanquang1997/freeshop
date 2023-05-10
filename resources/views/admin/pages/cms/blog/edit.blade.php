@extends('admin.layouts.boxed')

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.news')}}
            <small>{{trans('lang.update')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li><a href="{{ url('admin/article') }}">{{trans('lang.list')}}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">

        <div class="box-body">

            <!-- Form Open -->
            <form method="POST" action="{{ url('admin/article/' . $blog->id) }}" enctype="multipart/form-data" class="form-horizontal">
                @method('PUT')
                @csrf
                <div class="nav-tabs-custom">

                    <ul class="nav nav-tabs">

                        <li class="active"><a href="#tab_1" data-toggle="tab">{{ trans('lang.general_infos') }}</a></li>
                        <li class="pull-right">
                            {!! App\Helpers\MyHtml::submit(trans('lang.update'), ['class' => 'btn btn-primary']) !!}
                        </li>

                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane active" id="tab_1">
                            @include('admin.pages.cms.blog._form', ['blog' => $blog])
                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>
@stop

