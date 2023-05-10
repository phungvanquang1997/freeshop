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
    @if (!$packages->isEmpty())
        @foreach ($packages as $package)
            <tr id="package-{{ $package->id }}">
                <td class="text-center">
                    <a class="btn-package-status" data-package="{{ $package->id }}" data-status="{{ $package->status }}" data-toggle="modal" href="#order-status-package-modal">{!! MyHtml::displayPackageStatus($package) !!}</a>
                </td>

                <form method="POST" action="/admin/order_shipping/update-package/{{ $package->id}}">
                    @method('PUT')
                    @csrf
                <td class="text-center">{{ $package->transport_code }}</td>

                <td class="view-only text-center">{{ $package->weight }}</td>
                <td class="editable hidden" style="position: relative;">
                    <input type="number" name="package[{{ $package->id }}][weight]" value="{{ $package->weight }}" class="form-control weight_input input-md">                    <div class="text-center">

                    <label>{{trans('lang.hang_khoi')}}</label>
                        <input type="checkbox" name="package[{{$package->id}}][block]" value="1" class="block-1" style="margin-top: 8px;" data="{{$package->id}}">
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
                <td class='editable hidden'>
                    <input type="number" name="package[{{ $package->id }}][cn_shipping_fee]" value="{{ $package->cn_shipping_fee }}" class="form-control cn_shipping_fee_input input-md">
                </td>

                <td class='editable hidden'>
                    <select name="package[{{ $package->id }}][specie]" class="form-control input-md">
                        @foreach($species as $key => $value)
                            <option value="{{ $key }}" @if($package->specie == $key) selected="selected" @endif>{{ $value }}</option>
                        @endforeach
                    </select>

                </td>
                <td class="view-only text-center">{{ isset($species[$package->specie]) ? trans($species[$package->specie]) : "" }}</td>

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
                    <select class="form-control input-md" name="package[{{$package->id}}][transport_type]">
                        @foreach($transportTypes as $key => $transportType)
                            <option value="{{$key}}" @if($package->transport_type == $key) selected @endif>{{$transportType}}</option>
                        @endforeach
                    </select>
                </td>
                @endif
                <!--
                <td class="view-only">
                    {!! Currency::displayBold($package->cn_shipping_fee, 'cn') !!}
                </td>
                <td class="editable hidden">
                    <input type="number" name="package[{{$package->id}}][cn_shipping_fee]" value="{{$package->cn_shipping_fee}}" class="form-control cn_shipping_fee_input input-md">
                </td>-->

                <td class="view-only text-center">{{ $package->note}}</td>
                <td class="editable hidden">
                    <textarea name="package[{{ $package->id }}][note]" rows="1" cols="25" class="form-control note_input input-md">{{ $package->note }}</textarea>
                </td>

                <td colspan="text-center">
                    @if(Auth::user()->group == \App\User::IS_ADMINISTRATOR || (Auth::user()->group == \App\User::IS_STOREKEEPER && in_array($package->status, \App\OrderShipping::$statusStorekeeperAble)) || (Auth::user()->group == \App\User::IS_CHECKINER && in_array($package->status, \App\OrderShipping::$statusCkeckinerAble)) || (Auth::user()->group == \App\User::IS_SHIPER && in_array($package->status, \App\OrderShipping::$statusShiperAble)) )
                    <a class="btn-edit-package" href="" data-toggle="tooltip" title="{{trans('lang.edit')}}" data-id="{{ $package->id }}"><i class="fa fa-edit"></i></a>
                        <button type="submit" class="btn btn-primary btn-save-package hidden">{{ trans('lang.save') }}</button>
                        <a class="btn-remove-product view-only" data-toggle="tooltip" title="Xóa" href="{{ url('/admin/order_shipping/del-package/' . $package->id) }}" onclick="return confirm('Bạn chắc chắn muốn xóa mã vận đơn này khỏi đơn hàng?')"
                               title="{{trans('lang.del')}}" data-toggle="tooltip"><i class="glyphicon glyphicon-remove"></i></a>
                    @endif
                </td>
                    <input type="hidden" name="active" value="2">
                </form>

            </tr>
        @endforeach
    @endif

    <!-- extra transport -->
    @if (!$extra->isEmpty())
        <tr>
            @if ($order->type == \App\OrderShipping::TYPE_SERVICE)
            <td colspan="10" style="font-weight: bold;">Vận đơn phát bù hàng</td>
            @else 
            <td colspan="8" style="font-weight: bold;">Vận đơn phát bù hàng</td>
            @endif
        </tr>
        @foreach ($extra as $package)
            <tr id="package-{{ $package->id }}">
                <td class="text-center">
                    <a class="btn-package-status" data-package="{{ $package->id }}" data-status="{{ $package->status }}" data-toggle="modal" href="#order-status-package-modal">{!! MyHtml::displayPackageStatus($package) !!}</a>
                </td>

                {!! \Form::open(['method' => 'PUT', 'url' => '/admin/order_shipping/update-package/' . $package->id]) !!}
                <td class="text-center">{{ $package->transport_code }}</td>

                <td class="view-only text-center">{{ $package->weight }}</td>
                <td class="editable hidden" style="position: relative;"> 
                    {!! \Form::input('numeric', 'package[' . $package->id .'][weight]', $package->weight, ['class' => 'form-control weight_input input-md']) !!}
                    <div class="text-center">

                    <label>Hàng khối</label>
                    {!! \Form::checkbox('package[' . $package->id . '][block]', 1, false, ['class' => 'block-1', 'style' => 'margin-top: 8px;', 'data' => $package->id]); !!}
                    
                    <div class="distance-box" style="display: none">
                        <div class="guid-box">
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                            <div class="guid-content">
                                - Với hàng khối, cân nặng được tính theo công thức quy đổi cm3 sang Kg như sau: (Dài * Rộng * Cao) : 5000
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-4">
                            <label>Dài (cm)</label>
                            <input name="package[{{$package->id }}][block_d]" type="number" class="form-control block_{{ $package->id }}_d" value="0" data="{{ $package->id }}"/>
                        </div>
                        <div class="col-sm-4">
                            <label>Rộng (cm)</label>
                            <input name="package[{{$package->id }}][block_r]" type="number" class="form-control block_{{ $package->id }}_r" value="0" data="{{ $package->id }}"/>
                        </div>
                        <div class="col-sm-4">
                            <label>Cao (cm)</label>
                            <input name="package[{{$package->id }}][block_c]" type="number" class="form-control block_{{ $package->id }}_c" value="0" data="{{ $package->id }}"/>
                        </div>
                        </div>
                    </div>
                </div>
                </td>

                <td class="text-right">{!! Currency::displayBold(($package->weight_fee), 'vn') !!}</td>

                <td class="view-only text-right">{!! Currency::displayBold(($package->cn_shipping_fee), 'cn') !!}</td>

                <td class="view-only text-center">{{ isset($species[$package->specie]) ? $species[$package->specie] : "" }}</td>
                <td class='editable hidden'>{!! \Form::select('package[' . $package->id . '][specie]', $species, $package->specie , ['class'=>"form-control input-md"]) !!}</td>
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
                <td class='editable hidden'>{!! \Form::select('package[' . $package->id . '][transport_type]', $transportTypes, $package->transport_type, ['class'=>"form-control input-md"]) !!}</td>
                @endif
                <!--
                <td class="view-only">
                    {!! Currency::displayBold($package->cn_shipping_fee, 'cn') !!}
                </td>
                <td class="editable hidden">
                    {!! \Form::input('number', 'package[' . $package->id .'][cn_shipping_fee]', $package->cn_shipping_fee, ['class' => 'form-control cn_shipping_fee_input input-md']) !!}
                </td>-->

                <td class="view-only text-center">{{ $package->note}}</td>
                <td class="editable hidden">
                    {!! \Form::textarea('package[' . $package->id .'][note]', $package->note, ['rows' => 1, 'cols' => 25, 'class' => 'form-control note_input input-md']) !!}
                </td>

                <td colspan="text-center">
                    @if(Auth::user()->group == \App\User::IS_ADMINISTRATOR || (Auth::user()->group == \App\User::IS_STOREKEEPER && in_array($package->status, \App\OrderShipping::$statusStorekeeperAble)) || (Auth::user()->group == \App\User::IS_CHECKINER && in_array($package->status, \App\OrderShipping::$statusCkeckinerAble)) || (Auth::user()->group == \App\User::IS_SHIPER && in_array($package->status, \App\OrderShipping::$statusShiperAble)) )
                    <a class="btn-edit-package" href="" data-toggle="tooltip" title="Sửa" data-id="{{ $package->id }}"><i class="fa fa-edit"></i></a>
                    {!! \Form::submit('Lưu', ['class' => 'btn btn-primary btn-save-package hidden']) !!}
                    <a class="btn-remove-product view-only" data-toggle="tooltip" title="Xóa" href="{{ url('/admin/order_shipping/del-package/' . $package->id) }}" onclick="return confirm('Bạn chắc chắn muốn xóa mã vận đơn này khỏi đơn hàng?')"
                               title="Xóa" data-toggle="tooltip"><i class="glyphicon glyphicon-remove"></i></a>
                    @endif
                </td>
                {!! \Form::hidden('active', 2) !!}
                {!! \Form::close() !!}

            </tr>
        @endforeach
    @endif
    </tbody>
</table>