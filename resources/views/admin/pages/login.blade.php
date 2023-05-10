@extends('admin.layouts.auth')

@section('content')
    <div class="login-box-body">
        <p class="login-box-msg">Đăng nhập</p>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form role="form" method="POST" action="{{ url('/admin/auth/login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Địa chỉ Email">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> Nhớ mật khẩu
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
                </div>
            </div>

        </form>

    </div>
    <!-- /.login-box-body -->
@stop