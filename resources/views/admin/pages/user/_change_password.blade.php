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
    {!! App\Helpers\MyHtml::label('current_password', trans('lang.current_password'), true) !!}
    {!! App\Helpers\MyHtml::input('password', 'current_password', old('current_password') ? old('current_password') : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('password', trans('lang.new_password'), true) !!}
    {!! App\Helpers\MyHtml::input('password', 'password', old('password') ? old('password') : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('password_confirmation', trans('lang.password_confirm'), true) !!}
    {!! App\Helpers\MyHtml::input('password', 'password_confirmation', old('password_confirmation') ? old('password_confirmation') : null, ['class' => 'form-control']) !!}
</div>
