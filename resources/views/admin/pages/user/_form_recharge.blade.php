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

<div class="form-group">
    {!! App\Helpers\MyHtml::label(null, trans('lang.user_amount'), false) !!}
    {!! App\Helpers\MyHtml::label(null, number_format($user->acc_money) . ' ₫', false) !!}
</div>

<div class="form-group amount-group">
    {!! App\Helpers\MyHtml::label('amount', trans('lang.sotien'), true) !!}
    <div class="input-group col-sm-7">
        @if(old('method') == 'plus' || $complain_id != 0) 
        <span class="input-group-addon plus-label active">
        @else 
        <span class="input-group-addon plus-label">
        @endif
            <label>
            {!! \Form::radio('method', 'plus', old('method') ? old('method') == 'plus' : $complain_id != 0) !!}
            <i class="fa fa-plus"></i>
            </label>
        </span>
        {!! \Form::input('number', 'amount', old('amount') ? old('amount') : $amount != 0 ? $amount : null, ['class' => 'form-control']) !!}
        @if(old('method') == 'minus') 
        <span class="input-group-addon minus-label active">
        @else
        <span class="input-group-addon minus-label">
        @endif
            <label>
            {!! \Form::radio('method', 'minus', old('method') == 'minus', $complain_id != 0 ? ['disabled'] : []) !!}
            <i class="fa fa-minus"></i>
            </label>
        </span>
    </div>
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('content', trans('lang.content'), false) !!}
    {!! App\Helpers\MyHtml::textarea('content', old('content') ? old('content') : null,
    ['class' => 'form-control', 'rows'=>2]) !!}
</div>
{!! \Form::hidden('complain_id', $complain_id) !!}