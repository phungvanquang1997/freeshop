<div class="row no-padding filter-container">
    {!! Form::open(['method' => 'GET', 'url' => $page_filter_url]) !!}
    <div class="form-group">
        
        <div class="col-sm-3">
            <div class="input-group date">
                <input name="date" type="text" class=" form-control" id="datepicker" value="{{ Input::has('date') ? Input::get('date') : '' }}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <input name="order_code" type="text" class=" form-control" placeholder="Tìm theo đơn hàng" value="{{ Input::has('order_code') ? Input::get('order_code') : '' }}">
        </div>
        <div class="col-sm-2">
            <input name="email" type="text" class=" form-control" placeholder="Tìm theo email khách hàng" value="{{ Input::has('email') ? Input::get('email') : '' }}">
        </div>
        
        @if (isset($search_type) && $search_type == 'list_orders')
        <div class="col-sm-2">
            <select name="admin" class=" form-control">

                <option value="">--{{ trans('lang.teller') }}--</option>
                @if (isset($admins))
                @forelse($admins as $key => $value)
                    <option value="{{ $value->id }}" {{ Input::has('admin') && Input::get('admin') == $value->id ? 'selected="selected"' : '' }}>{{ $value->name }}</option>
                @empty
                @endforelse
                @endif

            </select>
        </div>  
        <div class="col-md-1" style="">
            <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> {{ trans('lang.filter') }}</button>
        </div>
        @endif   

        <?php 
            $date = isset($_GET['date']) ? $_GET['date'] : null;
            $date = base64_encode($date);            
            $userId = Input::get('admin');            
        ?>
        <div class="col-md-5" style="margin-top: 3px;">
            @if (isset($search_type) && $search_type == 'list_orders')
            <a href="{{ url('admin/order-shipping-report/export-sale-by-user/' . $userId ) }}" class="@if ($userId == NULL)disabled-link @endif btn btn-success"><i class="fa fa-file-excel-o"></i> {{ trans('lang.doanh_so') }}</a>
            <a href="{{ url('admin/order-shipping-report/export-return-money/' ) }}/<?php echo $date;?>" class="@if ($date == '')disabled-link @endif btn btn-success"><i class="fa fa-file-excel-o"></i> {{ trans('lang.return_of_fee') }}</a>
            <a href="{{ url('admin/order-shipping-report/export_list_orders/' . $date ) }}" class="@if ($date == '')disabled-link @endif btn btn-success"><i class="fa fa-file-excel-o"></i> {{ trans('lang.follow_orders') }}</a>
            @endif
            @if (isset($search_type) && $search_type == 'list_orders_service')
                <a href="{{ url('admin/order-shipping-report/export_list_orders_service/' . $date . '/' . Input::get('email') ) }}" class="@if ($date == '')disabled-link @endif btn btn-success"><i class="fa fa-file-excel-o"></i> {{ trans('lang.follow_orders') }}</a>
            @endif
        </div>   
    </div>
    
    {!! Form::close() !!}
</div>
<style type="text/css" media="screen">
    .disabled-link{
   pointer-events: none;
   cursor: default;        
    }
</style>