@extends('admin.layouts.boxed')

@section('head')
    <link href="{{ asset('css/switchery/switchery.css') }}" rel="stylesheet">
   <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datepicker/datepicker3.css') }}">
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{ trans('lang.orders') }}: {{ $order->order_code }}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{ trans('lang.home') }}</a></li>
            <li class="active"><a href="{{ url('admin/my_order') }}">{{ trans('lang.my_orders') }}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <!-- Modal Order Details-->
    <div class="box">
        <div class="box-body">

            
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="{{ ((old('active') && old('active') == '1') || !old('active')) ? 'active' : '' }}"><a href="#tab_1" data-toggle="tab">{{ trans('lang.order_info') }}</a></li>
                        
                        <li class="{{ (old('active') && old('active') == '2') ? 'active' : '' }}"><a href="#tab_2" data-toggle="tab">{{ trans('lang.shipping_status_info') }}</a></li> 
                        <li><a href="#tab_3" data-toggle="tab">{{ trans('lang.customer_info') }}</a></li>

                        <li><a href="#tab_4" data-toggle="tab">{{ trans('lang.teller_info') }}</a></li>  
                        @if (Auth::user()->group == \App\User::IS_ADMINISTRATOR || (Auth::user()->group == \App\User::IS_TELLER && in_array($order->status, \App\OrderShipping::$statusTellerAble)) || (Auth::user()->group == \App\User::IS_STOREKEEPER && in_array($order->status, \App\OrderShipping::$statusAfterBought)) || (Auth::user()->group == \App\User::IS_SHIPER && in_array($order->status, \App\OrderShipping::$statusAfterRelease)) )
                        <a class="btn btn-primary pull-right" data-toggle="modal" href="#order-status-modal"><i class="fa fa-cog" aria-hidden="true"></i> {{ trans('lang.status') }}</a>
                        
                        <a class="btn btn-warning pull-right" data-toggle="modal" href="#order-received-pay-modal"><i class="fa fa-money" aria-hidden="true"></i> {{ trans('lang.payment') }}</a>
                        @endif
                        @if(Auth::user()->group == \App\User::IS_ADMINISTRATOR || Auth::user()->group == \App\User::IS_CHECKINER)
                        <a class="btn btn-info pull-right" onclick="return sms_confirm()" href="{{ url('admin/order_shipping/sms/' . $order->id) }}" data-toggle="tooltip" title="{{ trans('lang.send_sms') }}"><i class="fa fa-comment-o" aria-hidden="true"></i></a>
                        
                        @endif
                        @if ($order->status != \App\OrderShipping::STATUS_INIT && $order->admin_id != null)
                            {!! Form::open(['url' => '/api/chat-rooms/' . $order->id, 'method' => 'POST', 'class' => 'inline pull-right', 'style' => 'display:inline-block', 'target' => '_blank']) !!}
                            <button type="submit" class="btn btn-warning pull-right" data-toggle="tooltip" title="{{ trans('lang.chat_cus') }}">
                                <i class="fa fa-comments-o"></i>
                            </button>
                            {!! Form::close() !!}
                        @endif
                       
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane {{ ((old('active') && old('active') == '1') || !old('active')) ? 'active' : '' }}" id="tab_1">
                            @include('admin.pages.order_shipping._form')
                        </div>
                        <div class="tab-pane" id="tab_3">
                            @include('admin.pages.order_shipping._form_customer_info')
                        </div>
                    
                        <div class="tab-pane {{ (old('active') && old('active') == '2') ? 'active' : '' }}" id="tab_2">
                            @include('admin.pages.order_shipping._form_transport')
                        </div>  

                        <div class="tab-pane" id="tab_4">
                            @include('admin.pages.order_shipping._form_admin_info')
                        </div>
                    </div>
                </div>
         

        </div>
    </div>

    <div id="order-status-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cập nhật trạng thái đơn hàng</h4>
                  </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'PUT', 'url' => '/admin/order_shipping/update-status/' . $order->id]) !!}
                    @if ($statusOrder) 
                        <div class="col-sm-6">
                        @foreach ($statusOrder as $key => $item)
                            <div class="form-group">
                                <div class="radio iradio">
                                {!! Form::radio('status', $key, (int) $order->status == $key, ['class' => 'flat-red']) !!} 
                                <label class="label label-{{ $key }}">{{ trans($item) }} </label>
                                </div>
                            </div>
                            @if ($key == 5)
                                </div>
                                <div class="col-sm-6">
                            @endif
                        @endforeach
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-12 form-group text-center">
                            {!! Form::submit(trans('lang.update'), ['class'=>'btn btn-primary', 'onclick' => 'return confirm("Bạn chắc chắn muốn đổi trạng thái, điều này có thể phát sinh việc gửi email cho khách hàng.")']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
    <div id="order-status-package-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cập nhật trạng thái vận đơn</h4>
                  </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'PUT', 'url' => '/admin/order_shipping/update-status-package']) !!}
                    {!! Form::hidden('package_id') !!}
                    @if ($statusOrder) 
                        <div class="col-sm-6">
                        @foreach ($statusPackage as $key => $item)
                            <div class="form-group">
                                <div class="radio iradio">
                                {!! Form::radio('status_p', $key, false, ['class' => 'flat-red']) !!} 
                                <label class="label label-{{ $key }}">{{ trans($item) }} </label>
                                </div>
                            </div>
                            @if ($key == 10)
                                </div>
                                <div class="col-sm-6">
                            @endif
                        @endforeach
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-12 form-group text-center">
                            {!! Form::submit(trans('lang.update'), ['class'=>'btn btn-primary', 'onclick' => 'return confirm("Bạn chắc chắn muốn đổi trạng thái vận đơn, điều này có thể phát sinh việc gửi email thông báo cho khách hàng.")']) !!}
                        </div>
                    </div>
                    {!! Form::hidden('active', 2) !!}
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
    <div id="order-received-pay-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thanh toán đơn hàng: {{ $order->order_code }}</h4>
                  </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'PUT', 'url' => '/admin/order_shipping/update-received-pay/' . $order->id]) !!}
                    <div class="col-sm-12 order-static-info">
                        <div class="form-group underline-group">
                            <label class="col-md-6 col-sm-6">{{trans('lang.total_amount')}}</label>
                            <label class="total_vnd label-content">{!! Currency::displayBold($order->vn_total_amount, 'vn') !!}</label>
                        </div>
                        <div class="form-group underline-group">
                            <label class="col-md-6 col-sm-6">{{trans('lang.down_payment')}}</label>
                            <label class="total_vnd label-content label-deposit">{!! Currency::displayBold($order->deposit, 'vn') !!}</label>
                            
                        </div>
                        <div class="form-group underline-group">
                            <label class="col-md-6 col-sm-6">{{trans('lang.paid')}}</label>
                            <label class="total_vnd label-content label-deposit">{!! Currency::displayBold($order->received_pay, 'vn') !!}</label>
                            
                        </div>
                        <div class="form-group underline-group">
                            <label class="col-md-6 col-sm-6">{{trans('lang.unpaid')}}</label>
                            <label class="total_vnd label-content label-debt">{!! Currency::displayBold(($order->vn_total_amount - $order->deposit - $order->received_pay ), 'vn') !!}</label>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="pay-type-box">
                            <div class="form-group">
                                <?php $percent = $order->order_attr == App\OrderShipping::ORDER_STANDARD ? App\Setting::findValueByKey('standard_deposit_percent') : App\Setting::findValueByKey('vip_deposit_percent'); 
                                    $deposit = round(((float) $percent * $order->vn_total_amount) / 100);
                                ?>
                                <div class="radio iradio">
                                <?php 
                                    $label = $order->deposit == 0 ? "Đặt cọc " . $percent . "% giá trị đơn hàng, tương đương " . number_format($deposit) . " VNĐ" : "Đặt cọc " . $percent . "% giá trị đơn hàng, tương đương " . number_format($order->deposit) . " VNĐ";

                                ?>
                                @if ($order->deposit == 0)
                                <label>{!! Form::radio('pay_type', 2 , false, ['class' => '', 'required']) !!} {{ $label }}</label>
                                @else
                                <label>{!! Form::radio('pay_type', 2 , false, ['class' => '', 'required', 'disabled']) !!} {{ $label }}</label>
                                @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="radio iradio">
                                <label>{!! Form::radio('pay_type', 1 , true, ['class' => '', 'required']) !!} Thanh toán nhận hàng</label>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                         
                    @if ($errors->any())
                        <div class="row">
                            <div class="col-sm-12 alert alert-danger alert-dismissable">
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
                    
                    <div class="pay-method-box">
                        <div class="col-sm-6 border-right">
                            <div class="form-group">
                                <div class="radio iradio">
                                
                                <label>{!! Form::radio('pay_method', \App\Payment::METHOD_SEC , false, ['class' => '', 'checked'=>true, 'required']) !!} Thanh toán bằng ví điện tử</label>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                Tiền trong ví: {!! Currency::displayBold($order->user->acc_money, 'vn') !!}
                            </div>
                        </div>
                         <div class="col-sm-6">
                            <div class="form-group">
                                <div class="radio iradio">
                                
                                <label>{!! Form::radio('pay_method', \App\Payment::METHOD_CASH , false, ['class' => '', 'required']) !!} Thanh toán bằng tiền mặt</label>
                                </div>
                            </div>
                            <div class="form-group">
                                 {!! Form::input('number', 'amount', null, ['class' => 'form-control input-md', 'placeholder' => 'Số tiền thanh toán', 'min' => 0]) !!}
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::textarea('content', '', ['rows' => "3", 'class'=>'form-control', 'placeholder' => 'Nội dung thanh toán: Thanh toán tiền cọc đơn hàng xxxx hoặc thanh toán nhận hàng đơn hàng xxxx', 'required']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group text-center">
                                {!! Form::submit(trans('lang.update'), ['class'=>'btn btn-primary', 'onclick' => 'return confirm("Bạn chắc chắn muốn ghi thanh toán này?")']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
        </div>
@stop

@section('footer-content')
    <script src="{{ asset('bower_components/AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/switchery/switchery.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            var elem_1 = document.querySelector('.js-switch_1');
            var switchery_1 = new Switchery(elem_1, { color: '#83C322' });
            var elem_2 = document.querySelector('.js-switch_2');
            var switchery_2 = new Switchery(elem_2, { color: '#83C322' });
            var elem_3 = document.querySelector('.js-switch_3');
            var switchery_3 = new Switchery(elem_3, { color: '#83C322' });
            var elem_4 = document.querySelector('.js-switch_4');
            var switchery_4 = new Switchery(elem_4, { color: '#83C322' });

            $('.btn-edit-order-info').on('click', function (e) {
                e.preventDefault();
                $('.order-view-only').addClass('hidden');
                $('.order-editable').removeClass('hidden');
                $(this).fadeOut('fast');
                $('.btn-update-order-info').removeClass('hidden');
            });

            $('.btn-edit-item').on('click', function (e) {
                var id = $(this).attr('data-id');
                e.preventDefault();
                $('.order-item-' + id + ' .item-view').addClass('hidden');
                $('.order-item-' + id + ' .item-editable').removeClass('hidden');
                $(this).hide();
                $('.order-item-' + id + ' .btn-save-item').removeClass('hidden');
            });

            $('.btn-edit-package').on('click', function (e) {
                var id = $(this).attr('data-id');
                e.preventDefault();
                $('#package-' + id + ' .view-only').addClass('hidden');
                $('#package-' + id + ' .editable').removeClass('hidden');
                $(this).hide();
                $('#package-' + id + ' .btn-save-package').removeClass('hidden');
            });
            
            $(document).on('change', 'input.block-1', function(){
                var id = $(this).attr('data');
                if ($(this).is(':checked') == true){
                    var parent = $(this).parent();
                    parent.find('.distance-box').show('fast');
                    $(document).find('#package-' + id + ' input.weight_input').attr('readonly', true);
                } else {
                    $('.distance-box input.block_' + id + '_d').val(0);
                    $('.distance-box input.block_' + id + '_r').val(0);
                    $('.distance-box input.block_' + id + '_c').val(0);
                    $(document).find('#package-' + id + ' input.weight_input').val(0);
                    $(document).find('#package-' + id + ' input.weight_input').attr('readonly', false);
                }
            });

            $(document).click(function(event) {
                $('.distance-box').hide('fast');
            });

            $(document).on('click', '.distance-box', function(event){
                event.stopPropagation();
            });

            $(document).on('change', '.distance-box input', function(){
                var id = $(this).attr('data');
                var d = $('.distance-box input.block_' + id + '_d').val();
                var r = $('.distance-box input.block_' + id + '_r').val();
                var c = $('.distance-box input.block_' + id + '_c').val();
                var w = Math.round(( parseFloat(d) * parseFloat(r) * parseFloat(c) ) / 5000);
                $(document).find('#package-' + id + ' input.weight_input').val(w);
            });

            $(document).on('focus', '.datepicker', function(){
                $(this).datepicker({
                    format: 'd/m/yyyy'
                })
            });

            $('.btn-package-status').click(function(){
                var $package_id = $(this).attr('data-package');
                var $package_status = $(this).attr('data-status');
                var action = $('#order-status-package-modal form').attr('action') + '/' + $package_id;
                $('#order-status-package-modal form').attr('action', action);
                $('#order-status-package-modal input[type=radio]').each(function(){
                    $(this).attr('checked', '');
                    $(this).parent().removeClass('checked');
                    if ($(this).val() == $package_status) {
                        $(this).attr('checked', 'checked');
                        $(this).parent().addClass('checked');
                    }
                })
            });

            $('input.flat-red').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
        function sms_confirm()
        {
            var text = "{{trans('lang.send_sms_confirm')}}";
            return confirm(text);
        }
        function del_product_confirm()
        {
            var text = "{{trans('lang.del_product_confirm')}}";
            return confirm(text);
        }
    </script>
@stop
