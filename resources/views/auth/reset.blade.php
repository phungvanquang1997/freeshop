@extends('web.layouts.main')

@section('title')
    {{ 'Đặt lại mật khẩu' }}
@stop

@section('body')
    {{ 'category-page' }}
@stop

@section('content')
    <!--
    <div class="breadcrumb clearfix">
        <div class="container">
        <a class="home" href="/"><i class="fa fa-home"></i> Trang chủ</a>
        <span class="navigation-pipe">&nbsp;</span>
        <span class="navigation_page">Đặt lại mật khẩu</span>                    
        </div>
    </div>-->
    <div class="columns-container forget-password">
        <div class="container" id="columns">
            <h2 class="page-heading">
                <span class="page-heading-title2">Thay đổi mật khẩu</span>
            </h2>
            <div class="page-content">

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Có lỗi xảy ra, vui lòng nhập lại.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label class="col-md-4 control-label">E-Mail Address</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Mật khẩu</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Nhập lại mật khẩu</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Thay đổi mật khẩu
                            </button>
                        </div>
                    </div>
                </form>

			</div>
		</div>
	</div>
@stop
