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
        {!! Form::text('name', old('name') ?? isset($banner) ? $banner->name : null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('position', trans('lang.position'), false) !!}
    <div class="col-sm-7">
        {!! Form::select('position', \App\Banner::$positions, old('position') ?? isset($banner) ? $banner->position : null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('type', 'Kiểu', false) !!}
    <div class="col-sm-7">
        {!! Form::radio('type', \App\Banner::TYPE_BANNER, old('type') ?? (isset($banner) && $banner->type == \App\Banner::TYPE_BANNER) ? true : false, ['class' => 'field']) !!} Banner
        {!! Form::radio('type', \App\Banner::TYPE_SLIDER, old('type') ?? (isset($banner) && $banner->type == \App\Banner::TYPE_SLIDER) ? true : false, ['class' => 'field']) !!} Slider
        {!! Form::radio('type', \App\Banner::TYPE_ADS, old('type') ?? (isset($banner) && $banner->type == \App\Banner::TYPE_ADS) ? true : false, ['class' => 'field']) !!} Ads
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('status', trans('lang.status'), false) !!}
    <div class="col-sm-7">
        {!! Form::select('status', $status, old('status') ?? isset($banner) ? $banner->status : null, ['class' => 'form-control']) !!}
    </div>
</div>
