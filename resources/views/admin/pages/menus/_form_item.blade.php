@if ($errors->any())
    <div class="row">
        <div class="col-sm-7 col-sm-offset-2 alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> {{trans('lang.notify')}}!</h4>
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
        {!! Form::text('name', old('name') ?? isset($menuItem) ? $menuItem->name : null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('parent_id', trans('lang.menu_parent'), false) !!}
    <div class="col-sm-7">
        <select class="form-control" name="parent_id">
            <option>-- {{trans('lang.choose')}} --</option>
            @if($menuItemOption) 
               {!! $menuItemOption !!}
            @endif
        </select>
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('link', trans('lang.static_link'), true) !!}
    <div class="col-sm-7">
        {!! Form::text('link', old('link') ?? isset($menuItem) ? $menuItem->link : null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('icon', trans('lang.icon'), false) !!}
    <div class="col-sm-7">
        {!! Form::text('icon', old('icon') ?? isset($menuItem) ? $menuItem->icon : null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('status', trans('lang.status'), false) !!}
    <div class="col-sm-7">
        {!! Form::select('status', $status, old('status') ?? isset($menuItem) ? $menuItem->status : null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('ordering', trans('lang.position'), false) !!}
    <div class="col-sm-7">
        {!! Form::text('ordering', old('ordering') ?? isset($menuItem) ? $menuItem->ordering : null, ['class' => 'form-control']) !!}
    </div>
</div>