@if ($errors->any())
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Whoops!</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    {!! App\Helpers\MyHtml::label('type', 'Loại NCC') !!}
    {!! App\Helpers\MyHtml::select('type', [1=>'Nhà sản xuất', 2=>'Đại lý'], old('type') ? old('type') : (isset($ws) ?
    $ws->type : 1), ['class' => 'form-control select-type']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('name', 'Tên', true) !!}
    {!! App\Helpers\MyHtml::text('name', old('name') ? old('name') : (isset($ws) ? $ws->name : null),
    ['class' =>
    'form-control']) !!}
</div>

@if (isset($ws))
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-7">
            <img src="{{ MyHtml::showThumb($ws->image, 'wholesaler') }}" style="max-width: 200px; max-height: 100px;">
        </div>
    </div>
@endif

<div class="form-group">
    {!! App\Helpers\MyHtml::label('image', 'Ảnh đại diện') !!}
    {!! App\Helpers\MyHtml::file('image', ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <div class="col-sm-2 talign-r"><strong>Danh mục</strong></div>
    <div class="col-sm-7">
        <select name="categories[]" class="form-control" multiple="true" style="min-height: 150px">
            <option value="0">None</option>
            @forelse ($categories as $category)
                <option {{ isset($selectedCats) && in_array($category->id, $selectedCats) ? 'selected="selected"' : '' }}
                        value="{{ $category->id }}">{{ $category->name }}</option>
            @empty
            @endforelse
        </select>
    </div>
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('level_type', 'Loại cấp', false) !!}
    {!! App\Helpers\MyHtml::select('level_type', $levelTypes, isset($ws) ? $ws->level_type : [], ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('level', 'Cấp', false) !!}
    {!! App\Helpers\MyHtml::input('number', 'level', old('level') ? old('level') : (isset($ws) ? $ws->level : 0),
    ['class' => 'form-control', 'min' => 0, 'max' => 5]) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('website', 'Website', false) !!}
    {!! App\Helpers\MyHtml::text('website', old('website') ? old('website') : (isset($ws) ? $ws->website : null),
    ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('description', 'Description', false) !!}
    {!! App\Helpers\MyHtml::textarea('description', old('description') ? old('description') : (isset($ws) ? $ws->description
    : null), ['class' => 'form-control']) !!}
</div>

@section('footer-content')

    @parent

    <script type="text/javascript">

    </script>

@stop