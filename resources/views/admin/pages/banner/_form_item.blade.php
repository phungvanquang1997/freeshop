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
        {!! Form::text('name', old('name') ?? isset($bannerItem) ? $bannerItem->name : null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('link', 'Link', true) !!}
    <div class="col-sm-7">
        {!! Form::text('link', old('link') ?? isset($bannerItem) ? $bannerItem->link : null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('image', 'Ảnh') !!}
    {!! App\Helpers\MyHtml::file('image', ['class' => 'form-control', 'multiple' => false]) !!}
</div>
<div class="form-group">
    <div class="col-md-2"></div>
    <div class="col-sm-7">
    @if (isset($bannerItem) && strlen($bannerItem->image) > 0)
        <img src="{{ MyHtml::showThumb($bannerItem->image, 'banner', 'medium') }}" alt="">
    @endif
    </div>
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('description', 'Mô tả', false) !!}
    <div class="col-sm-7">
        {!! Form::textarea('description',old('description') ?? isset($bannerItem) ? $bannerItem->description : null, ['class' => 'form-control', 'placeholder'=>'', 'id' => 'description']) !!}
    </div>
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('code', 'Code', false) !!}
    <div class="col-sm-7">
        {!! Form::textarea('code',old('code') ?? isset($bannerItem) ? $bannerItem->code : null, ['class' => 'form-control', 'placeholder'=>'', 'id' => 'code']) !!}
    </div>
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('status', trans('lang.status'), false) !!}
    <div class="col-sm-7">
        {!! Form::select('status', $status, old('status') ?? isset($bannerItem) ? $bannerItem->status : null, ['class' => 'form-control']) !!}
    </div>
</div>