<div class="row no-padding filter-container">
{!! Form::open(['method' => 'GET', 'url' => url('admin/order')]) !!}
    <div class="form-group">
        <div class="col-sm-2">
            <input name="orderId" type="text" class=" form-control" value="{{ Input::has('orderId') ? Input::get('orderId') : '' }}" placeholder="Mã đơn hàng">
        </div>
        <div class="col-sm-2">
            <input name="fullname" type="text" class=" form-control" value="{{ Input::has('fullname') ? Input::get('fullname') : '' }}" placeholder="Tên khách hàng">
        </div>
        <div class="col-sm-2">
            <input name="phone" type="text" class=" form-control" value="{{ Input::has('phone') ? Input::get('phone') : '' }}" placeholder="Số điện thoại">
        </div>                
        <div class="col-sm-3">
            <div class="input-group date">
                <input name="date" type="text" class=" form-control" id="datepicker" value="{{ Input::has('date') ? Input::get('date') : '' }}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <select data-type="status" class="form-control" name="status">

                <option value="">Tất cả</option>
                @forelse(\App\Order::allStatus() as $key => $value)
                    <option value="{{ $key }}" {{ Input::has('status') && Input::get('status') == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
                @empty
                @endforelse

            </select>
        </div>                    
        <?php 
            $date = isset($_GET['date']) ? $_GET['date'] : null;
            $date = base64_encode($date);
        ?>
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>     
    </div>
{!! Form::close() !!}
</div>