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
                <span class="page-heading-title2">{{trans('lang.account')}}</span>
            </h2>

            <div class="account account-dashboard">
                <div class="row">
                    @include('web.pages.account._sidebar')

                    <div class="col-sm-9">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ trans('lang.' . $error) }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @include('web.pages.account.notify')

                        <div class="panel panel-default">

                            <div class="panel-body">

                                <div class="profile-form row">
                            
                                    {!! Form::open(['method' => 'post', 'url' => 'tai-khoan/cap-nhat.html']) !!}

                                    <div class="form-group">
                                        {!! App\Helpers\MyHtml::label('name', trans('lang.full_name'), true) !!}
                                        {!! App\Helpers\MyHtml::text('name', old('name') ? old('name') : (Auth::user()->name ? Auth::user()->name : null),
                                        ['class' => 'form-control', 'id' => 'accountName', 'data-name' => Auth::user()->name]) !!}
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                        {!! App\Helpers\MyHtml::label('email', trans('lang.email'), true) !!}
                                        {!! App\Helpers\MyHtml::text('email', old('email') ? old('email') : (Auth::user()->email ? Auth::user()->email : null),
                                        ['class' => 'form-control', 'readonly' => true, 'id' => 'accountEmail', 'data-name' => Auth::user()->email]) !!}
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                        {!! App\Helpers\MyHtml::label('phone', trans('lang.phone'), true) !!}
                                        {!! App\Helpers\MyHtml::text('phone', old('phone') ? old('phone') : (Auth::user()->phone ? Auth::user()->phone : null),
                                        ['class' => 'form-control', 'id' => 'accountPhone', 'data-phone' => Auth::user()->phone]) !!}
                                    </div>
                                    <div class="clearfix"></div>
                                   
                                    <div class="form-group">
                                        {!! App\Helpers\MyHtml::label('province', 'Tỉnh/ TP', true) !!}
                                        {!! App\Helpers\MyHtml::select('province_id', App\Province::listProvince(), old('province_id') ? old('province_id') : (Auth::user()->province_id ? Auth::user()->province_id : null),
                                        ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                        {!! App\Helpers\MyHtml::label('district_id', 'Huyện/ Quận', true) !!}
                                        {!! App\Helpers\MyHtml::select('district_id', App\Province::listDistrict(Auth::user()->province_id), old('district_id') ? old('district_id') : (Auth::user()->district_id ? Auth::user()->district_id : null),
                                        ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="clearfix"></div>

                                     <div class="form-group">
                                        {!! App\Helpers\MyHtml::label('address', trans('lang.address'), true) !!}
                                        {!! App\Helpers\MyHtml::textarea('address', old('address') ? old('address') : (Auth::user()->address ? Auth::user()->address : null),
                                        ['class' => 'form-control', 'id' => 'accountAddress', 'data-address' => Auth::user()->address, 'placeholder'=>'Số nhà, ngõ, đường, phường']) !!}
                                    </div>
                                    <div class="clearfix"></div>

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
    <script type="text/javascript">
        $( document).ready(function() {
            $("#accountPhone").on("keydown", function(e) {
                if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode == 13 || e.keyCode == 8 || e.keyCode == 9 || e.keyCode == 37 || e.keyCode == 39) {

                } else {
                    e.preventDefault();
                }
            });
            /*
            if ($('select[name=province_id]').val()) {
                var province_id = $('select[name=province_id]').val();
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url : siteUrl + '/account/get-districts',
                    method : 'post',
                    data : {id:province_id, _token:_token},
                    success : function(res){
                        $('select[name=district_id]').html(res);
                    }
                })
            }*/

            $('select[name=province_id]').change(function(){
                var province_id = $(this).val();
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url : siteUrl + '/account/get-districts',
                    method : 'post',
                    data : {id:province_id, _token:_token},
                    success : function(res){
                        $('select[name=district_id]').html(res);
                    }
                });
            });
        });
    </script>
@stop
