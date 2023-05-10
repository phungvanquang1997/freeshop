@extends('web.layouts.main')

@section('title')
    {{ trans('lang.account') . Auth::user()->name }}
@stop

@section('body')
    {{ 'category-page' }}
@stop

@section('content')
    <!--
    <div class="breadcrumb clearfix account">
        <div class="container">
        <a class="home" href="/"><i class="fa fa-home"></i> {{trans('lang.home')}}</a>
        <span class="navigation-pipe">&nbsp;</span>
        <span class="navigation_page">{{trans('lang.account')}}</span>
        </div>
    </div>-->
    <div class="container page-account">
        <div class="" id="columns">
            <h2 class="page-heading">
                <span class="page-heading-title2">{{trans('lang.change_password')}}</span>
            </h2>

            <div class="account account-dashboard">
                <div class="row">
                    @include('web.pages.account._sidebar')

                    <div class="col-sm-9">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="password-form row">
                            
                                    {!! Form::open(['method' => 'post', 'url' => 'account/post-password']) !!}

                                    @if ($errors->any())
                                        <div class="row">
                                            <div class="col-sm-7 col-sm-offset-2 alert alert-danger alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-sm-3"></div>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        {!! App\Helpers\MyHtml::label('current_password', trans('lang.current_password'), true) !!}
                                        {!! App\Helpers\MyHtml::input('password', 'current_password', old('current_password') ? old('current_password') : null, ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! App\Helpers\MyHtml::label('password', trans('lang.new_password'), true) !!}
                                        {!! App\Helpers\MyHtml::input('password', 'password', old('password') ? old('password') : null, ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! App\Helpers\MyHtml::label('password_confirmation', trans('lang.password_confirm'), true) !!}
                                        {!! App\Helpers\MyHtml::input('password', 'password_confirmation', old('password_confirmation') ? old('password_confirmation') : null, ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-7 col-sm-offset-3">
                                        <button type="submit" class="btn btn-kute btn-kute-lg btn-primary update-account">{{trans('lang.update')}}</button>
                                        </div>
                                    </div>

                                    {!! Form::close() !!}

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


@stop

@section('front-footer-content')

@stop
