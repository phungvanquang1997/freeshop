@extends('admin.layouts.boxed')

@section('head')
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
@stop

@section('breadcrumb')
    <section class="content-header">
        <h1>
            {{trans('lang.complain')}}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-home"></i> {{trans('lang.home')}}</a></li>
            <li><a href="{{ url('admin/complain') }}">{{trans('lang.list')}}</a></li>
            <li class="active"><a href="#">{{ isset($complain->order->order_code) ? $complain->order->order_code : null }}</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="box complain-detail">
        <div class="box-body">
            
            <!-- User information -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-horizontal">
                        <div class="form-group underline-group">
                            <label class="col-md-5 text-right">{{trans('lang.full_name')}}</label> 
                            {{ $complain->user->name }}
                        </div>
                        <div class="form-group underline-group">
                            <label class="col-md-5 text-right">{{trans('lang.email')}}</label> 
                            {{ $complain->user->email }}
                        </div>
                        <div class="form-group underline-group">
                            <label class="col-md-5 text-right">{{trans('lang.phone')}}</label> 
                            {{ $complain->user->phone }}
                        </div>
                        <div class="form-group underline-group">
                            <label class="col-md-5 text-right">{{trans('lang.address')}}</label> 
                            {{ $complain->user->address }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-horizontal">
                        <div class="form-group underline-group">
                            <label class="col-md-5 text-right">{{trans('lang.type_complain')}}</label> 
                            {{ trans($species[$complain->specie]) }}
                        </div>
                        <div class="form-group underline-group">
                            <label class="col-md-5 text-right">{{trans('lang.status')}}</label>
                            
                            <div class="dropdown dropdown-withdraw-status" style="display: inline-block;">
                                <a class="dropdown-toggle" data-toggle="dropdown" title="Bấm chọn để thay đổi trạng thái">
                                    {!! MyHtml::displayComplainStatus($complain->status) !!}
                                </a>
                                <ul class="dropdown-menu" style="margin-top: 5px">
                                    <form method="POST" action="{{ url('admin/complain/update-status/' . $complain->id) }}" class="form-horizontal form-status-{{ $complain->id }}">
                                        {{ method_field('PUT') }}
                                        @csrf
                                    <li>
                                        <label class="label label-warning">
                                            <input type="radio" name="status" value="{{ \App\Complain::STATUS_PENDING }}" {{ $complain->status == \App\Complain::STATUS_PENDING ? 'checked' : '' }} data-id="{{ $complain->id }}">
                                        {{trans(\App\Complain::$status[\App\Complain::STATUS_PENDING])}}
                                        </label>
                                    </li>
                                    <li>
                                        <label class="label label-info">
                                            <input type="radio" name="status" value="{{ \App\Complain::STATUS_PROCESS }}" {{ $complain->status == \App\Complain::STATUS_PROCESS ? 'checked' : '' }} data-id="{{ $complain->id }}">
                                            {{trans(\App\Complain::$status[\App\Complain::STATUS_PROCESS])}}
                                        </label></li>
                                    <li>
                                        <label class="label label-success">
                                            <input type="radio" name="status" value="{{ \App\Complain::STATUS_SOLVED }}" {{ $complain->status == \App\Complain::STATUS_SOLVED ? 'checked' : '' }} data-id="{{ $complain->id }}">                                         {{trans(\App\Complain::$status[\App\Complain::STATUS_SOLVED])}}
                                        </label>
                                    </li>
                                    <li>
                                        <label class="label label-default">
                                            <input type="radio" name="status" value="{{ \App\Complain::STATUS_INACTIVE }}" {{ $complain->status == \App\Complain::STATUS_INACTIVE ? 'checked' : '' }} data-id="{{ $complain->id }}">
                                            {{trans(\App\Complain::$status[\App\Complain::STATUS_INACTIVE])}}
                                        </label>
                                    </li>
                                    </form>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group underline-group">
                            <label class="col-md-5 text-right">{{trans('lang.order_code')}}</label>
                            <a href="{{ url('admin/order_shipping/' . $complain->order_id) }}" title="Xem đơn hàng" data-toggle="tooltip">{{ isset($complain->order->order_code) ? $complain->order->order_code : null }}</a>
                        </div>
                        <div class="form-group underline-group">
                            <label class="col-md-5 text-right">{{trans('lang.created_date')}}</label> 
                            {{ date('d/m/Y H:i', strtotime($complain->created_at)) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- User's order list -->
            <form method="POST" action="{{ url('admin/complain/' . $complain->id) }}">
                @method('PUT')
                @csrf
                <div class="row">
                <div class="col-sm-6">
                    <div class="complain-content-box">
                        <label>{{trans('lang.content_complain')}}</label>
                        <div class="content-box">
                            {!! Form::textarea('', $complain->content, ['rows' => 5, 'class' => 'form-control', 'placeholder' => '', 'readonly' => true]) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="complain-image-box"> 
                        <label>{{trans('lang.image_complain')}}</label>
                        @if($complain->images() != null)
                            @forelse ($complain->images() as $image)
                                 <a href="{{ MyHtml::showImage($image, 'complain') }}" target="_blank" title="{{trans('lang.xem_anh_to')}}"><img src="{{ MyHtml::showThumb($image, 'complain', 'thumb') }}"></a>
                            @empty
                            @endforelse
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="product-box clearfix">
                @if ($item)
                <label>{{trans('lang.san_pham_goc')}}</label>
                
                <table class="table table-bordered detail-product-order" style="font-size: 13px;">
                    <thead>
                        <tr>
                            <td class="text-center">{{trans('lang.image')}} / {{trans('lang.name')}} / {{trans('lang.san_pham_goc')}}</td>
                            <td class="text-center">{{trans('lang.thuoctinh')}}</td>
                            <td class="text-center">{{trans('lang.quantity')}}</td>
                            <td class="text-center">{{trans('lang.unit_price')}}</td>
                            <td class="text-center">{{trans('lang.subtotal')}}</td>
                            <td class="text-center">{{trans('lang.note')}}</td>
                        </tr>
                    </thead>
                    
                    <tr>
                        <td width="32%" class="image-box">
                            @if ($item->order != null && $item->order->type === \App\OrderShipping::TYPE_IMAGE)
                                <img src="{{ App\Helpers\MyHtml::showThumb($item->image, 'shipping') }}">
                            @elseif ($item->order != null &&  $item->order->type === \App\OrderShipping::TYPE_URL)
                                @if ($item->image != '')
                                <img src="{{ $item->image . '_60x60.jpg' }}">
                                @endif
                                @if($item->title != 'NoName' && $item->title != '')
            
                                    <p>{{ $item->title }}</p>
                                @endif
                                    <a href="{{ $item->url }}"
                                   target="_blank">{{ strlen($item->url) > 30 ? substr($item->url, 0, 30) . '...' : $item->url }}</a>
                            @endif
                        </td>
                        <td width="10%" class="text-center">{{ $item->color }}</td>
                        <td width="10%" class="text-center">{{ $item->quantity }}</td>
                        <td width="10%" class="text-center">{!! Currency::displayBold($item->price, 'cn') !!}</td>
                        <td width="10%" class="text-center">{!! Currency::displayBold($item->price * $item->quantity, 'cn') !!}</td>
                        <td width="20%" class="text-center">{{ $item->note }}</td>
                    </tr>
                </table>
                @endif
                @if ($package)
                    <label>{{trans('lang.lading')}}</label>
                    <table class="table table-bordered" style="font-size: 13px;">
                        <thead>
                        <tr>
                            <td class="text-center">{{trans('lang.mavandon')}}</td>
                            <td class="text-center">{{trans('lang.status')}}</td>
                            <td class="text-center">{{trans('lang.chung_loai')}}</td>
                            <td class="text-center">{{trans('lang.can_nang')}}</td>
                            <td class="text-center">{{trans('lang.note')}}</td>
                            <td class="text-center">{{trans('lang.ngay_kynhan')}}</td>
                            <td class="text-center">{{trans('lang.hinhthuc_cp')}}</td>
                        </tr>
                        </thead>
                        
                        <tr>
                            <td width="10%" class="">
                               <b>{{ $package->transport_code}}</b>
                            </td>
                            <td width="15%" class="text-center">
                                {!! MyHtml::displayPackageStatus($package) !!}
                            </td>
                            <td width="12%">{{ \App\OrderShipping::$specie_transport[$package->specie] }}</td>
                            <td width="10%" class="text-center">{{ $package->weight }} Kg</td>
                            <td width="15%">{{ $package->note }}</td>
                            <td width="12%">{{ $package->date_release != null ? date('d/m/Y', strtotime($package->date_release)) : null }}</td>
                            <td width="12%">{{ $package->transport_type != 0 ? \App\OrderShippingPackage::$type_transport[$package->transport_type] : null }}</td>
                        </tr>
                    </table>
                @endif
            </div>

            @if ($errors->any())
                <div class="row">
                    <div class="col-sm-7 col-sm-offset-2 alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Thông báo!</h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            @endif

            <div class="complain-resolve-box">
                <label>{{trans('lang.phan_hoi')}} <span class="asterisk">*</span></label>
                <div class="resolve-box">
                    {!! Form::textarea('resolve', $complain->resolve, ['rows' => 5, 'class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="resolves">
                <label>{{trans('lang.hinhthuc_khieunai')}} <span class="asterisk">*</span></label>
                <div class="choices">
                    <label>
                    {!! Form::radio('method', 1, $complain->method == 1, ['class' => '']) !!} 
                    {{trans('lang.shop_phatbuhang')}}</label>

                    <label>
                        {!! Form::radio('method', 2, $complain->method == 2, ['class' => '']) !!} 
                    {{trans('lang.return')}}</label>
                </div>
            </div>

            <div class="method-resolve-box transport-code-container collapse">
                <h3>{{trans('lang.lading_add')}}</h3>
                <div class="row" id="row1">
                    <div class="col-sm-3 form-selector">
                        <label>{{trans('lang.mavandon')}} <span class="asterisk">*</span></label>
                        {!! Form::text('item[transport_code]', old('item[transport_code]') ? old('item[transport_code]') : isset($complain->transport->transport_code) ? $complain->transport->transport_code : '', ['class' => 'form-control', 'placeholder' => trans('lang.fill_mavandon')]) !!}
                    </div>
                    <div class="col-sm-2 form-selector">
                        <label>{{trans('lang.chung_loai_hang')}}</label>
                        {!! Form::select('item[specie]', $transport_species, old('item[specie]') ? old('item[specie]') : isset($complain->transport->specie) ? $complain->transport->specie : '', ['class'=>"form-control input-md"]) !!}
                    </div>
                    <div class="col-sm-2 form-selector">
                        <label>{{trans('lang.can_nang')}} (kg) <span class="asterisk">*</span></label>
                        {!! Form::input('number', 'item[weight]', old('item[weight]') ? old('item[weight]') : isset($complain->transport->weight) ? $complain->transport->weight : '', ['class' => 'form-control input-md weight-input', 'placeholder' => '']) !!}
                    </div>
                    <div class="col-sm-3 form-selector">
                        <label>{{trans('lang.note')}}</label>
                        {!! Form::textarea('item[note]', old('item[note]') ? old('item[note]') : isset($complain->transport->note) ? $complain->transport->note : '', ['rows' => 1, 'class' => 'form-control', 'placeholder' => trans('lang.yeucaukhac')]) !!}
                    </div>
                    <div class="col-sm-2 form-selector text-center">
                        <label>{{trans('lang.hang_khoi')}}</label>
                        {!! Form::checkbox('item[block]', 1, isset($complain->transport->weight_convert) ? $complain->transport->weight_convert == 1 : false, ['class' => 'block-1']); !!}
                        
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
                                {!! Form::input('number', 'item[block_d]', old('item[block_d]') ? old('item[block_d]') : null, ['class' => 'form-control block_1_d', 'placeholder' => '', 'data' => 1]) !!}
                            </div>
                            <div class="col-sm-4">
                                <label>{{trans('lang.chieurong')}} (cm)</label>
                                {!! Form::input('number', 'item[block_r]', old('item[block_r]') ? old('item[block_r]') : null, ['class' => 'form-control block_1_r', 'placeholder' => '', 'data' => 1]) !!}
                            </div>
                            <div class="col-sm-4">
                                <label>{{trans('lang.chieucao')}} (cm)</label>
                                {!! Form::input('number', 'item[block_c]', old('item[block_c]') ? old('item[block_c]') : null, ['class' => 'form-control block_1_c', 'placeholder' => '', 'data' => 1]) !!}
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="method-resolve-box damage-container collapse">
                <h3>{{trans('lang.hoantien_boithuong')}}</h3>
                <div class="row">
                    <div class="col-sm-4">
                        <label>{{trans('lang.sotien')}} ({!! Currency::signals('cn') !!}) <span class="asterisk">*</span></label>
                        <div class="input-group"> 
                        {!! Form::text('damage', old('damage') ? old('damage') : $complain->damage, ['class' => 'form-control']) !!}
                        <span class="input-group-addon">{!! Currency::signals('cn') !!}</span>
                        </div>
                    </div>
                </div>
            </div>
            <span class=""><span class="asterisk">*</span> {{trans('lang.required')}}</span>
                <button type="submit" class="btn btn-primary pull-right">{{ trans('lang.submit') }}</button>
            </form>
        </div>
    </div>
@stop

@section('footer-content')
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('#data-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "order": []
            });
        });

        $(document).ready(function(){
            $(document).on('change', '.transport-code-container input.block-1', function(){
                if ($(this).is(':checked') == true){
                    var parent = $(this).parent();
                    var grandparent = $(this).parent().parent();
                    parent.find('.distance-box').show('fast');
                    grandparent.find('.weight-input').attr('readonly', true);
                } else {
                    var grandparent = $(this).parent().parent();
                    grandparent.find('.weight-input').attr('readonly', false);
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
                $('#row' + id).find('.weight-input').val(w);
            });

            $(document).on('change', '.resolves input', function(){
                var method = $('.resolves input[name=method]:checked').val(); 
                if (method == 1) {
                    $('.damage-container').removeClass('in');
                    $('.transport-code-container').addClass('in');
                } else {
                    $('.transport-code-container').removeClass('in');
                    $('.damage-container').addClass('in');
                }
            });

            if ($('.resolves input[name=method]:checked').val() == 1) {
                $('.damage-container').removeClass('in');
                $('.transport-code-container').addClass('in');
            } else if ($('.resolves input[name=method]:checked').val() == 2) {
                $('.transport-code-container').removeClass('in');
                $('.damage-container').addClass('in');
            }

            $('.dropdown-withdraw-status input[type=radio]').change(function(){
                var item = $(this).attr('data-id');
                console.log(item);
                $('form.form-status-' + item).submit();
            });
        });
    </script>

@stop
