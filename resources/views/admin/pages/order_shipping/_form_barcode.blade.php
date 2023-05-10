@if ($errors->any())
    <div class="row">
        <div class="col-sm-7 col-sm-offset-2 alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> {{trans('lang.notify')}}</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-3"></div>
    </div>
@endif
{!! \Form::open(['method' => 'POST', 'url' => '/admin/barcode/barcode-post', 'class' => 'form-horizontal']) !!}
<div class="form-group">
    {!! App\Helpers\MyHtml::label('barcode', trans('lang.barcode'), true) !!}
    {!! App\Helpers\MyHtml::text('barcode', old('barcode') ? old('barcode') : null, ['class' => 'form-control', 'autofocus']) !!}
    <div class="col-sm-2">
        <button type="submit" class="btn btn-primary">Xác nhận</button>
    </div>
</div>
{!! \Form::hidden('type', $type) !!}
<!-- Form Close -->
{!! \Form::close() !!}