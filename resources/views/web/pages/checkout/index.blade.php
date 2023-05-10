@extends('web.layouts.main')

@section('title')
    {{trans('lang.create_order')}}
@stop

@section('body')
    {{ 'category-page' }}
@stop

@section('content')
    <div class="breadcrumb clearfix">
        <div class="container">
        <a class="home" href="/"><i class="fa fa-home"></i> {{trans('lang.home')}}</a>
        <span class="navigation-pipe">&nbsp;</span>
        <span class="navigation_page">{{trans('lang.create_order')}}</span>                      
        </div>              
    </div>
    <div class="columns-container">
        <div class="container" id="columns">
            <h2 class="page-heading">
                <span class="page-heading-title2">{{trans('lang.create_order')}}</span>
            </h2>

            <div id="contact" class="page-content page-contact page-order-shipping">
                <!-- form open -->
                <form method="post" action="{{ url('checkout/create') }}" enctype="multipart/form-data">

                    <!-- token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- type -->
                    <input type="hidden" name="type" value="url">

                    <!-- user id -->
                    <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::user()->id : 0 }}">

                    <h3 class="page-subheading ship-title">Thông tin đặt hàng</h3>

                    <div id="step2-form" class="contact-form-box">

                        <div class="row">
                            <div class="form-selector col-sm-6 col-xs-12">
                                <label>Họ tên</label>
                                <input type="text" name="name" value="{{ Auth::check() ? Auth::user()->name : '' }}" class="form-control input-md" />
                            </div>
                            <div class="form-selector col-sm-6 col-xs-12">
                                <label>Email</label>
                                <input type="text" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" class="form-control input-md" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-selector col-sm-6 col-xs-12">
                                <label>Số ĐT</label>
                                <input type="text" name="phone" value="{{ Auth::check() ? Auth::user()->phone : '' }}" class="form-control input-md" />
                            </div>
                            <div class="form-selector col-sm-6 col-xs-12">
                                <label>Địa chỉ</label>
                                <input type="text" name="address" value="{{ Auth::check() ? Auth::user()->address : '' }}" class="form-control input-md" />
                            </div>
                        </div>

                        <div class="form-selector">
                            <label>Ghi chú</label>
                            <textarea name="note" class="form-control input-md" rows="10" id="note"></textarea>
                        </div>
                        <div class="form-selector alignright">
                            <a href="{{ url('cart') }}" class="btn btn-kute btn-kute-lg btn-previous btn-primary">Quay lại</a>
                            <button type="submit" class="btn btn-kute btn-kute-lg btn-primary">Tạo đơn hàng</button>
                        </div>
                    </div>

                    <!-- form close -->
                </form>
            </div>

        </div>
    </div>
@stop

@section('front-footer-content')

    <script type="text/javascript">

        $(document).ready(function () {

            // next step
            $('.page-order-shipping .btn-next').on('click', function () {

                var parent_fieldset = $(this).parents('fieldset');
                var next_step = true;
                var num_product = $('#number_product').val();

                for (var i = 1; i <= num_product; i++) {
                    var url = $('#row' + i).find("input[name='item[" + i + "][url]']");
                    if (url.val() == '') {
                        url.addClass('input-error');
                        next_step = false;
                    } else {
                        url.removeClass('input-error');
                    }
                }

                if (next_step) {
                    parent_fieldset.fadeOut(500, function () {
                        $(this).next().removeClass('hidden');
                        $(this).next().fadeIn();
                    });
                }

            });

            // submit
            $('.page-order-shipping').on('submit', function (e) {
                $(this).find('#step2-form input[type="text"]').each(function () {
                    if ($(this).val() == "") {
                        $(this).addClass('input-error');
                        e.preventDefault();
                    }
                    else {
                        $(this).removeClass('input-error');
                    }
                });
            });

            // previous step
            $('.page-order-shipping .btn-previous').on('click', function () {
                $(this).parents('fieldset').fadeOut(400, function () {
                    $(this).prev().fadeIn();
                });
            });

        });

    </script>
@stop
