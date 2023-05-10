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

<div class="form-group">
	{!! App\Helpers\MyHtml::label('name', trans('lang.full_name'), true) !!}
    {!! App\Helpers\MyHtml::text('name', old('name') ? old('name') : (isset($user) ? $user->name : null),
    ['class' => 'form-control', 'required' => true]) !!}
</div>

@if (!isset($user))
<div class="form-group">
	{!! App\Helpers\MyHtml::label('email', trans('lang.email'), true) !!}
    {!! App\Helpers\MyHtml::input('email', 'email', old('email') ? old('email') : (isset($user) ? $user->email : null), ['class' => 'form-control', 'required' => true]) !!}
</div>

<div class="form-group">
	{!! App\Helpers\MyHtml::label('password', trans('lang.password'), true) !!}
    {!! App\Helpers\MyHtml::input('password', 'password', old('password') ? old('password') : null, ['class' => 'form-control', 'required' => true]) !!}
</div>

<div class="form-group">
	{!! App\Helpers\MyHtml::label('password_confirmation', trans('lang.password_confirm'), true) !!}
    {!! App\Helpers\MyHtml::input('password', 'password_confirmation', old('password_confirmation') ? old('password_confirmation') : null, ['class' => 'form-control', 'required' => true]) !!}
</div>
@endif

<div class="form-group">
    {!! App\Helpers\MyHtml::label('phone', trans('lang.phone'), true) !!}
    {!! App\Helpers\MyHtml::text('phone', old('phone') ? old('phone') : (isset($user) ? $user->phone : null),
    ['class' => 'form-control', 'required' => true]) !!}
</div>

<div class="form-group">
	{!! App\Helpers\MyHtml::label('address', trans('lang.address'), true) !!}
    {!! App\Helpers\MyHtml::text('address', old('address') ? old('address') : (isset($user) ? $user->address : null),['class' => 'form-control', 'required' => true]) !!}
</div>
@if (!isset($user) || (isset($user->is_admin) && $user->is_admin != null))
<div class="form-group">
	{!! App\Helpers\MyHtml::label('group', trans('lang.group'), true) !!}
    {!! App\Helpers\MyHtml::select('group', (isset($groups) ? $groups : []), old('group') ? old('group') : (isset($user) ? $user->group : 1), ['class' => 'form-control select-group', 'required' => true]) !!}
</div>
@endif