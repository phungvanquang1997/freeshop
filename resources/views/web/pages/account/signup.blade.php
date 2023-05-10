@extends('web.layouts.main')

@section('title')
    {{ trans('lang.login') }}
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
            <span class="navigation_page">{{trans('lang.login')}}</span>                   
        </div>
    </div>
    -->
    <div class="columns-container">
        <div class="container" id="columns">
            <!--
            <h2 class="page-heading">
                <span class="page-heading-title2">{{trans('lang.register')}}</span>
            </h2>-->
            <div class="page-content">
                <!--
                <div class="col-sm-12 col-xs-12">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ trans('lang.' . $error) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                -->
                <div class="row bg-authentication">
                    <div class="col-sm-4 border-gray-right">
                        <div class="box-authentication">
                            <h3><span>{{trans('lang.login')}}</span></h3>
                            <form class="login-form width100" role="form" method="POST" action="{{ url('/tai-khoan/dang-nhap.html') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="field-name" for="email">{{trans('lang.email')}} <span class="req">*</span></label>
                                    <input type="email" class="form-control" name="p_email" value="{{ old('p_email') }}" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label class="field-name" for="password">{{trans('lang.password')}} <span class="req">*</span></label>
                                    <input type="password" class="form-control" name="p_password" placeholder="">
                                </div>
                                <div class="form-group">
                                    <div class="remember alignleft checkbox">
                                        <input type="checkbox" name="remember" id="remember-signed-in">
                                        <p for="remember-signed-in">{{ trans('lang.remember_me') }}</p>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <button type="submit" class="btn btn-default"><i class="fa fa-lock"></i> {{ trans('lang.login') }}</button>
                                    <p class="forget-text"> Quên mật khẩu, 
                                    <a class="no-padding forgot-link" href="{{ url('/password/email') }}">Click vào đây</a>
                                    </p>
                                </div>

                            </form>
                        </div>
                        <div class="auth-sociallogin">
                            <p class="title">Đăng nhập bằng tài khoản mạng xã hội</p>
                            <ul>
                                <li><a class="btn-s-1 janrainEngage" href="{{url('/facebook/auth')}}" title="">Tài khoản Facebook</a></li>
                                <li><a class="btn-s-2 janrainEngage" href="{{url('/facebook/login')}}" title="">Tài khoản Google</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="box-authentication">
                            <h3><span>{{trans('lang.create_new_account')}}</span></h3>
                            <form class="register-form" role="form" method="POST" action="{{ url('/auth/register') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="field-name" for="email">{{trans('lang.email')}} <span class="req">*</span></label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="field-name" for="password">{{trans('lang.password')}} <span class="req">*</span></label>
                                            <input type="password" class="form-control" name="password" value="{{ old('email') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="field-name" for="password_confirmation">{{trans('lang.password_confirm')}} <span class="req">*</span></label>
                                            <input type="password" class="form-control" name="password_confirmation" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="field-name" for="name">{{trans('lang.full_name')}}  <span class="req">*</span></label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="field-name" for="phone">{{trans('lang.phone')}} <span class="req">*</span></label>
                                            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="field-name" for="address">{{trans('lang.address')}} <span class="req">*</span></label>
                                            <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                        <div class="remember alignleft checkbox">
                                            <input type="checkbox" name="inlaw" id="remember-signed-in" value="1" @if (old('remember') == '1') checked="checked" @endif>
                                            <p for="remember-signed-in">Tôi đã xem và đồng ý với <a href="#">Quy định</a> của Áo giá sỉ</p>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-user"></i> {{ trans('lang.register') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@section('front-footer-content')

@stop