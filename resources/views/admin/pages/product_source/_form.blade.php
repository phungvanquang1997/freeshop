
@if ($errors->any())
    <div class="row">
        <div class="alert alert-danger alert-dismissable col-sm-7 col-sm-offset-2">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Whoops!</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<div class="form-group">
    {!! App\Helpers\MyHtml::label('name', trans('lang.name'), true) !!}
    {!! App\Helpers\MyHtml::text('name', old('name') ? old('name') : (isset($source) ? $source->name : null), ['class'
    =>
    'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('brand', trans('lang.supplier'), true) !!}
    <div class="col-sm-7">
        <input type="radio" value="{{ App\ProductSource::BRAND_TAOBAO }}" name="brand" {{ (isset($source) && $source->brand == App\ProductSource::BRAND_TAOBAO) || !isset($source) ? 'checked' : '' }} id="special-source-radio-1">
        <label style="margin-right: 15px;" for="special-radio-1"><img src="{{ asset( App\ProductSource::IMG_TAOBAO) }}" style="max-height: 35px; max-width: 100%;margin: 0;" alt="{{ App\ProductSource::BRAND_TAOBAO }}"></label>

        <input type="radio" value="{{ App\ProductSource::BRAND_TMALL }}" name="brand" {{ isset($source) && $source->brand == App\ProductSource::BRAND_TMALL ? 'checked' : '' }} id="special-source-radio-2">
        <label style="margin-right: 15px;" for="special-radio-2"><img src="{{ asset( App\ProductSource::IMG_TMALL) }}" style="max-height: 35px; max-width: 100%;margin: 0;" alt="{{ App\ProductSource::BRAND_TMALL }}"></label>

        <input type="radio" value="{{ App\ProductSource::BRAND_1688 }}" name="brand" {{ isset($source) && $source->brand == App\ProductSource::BRAND_1688 ? 'checked' : '' }} id="special-source-radio-3">
        <label style="margin-right: 15px;" for="special-radio-3"><img src="{{ asset( App\ProductSource::IMG_1688) }}" style="max-height: 35px; max-width: 100%;margin: 0;" alt="{{ App\ProductSource::BRAND_1688 }}"></label>
    </div>
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('link', trans('lang.link') . '(link)', true) !!}
    {!! App\Helpers\MyHtml::text('link', old('link') ? old('link') : (isset($source) ? $source->link : null), ['class'
    =>
    'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('category_id', trans('lang.categories'), true) !!}
    <div class="col-sm-7">
        <select class="form-control" name="category_id">
            @if($categories) 
               {!! $categories !!}
            @endif
        </select>
    </div>
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('order', trans('lang.num_oder')) !!}
    {!! App\Helpers\MyHtml::input('number', 'order', old('order') ? old('order') : (isset($source) ?
    $source->order : null), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('iamge', trans('lang.image'), true) !!}
    @if (isset($source) && !empty($source->image)) 
        <div class="col-sm-7">
        <img src="{{ MyHtml::showThumb($source->image, 'brand', 'thumb') }}">
        <a href="{{ url('admin/product-source/remove-image/' . $source->id) }}" class="btn btn-xs btn-default">{{trans('lang.del')}}</a> 
        </div>
    @else
        {!! MyHtml::file('image', ['class' => '']) !!}
    @endif

</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('status', trans('lang.status')) !!}
    <div class="col-sm-8">
        <input type="radio" value="1" name="status" {{ (isset($source) && $source->status == 1) || !isset($source) ? 'checked' : '' }} id="special-source-radio-5">
        <label for="special-radio-5">{{trans('lang.activate')}}</label>
        <input type="radio" value="0" name="status" {{ isset($source) && $source->status == 0 ? 'checked' : '' }} id="special-source-radio-4">
        <label style="margin-right: 15px;" for="special-radio-4">{{trans('lang.deactivate')}}</label>   
    </div>
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('hot', 'Hot') !!}
    <div class="col-sm-8">
        <input type="radio" value="1" name="hot" {{ (isset($source) && $source->hot == 1) ? 'checked' : '' }} id="special-source-radio-6">
        <label for="special-radio-6">Hot - {{trans('lang.show_home')}}</label>
        <input type="radio" value="0" name="hot" {{ (isset($source) && $source->hot == 0) || !isset($source) ? 'checked' : '' }} id="special-source-radio-7">
        <label style="margin-right: 15px;" for="special-radio-7">{{trans('lang.dont_show_home')}}</label>   
    </div>
</div>

@section('footer-content')

    @parent

    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('js/icheck.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            //iCheck
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });

        });

    </script>

@stop
