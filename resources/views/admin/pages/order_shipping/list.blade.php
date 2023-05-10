@extends('admin.layouts.boxed')

@section('head')
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/iCheck/square/blue.css') }}">   
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datepicker/datepicker3.css') }}"> 
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{ $page_title }}
            <small>{{ trans('lang.list') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{ trans('lang.home') }}</a></li>
            <li class="active"><a href="#">{{ trans('lang.list') }}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">

            @include('admin.pages.order_shipping._filter')

            <table id="data-table" class="table table-bordered table-hover big-table-active">
                <thead>
                <tr>
                    <th>{{ trans('lang.order_code') }}</th>
                    <th width="100px">{{ trans('lang.customer') }}</th>
                    <th>{{ trans('lang.phone') }}</th>
                    <th>{{ trans('lang.total_amount') }}</th>
                        
                    <th>{{ trans('lang.created_date') }}</th>
                    <th>{{ trans('lang.status') }}</th>
                    <th width="100px">{{ trans('lang.teller') }}</th>
                    <th width="130px"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr class="general" big-row-id="{{ $order->id }}">
                        <td class="clickable">{{ $order->order_code }}</td>
                        <td class="clickable">{{ $order->user_name }}</td>    
                        <td class="clickable">{{ $order->user_phone }}</td>
                        <td class="clickable">{!! Currency::displayBold($order->vn_total_amount) !!}</td>
                        
                        <td class="clickable">{{ date('d/m/Y h:i A', strtotime($order->created_at)) }}</td>
                        <td class="clickable">{!! MyHtml::displayOrderStatus($order) !!}</td>
                        <td class="clickable">
                            @if($order->admin) 
                            {{ $order->admin->name }}
                            @else 
                            
                            @endif
                        </td>
                        <td>
                            
                            <a href="{{ url('admin/order_shipping/' . $order->id ) }}"
                               class="btn btn-xs btn-default font14 btn-action" data-toggle="tooltip" title="{{trans('lang.view_now')}}"><i class="fa fa-eye"></i></a>
                            @if($order->admin_id == 0) 
                            <a href="{{ url('admin/order_shipping/received/' . $order->id ) }}"
                               class="btn btn-xs btn-default font14 btn-action" data-toggle="tooltip" title="{{trans('lang.received_order')}}"><i class="fa fa-thumb-tack" aria-hidden="true"></i></a>
                            @endif
                            @if($order->admin_id == Auth::user()->id) 
                            <a href="{{ url('admin/order_shipping/deny/' . $order->id ) }}"
                               class="btn btn-xs btn-action font14 btn-warning" data-toggle="tooltip" title="{{trans('lang.deny_order')}}"><i class="fa fa-undo" aria-hidden="true" onclick="return deny_confirm()"></i></a>
                            @endif
                            @if(Auth::user()->group == \App\User::IS_ADMINISTRATOR)
                                <form method="POST" action="/admin/order_shipping/{{ $order->id }}" class="inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-xs btn-action font14 btn-danger" title="{{trans('lang.del')}}" data-toggle="tooltip" onclick="return del_order_confirm()"><i class="fa fa-trash"></i></button>
                                </form>
                            @endif
                            
                            @if($order->admin_id == Auth::user()->id || Auth::user()->group == \App\User::IS_ADMINISTRATOR || Auth::user()->group == \App\User::IS_SHIPER || Auth::user()->group == \App\User::IS_CHECKINER || Auth::user()->group == \App\User::IS_ACCOUNTANT) 
                            <a href="{{ url('admin/order_shipping/export-order/' . $order->id ) }}"
                               class="btn btn-xs btn-action font14 btn-info" data-toggle="tooltip" title="{{trans('lang.excel_btn')}}"><i class="fa fa-file-excel-o" onclick="return excel_confirm()"></i></a>
                            @endif
                        
                        </td>
                    </tr>
                    @if (!$order->packages->isEmpty())
                    <tr class="detail-{{ $order->id }} detail-row">
                        <td colspan="8">
                         
                            <table class="table no-margin">
                                <tr>
                                    <th class="text-center" valign="middle">{{ trans('lang.status') }}</th>
                                    
                                    <th class="text-center" valign="middle" >{{ trans('lang.transport_code') }}</th>
                                    <th class="text-center" valign="middle">{{ trans('lang.weight') }} (kg)</th>
                                    <th class="text-center" valign="middle">{{ trans('lang.ship_tq_vn') }}</th>
                                    <th class="text-center" valign="middle">{{ trans('lang.tien_lay_hang') }}</th>
                                    <th class="text-center" valign="middle" >{{ trans('lang.specie') }}</th>
                                    @if ($order->type == \App\OrderShipping::TYPE_SERVICE)
                                    <th class="text-center" valign="middle" >{{ trans('lang.date_release') }}</th>
                                    <th class="text-center" valign="middle">{{ trans('lang.type_transport') }}</th>
                                    @endif
                                    <th class="text-center" valign="middle">{{ trans('lang.note') }}</th>
                                    <th class="text-center" valign="middle" width="60px"></th>
                                </tr>
                                <tbody>
                                    @foreach ($order->packages as $package)
                                        <tr id="package-{{ $package->id }}">
                                            <td class="text-center">
                                                <a class="btn-package-status" data-package="{{ $package->id }}" data-status="{{ $package->status }}" data-order="{{ $order->id }}" data-toggle="modal" href="#order-status-package-modal">{!! MyHtml::displayPackageStatus($package) !!}</a>
                                            </td>

                                            <form method="POST" action="/admin/order_shipping/update-package/{{ $package->id }}">
                                                @method('PUT')
                                                @csrf

                                            <td class="text-center">{{ $package->transport_code }}</td>

                                            <td class="view-only text-center">{{ $package->weight }}</td>
                                            <td class="editable hidden" style="position: relative;">
                                                <input type="number" name="package[{{ $package->id }}][weight]" value="{{ $package->weight }}" class="form-control weight_input input-md">
\                                                <div class="text-center">

                                                <label>{{trans('lang.hang_khoi')}}</label>
                                                    <input type="checkbox" name="package[{{ $package->id }}][block]" class="block-1" style="margin-top: 8px;" data="{{ $package->id }}" value="1">


                                                    <div class="distance-box" style="display: none">
                                                    <div class="guid-box">
                                                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                        <div class="guid-content">
                                                            - {{trans('lang.quydoi_hangkhoi')}}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>{{trans('lang.chieudai')}} (cm)</label>
                                                        <input name="package[{{$package->id }}][block_d]" type="number" class="form-control block_{{ $package->id }}_d" value="0" data="{{ $package->id }}"/>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>{{trans('lang.chieurong')}} (cm)</label>
                                                        <input name="package[{{$package->id }}][block_r]" type="number" class="form-control block_{{ $package->id }}_r" value="0" data="{{ $package->id }}"/>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>{{trans('lang.chieucao')}} (cm)</label>
                                                        <input name="package[{{$package->id }}][block_c]" type="number" class="form-control block_{{ $package->id }}_c" value="0" data="{{ $package->id }}"/>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </td>

                                            <td class="text-right">{!! Currency::displayBold(($package->weight_fee), 'vn') !!}</td>
                                            <td class="view-only text-right">{!! Currency::displayBold(($package->cn_shipping_fee), 'cn') !!}</td>
                                            <td class="editable hidden">
                                                <input type="number" name="package[{{ $package->id }}][cn_shipping_fee]" value="{{ $package->cn_shipping_fee }}" class="form-control cn_shipping_fee_input input-md">
                                            <td class="view-only text-center">{{ isset(\App\OrderShippingPackage::$specie_transport[$package->specie]) ? trans(\App\OrderShippingPackage::$specie_transport[$package->specie]) : "" }}</td>
                                            <td class='editable hidden'>
                                                <select name="package[{{$package->id}}][specie]" class="form-control input-md">
                                                    @foreach($species as $key => $value)
                                                        <option value="{{$key}}" @if($key == $package->specie) selected @endif>{{$value}}</option>
                                                    @endforeach
                                                </select>                                            </td>
                                            @if ($order->type == \App\OrderShipping::TYPE_SERVICE)
                                            <td class="view-only text-center">
                                                @if($package->date_release != 0)
                                                {{ date('d/m/Y', strtotime($package->date_release)) }}
                                                @endif
                                            </td>
                                            <td class="editable hidden">
                                                <div class="input-group date">
                                                    <input name="package[{{$package->id }}][date_release]" type="text" class="form-control datepicker" value="">
                                                    
                                                </div>
                                            </td>

                                            <td class="view-only text-center">{{ isset($transportTypes[$package->transport_type]) ? $transportTypes[$package->transport_type] : "" }}</td>
                                            <td class='editable hidden'>
                                                <select name="package[{{$package->id}}][transport_type]" class="form-control input-md">
                                                    @foreach($transportTypes as $key => $value)
                                                        <option value="{{$key}}" {{$package->transport_type == $key ? 'selected' : ''}}>{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            @endif
                                            <td class="view-only text-center">{{ $package->note}}</td>
                                            <td class="editable hidden">

                                                <textarea name="package[{{$package->id}}][note]" rows="1" cols="25" class="form-control note_input input-md">{{$package->note}}</textarea>                                            </td>

                                            <td colspan="text-center">
                                                @if(Auth::user()->group == \App\User::IS_ADMINISTRATOR || (Auth::user()->group == \App\User::IS_STOREKEEPER && in_array($package->status, \App\OrderShipping::$statusStorekeeperAble)) || (Auth::user()->group == \App\User::IS_CHECKINER && in_array($package->status, \App\OrderShipping::$statusCkeckinerAble)) || (Auth::user()->group == \App\User::IS_SHIPER && in_array($package->status, \App\OrderShipping::$statusShiperAble)) )
                                                <a class="btn-edit-package" href="" data-toggle="tooltip" title="{{trans('lang.edit')}}" data-id="{{ $package->id }}"><i class="fa fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-primary btn-save-package hidden">Lưu</button>
                                                    <a class="btn-remove-product view-only" href="{{ url('/admin/order_shipping/del-package/' . $package->id) }}" onclick="return confirm('Bạn chắc chắn muốn xóa mã vận đơn này khỏi đơn hàng?')"
                                                           title="{{trans('lang.del')}}" data-toggle="tooltip"><i class="glyphicon glyphicon-remove"></i></a>
                                                @endif
                                            </td>
                                            <input type="hidden" name="active" value="2">
                                           </form>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        
                    	</td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <div class="sortPagiBar">
                <div class="bottom-pagination">
                    <nav>
                        {!! $orders->render() !!}
                    </nav>
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
                    <form method="POST" action="{{ url('/admin/order_shipping/update-status-package') }}" accept-charset="UTF-8">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                        <input type="hidden" name="package_id">

                    @if (App\OrderShipping::$status)
                            <div class="col-sm-6">
                            @foreach (App\OrderShippingPackage::$packageStatus as $key => $item)
                                <div class="form-group">
                                    <div class="radio iradio">
                                        <input type="radio" name="status_p" class="flat-red" value="{{$key}}" >
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
                                <button class="btn btn-primary" onclick="return confirm('Bạn chắc chắn muốn đổi trạng thái vận đơn, điều này có thể phát sinh việc gửi email thông báo cho khách hàng.')">
                                    {{ trans('lang.update') }}
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="active">
                    </form>
                </div>
            </div>

        </div>
    </div>
@stop

@section('footer-content')
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            /*
            $('#data-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "order": [],
                "pageLength": 20,
            });*/
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            
            $('#datepicker').daterangepicker({
                format: 'DD/MM/YYYY'
            });
        });
    </script>

    <script>
        /*
        $('.general td.clickable').on('click', function() {
            var parent = $(this).parent();
            var rowid = parent.attr('big-row-id');
            var visible = $('.detail-' + rowid).is(":visible");
            $('tr.detail-row').each(function(){
                $(this).hide('fast');
            });
            if (visible) {
                $('.detail-' + rowid).hide('fast');
            } else {
                $('.detail-' + rowid).show('fast');
            }
        });*/

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
            var $order_id = $(this).attr('data-order');
            var action = $('#order-status-package-modal form').attr('action') + '/' + $package_id;
            $('#order-status-package-modal form').attr('action', action);
            $('#order-status-package-modal input[type=radio]').each(function(){
                $(this).prop("checked", false);
                $(this).parent().removeClass('checked');
                if ($(this).val() == $package_status) {
                    $(this).prop("checked", true);
                    $(this).parent().addClass('checked');
                }
            });
            $('#order-status-package-modal input[name=active]').val($order_id);
        });

        $('.btn-edit-package').on('click', function (e) {
            var id = $(this).attr('data-id');
            e.preventDefault();
            $('#package-' + id + ' .view-only').addClass('hidden');
            $('#package-' + id + ' .editable').removeClass('hidden');
            $(this).hide();
            $('#package-' + id + ' .btn-save-package').removeClass('hidden');
        });

        $('input.flat-red').iCheck({
            checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });

        function excel_confirm() {
            var text = "{{trans('lang.export_excel_confirm')}}";
            return confirm(text);
        }
        function deny_confirm() {
            var text = "{{trans('lang.deny_order_confirm')}}";
            return confirm(text);
        }
        function del_order_confirm() {
            var text = "{{trans('lang.del_order_confirm')}}";
            return confirm(text);
        }

    </script>

@stop

