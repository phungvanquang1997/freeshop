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
    {!! App\Helpers\MyHtml::label('name', trans('lang.name'), true) !!}
    <div class="col-sm-7">
        {!! Form::text('name', old('name') ? old('name') : isset($menu) ? $menu->name : null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('position', trans('lang.position'), true) !!}
    <div class="col-sm-7">
        {!! Form::select('position', \App\Menu::$positions, old('position') ? old('position') : isset($menu) ? $menu->position : null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('status', trans('lang.status'), true) !!}
    <div class="col-sm-7">
        {!! Form::select('status', $status, old('status') ? old('status') : isset($menu) ? $menu->status : null, ['class' => 'form-control']) !!}
    </div>
</div>
