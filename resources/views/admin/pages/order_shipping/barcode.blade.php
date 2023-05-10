@extends('admin.layouts.boxed')

@section('head')
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.barcode')}}
            @if($type == 'store-vn')
            <small>{{trans('lang.store_vn')}}</small>
            @elseif($type == 'store-cn')
            <small>{{trans('lang.store_cn')}}</small>
            @elseif($type == 'mvd-success')
            <small>{{trans('lang.barcode_mvd_success')}}</small>
            @endif
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li class="active">{{trans('lang.barcode')}}</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            <!-- Form Open -->
            
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">
                    @if($type == 'store-vn') 
                    {{trans('lang.store_vn') }}
                    @elseif($type =='store-cn') 
                    {{trans('lang.store_cn') }}
                    @elseif($type =='mvd-success')
                    {{trans('lang.barcode_mvd_success') }} 
                    @endif
                    </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        @include('admin.pages.order_shipping._form_barcode')
                        @if (!empty($packages))
                        <table class="table no-margin">
                            <tr>
                                <th class="text-center" valign="middle">{{ trans('lang.status') }}</th>
                                <th class="text-center" valign="middle" >{{ trans('lang.transport_code') }}</th>
                                <th class="text-center" valign="middle" >{{ trans('lang.orders') }}</th>
                                <th class="text-center" valign="middle">{{ trans('lang.weight') }} (kg)</th>
                                <th class="text-center" valign="middle">{{ trans('lang.note') }}</th>
                                <th class="text-center" valign="middle" width="60px"></th>
                            </tr>
                            <tbody>
                                @foreach ($packages as $package)
                                    <tr id="package-{{ $package->id }}">
                                        <td class="text-center">
                                            {!! MyHtml::displayPackageStatus($package) !!}
                                        </td>
                                        <td class="text-center">{{ $package->transport_code }}</td>
                                        <td class="text-center">{{ $package->order->order_code}}</td>
                                        <td class="view-only text-center">{{ $package->weight }}</td>
                                        <td class="view-only text-center">{{ $package->note}}</td>
                                        <td class="view-only text-center">
                                            @if ($type == 'store-vn')
                                            <a class="btn btn-sm btn-success" href="{{ url('/admin/barcode/package_status_store_vn/' . $package->id) }}" onclick="return confirm('Bạn chắc chắn muốn chọn mã vận đơn này?')" title="" data-toggle="tooltip">Chọn</a>
                                            @elseif ($type == 'store-cn')
                                            <a class="btn btn-sm btn-success" href="{{ url('/admin/barcode/package_status_store_cn/' . $package->id) }}" onclick="return confirm('Bạn chắc chắn muốn chọn mã vận đơn này?')" title="" data-toggle="tooltip">Chọn</a>
                                            @elseif ($type == 'mvd-success')
                                            <a class="btn btn-sm btn-success" href="{{ url('/admin/barcode/package_status_success/' . $package->id) }}" onclick="return confirm('Bạn chắc chắn muốn chọn mã vận đơn này?')" title="" data-toggle="tooltip">Chọn</a>
                                            @endif                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer-content')
    <script>
        ion.sound.play("notify");
    </script>
@stop