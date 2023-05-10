@extends('web.layouts.main')

@section('title')
    {{ 'Lấy lại mật khẩu' }}
@stop

@section('body')
    {{ 'category-page' }}
@stop

@section('content')
    <!--
    <div class="breadcrumb clearfix">
        <div class="container">
        <a class="home" href="/"><i class="fa fa-home"></i> {{trans('lang.home')}}</a>
        <span class="navigation-pipe">&nbsp;</span>
        <span class="navigation_page">{{trans('lang.fogot_password')}}</span>                    
        </div>
    </div>-->
    <div class="columns-container forget-password">
        <div class="container" id="columns">
            <h2 class="page-heading">
                <span class="page-heading-title2">{{trans('lang.fogot_password')}}</span>
            </h2>
            <div class="page-content">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Có lỗi xảy ra.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label class="col-md-4 control-label">{{trans('lang.email')}}</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                {{trans('lang.submit')}}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop
