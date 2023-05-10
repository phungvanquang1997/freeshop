@if ($errors->any())
    <div class="row">
        <div class="col-sm-7 col-sm-offset-3 alert alert-danger alert-dismissable">
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

<div class="form-group">
    {!! App\Helpers\MyHtml::label('voucher', 'Mã khuyến mại', false) !!}
    <div class="col-sm-7">
        <input type="text" name="voucher" value="{{ old('voucher') ? old('voucher') : isset($coupon) ? $coupon->voucher : null }}" class="form-control" placeholder="Tạo tự động" style="text-transform:uppercase" maxlength="6">    </div>
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('name', trans('lang.name'), true) !!}
    <div class="col-sm-7">
        <input type="text" name="name" class="form-control" value="{{ old('name') ? old('name') : isset($coupon) ? $coupon->name : '' }}">
    </div>
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('type', trans('lang.type'), true) !!}
    <div class="col-sm-7">
        <select name="type" class="form-control">
            @foreach($types as $key => $value)
                <option value="{{ $key }}" {{ (old('type') == $key || (isset($coupon) && $coupon->type == $key)) ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('value', 'Giá trị', true) !!}
    <div class="col-sm-7">
        <input type="number" name="value" value="{{ old('value') ? old('value') : isset($coupon) ? $coupon->value : null }}" class="form-control">
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('value', 'Thời gian hiệu lực', true) !!}
    <div class="col-sm-7">
        <div class="input-group date">
            <input name="date_range" type="text" class=" form-control" id="datepicker" value="{{ Input::has('date_range') ? Input::get('date_range') : (isset($date_range) ? $date_range : '') }}" placeholder="">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('num', 'Số lần khuyến mại', true) !!}
    <div class="col-sm-7">
        <input type="number" name="num" value="{{ old('num') ? old('num') : isset($coupon) ? $coupon->num : '' }}" class="form-control">
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('num_per_user', 'Số lần/một khách', true) !!}
    <div class="col-sm-7">
        <input type="number" name="num_per_user" value="{{ old('num_per_user') ? old('num_per_user') : isset($coupon) ? $coupon->num_per_user : '' }}" class="form-control">
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('num_used', 'Số lần đã sử dụng', false) !!}
    <div class="col-sm-7">
        <input type="number" name="num_used" class="form-control" value="{{ old('num_used') ? old('num_used') : isset($coupon) ? $coupon->num_used : null }}" >
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('status', trans('lang.status'), true) !!}
    <div class="col-sm-7">
        <select name="status" class="form-control">
            @foreach($status as $key => $value)
                <option value="{{ $key }}" {{ (old('status') == $key) || (isset($coupon) && $coupon->status == $key) ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>
