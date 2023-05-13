<div class="row no-padding filter-container">
    {!! Form::open(['method' => 'GET', 'url' => $page_filter_url]) !!}
    <div class="form-group">
        <div class="col-sm-2">
            <input name="order" type="text" class=" form-control" value="{{ request()->has('order') ? request()->get('order') : '' }}" placeholder="{{ trans('lang.order_code') }}">
        </div>

        <div class="col-sm-2">
            <input name="transport_code" type="text" class=" form-control" value="{{ request()->has('transport_code') ? request()->get('transport_code') : '' }}" placeholder="{{ trans('lang.transport_code') }}">
        </div>

        <div class="col-sm-2">
            <input name="purchase_codes" type="text" class=" form-control" value="{{ request()->has('purchase_codes') ? request()->get('purchase_codes') : '' }}" placeholder="{{ trans('lang.purchase_code') }}">
        </div>

        <div class="col-sm-3">
            <div class="input-group date">
                <input name="date" type="text" class=" form-control" id="datepicker" value="{{ request()->has('date') ? request()->get('date') : '' }}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
        </div>
        <!--
        <div class="col-sm-2">
            <select name="status" class=" form-control">

                <option value="">{{ trans('lang.all') }}</option>
                @forelse(\App\OrderShipping::allStatus() as $key => $value)
                    <option value="{{ $key }}" {{ request()->has('status') && request()->get('status') == $key ? 'selected="selected"' : '' }}>{{ trans($value) }}</option>
                @empty
                @endforelse

            </select>
        </div>
        -->
        @if (isset($mytype) && $mytype == 1)
        <div class="col-sm-2">
            <select name="admin" class=" form-control">

                <option value="">{{ trans('lang.teller') }}</option>
                @if (isset($admins))
                @forelse($admins as $key => $value)
                    <option value="{{ $value->id }}" {{ request()->has('admin') && request()->get('admin') == $value->id ? 'selected="selected"' : '' }}>{{ $value->name }}</option>
                @empty
                @endforelse
                @endif

            </select>
        </div>   
        @endif
        <?php 
            $date = isset($_GET['date']) ? $_GET['date'] : null;
            $date = base64_encode($date);
        ?>
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary">{{ trans('lang.filter') }}</button>
            <!--
            <a href="{{ url('admin/order_shipping/export-sale-by-user/' . request()->get('admin') ) }}" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> {{ trans('lang.doanh_so') }}</a>
            <a href="{{ url('admin/order_shipping/export-return-money/' ) }}/<?php echo $date;?>" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> {{ trans('lang.return_of_fee') }}</a>
             <a href="{{ url('admin/order_shipping/export_list_orders/' . $date ) }}" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Theo d?i ��n h�ng</a>-->
        </div>     
    </div>
   
    {!! Form::close() !!}
</div>