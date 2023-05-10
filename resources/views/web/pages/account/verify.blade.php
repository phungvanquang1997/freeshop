@extends('web.layouts.main')

@section('title')
    {{ 'Welcome | ' . Auth::user()->name }}
@stop

@section('body')
    {{ 'category-page' }}
@stop

@section('content')
    <div class="breadcrumb clearfix">
        <div class="container">
        <a class="home" href="/"><i class="fa fa-home"></i> Trang chủ</a>
        <span class="navigation-pipe">&nbsp;</span>
        <span class="navigation_page">{{ Auth::user()->name }}</span>
        </div>
    </div>
    <div class="columns-container">
        <div class="container" id="columns">

            <h2 class="page-heading">
                <span class="page-heading-title2">Kích hoạt thành viên mới</span>
            </h2>

            <div class="container account account-order">

                @include('web.pages.account._sidebar')

                <div class="col-sm-10 no-padding">
                    <div class="panel panel-success letter-welcome">
                        <div class="panel-body">
                            <p>Chào <strong>{{ isset($user->name) ? $user->name : 'bạn'}}</strong>,</p>
                            <p>Cảm ơn bạn đã sử dụng dịch vụ của Thiên Hà.</p>
                            <p>Tài khoản {{ $user->email }} của bạn đã được kích hoạt thành công.</p>
                            
                            <p>Mọi thắc mắc xin liên hệ với Chăm Sóc Khách Hàng của chúng tôi:</p>
                            <p>
                                @if (isset($support_phone))
                                    {{$support_phone}}
                                @endif
                            </p>
                            
                            <p>Thân mến!</p>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

@section('front-footer-content')
    <script type="text/javascript">
        $('.general').on('click', function() {
            var rowid = $(this).attr('rowid');

            $('.detail-' + rowid).fadeToggle('fast');
        });
    </script>
@stop