@extends('admin.layouts.boxed')

@section('head')
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css') }}">
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            Phiếu giảm giá : {{ $coupon->name }}
            <small>{{trans('lang.update')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li class="active"><a href="{{ url('admin/coupons') }}">{{trans('lang.list')}}</a></li>
            <li class="active"><a href="">{{trans('lang.update')}}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">

        <div class="box-body">

            <!-- Form Open -->
            <form method="POST" action="{{ url('admin/coupons', $coupon->id) }}" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                @method('PUT')

                <div class="nav-tabs-custom">

                    <ul class="nav nav-tabs">

                        <li class="active"><a href="#tab_1" data-toggle="tab">{{trans('lang.general_infos')}}</a></li>
                        <li class="pull-right">
                            {!! App\Helpers\MyHtml::submit(trans('lang.update'), ['class' => 'btn btn-primary']) !!}
                        </li>

                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane active" id="tab_1">
                            @include('admin.pages.coupons._form', ['coupon' => $coupon])
                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>
@stop
@section('footer-content')
    <script src="{{ asset('AdminLTE/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#datepicker').daterangepicker({
                format: 'DD/MM/YYYY'
            });
        });
    </script>
@stop
