
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
    {!! App\Helpers\MyHtml::label('name', trans('lang.name'), true) !!}
    {!! App\Helpers\MyHtml::text('name', old('name') ? old('name') : (isset($category) ? $category->name : null),
    ['class' =>
    'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('slug', 'Slug', false) !!}
    {!! App\Helpers\MyHtml::text('slug', old('slug') ? old('slug') : (isset($category) ? $category->slug : null),
    ['class' =>
    'form-control']) !!}
</div>

@if ( isset($category) && $category->type == \App\Category::CATEGORY_POST)
@else

<div class="form-group select-parent">
    {!! App\Helpers\MyHtml::label('parent_id', trans('lang.cate_parent')) !!}
    <div class="col-sm-7">
        <select class="form-control" name="parent_id">
            <option value="0">Root</option>
            @if($categories)
               {!! $categories !!}
            @endif
        </select>
    </div>
</div>
@endif

<div class="form-group">
    {!! App\Helpers\MyHtml::label('content', 'Nội dung') !!}
    {!! App\Helpers\MyHtml::textarea('content', old('content') ? old('content') : (isset($category) ?
    $category->content : null), ['class' => 'tinymce category-des form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('order', trans('lang.num_oder')) !!}
    {!! App\Helpers\MyHtml::input('number', 'order', old('order') ? old('order') : (isset($category) ? $category->order
    : null), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('show_home_block', 'Hiển thị trên trang chủ', false) !!}
    <div class="col-sm-7">
        {!! \Form::radio('show_home_block', 0, old('show_home_block') ? old('show_home_block'): (isset($category) && $category->show_home_block == 0) ? true : false, ['class' => 'field']) !!} Không hiển thị
        {!! \Form::radio('show_home_block', 1, old('show_home_block') ? old('show_home_block'): (isset($category) && $category->show_home_block == 1) ? true : false, ['class' => 'field']) !!} Hiển thị
    </div>
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('is_deal', 'Hot Deal', false) !!}
    <div class="col-sm-7">
        {!! \Form::radio('is_deal', 0, old('is_deal') ? old('is_deal'): (isset($category) && $category->is_deal == 0) ? true : false, ['class' => 'field']) !!} Không hiển thị
        {!! \Form::radio('is_deal', 1, old('is_deal') ? old('is_deal'): (isset($category) && $category->is_deal == 1) ? true : false, ['class' => 'field']) !!} Hiển thị Hot Deal
    </div>
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('status', 'Trạng thái', false) !!}
    <div class="col-sm-7">
        {!! \Form::radio('status', 1, old('status') ? old('status'): (isset($category) && $category->status == 1) ? true : false, ['class' => 'field']) !!} Kích hoạt
        {!! \Form::radio('status', 0, old('status') ? old('status'): (isset($category) && $category->status == 0) ? true : false, ['class' => 'field']) !!} Vô hiệu
    </div>
</div>

<hr/>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('meta_title', '[SEO] title', true) !!}
    {!! App\Helpers\MyHtml::text('meta_title', old('meta_title') ? old('meta_title') : (isset($category) ? $category->meta_title : null),
    ['class' =>
    'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('meta_keyword', '[SEO] Keyword', true) !!}
    {!! App\Helpers\MyHtml::text('meta_keyword', old('meta_keyword') ? old('meta_keyword') : (isset($category) ? $category->meta_keyword : null),
    ['class' =>
    'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('meta_description', '[SEO] description', true) !!}
    {!! App\Helpers\MyHtml::text('meta_description', old('meta_description') ? old('meta_description') : (isset($category) ? $category->meta_description : null),
    ['class' =>
    'form-control']) !!}
</div>

@section('footer-content')

    @parent
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('js/icheck.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ url('') }}/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="{{ url('') }}/tinymce/tinymce_editor.js"></script>
<script type="text/javascript">
editor_config.selector = "textarea.tinymce";
editor_config.path_absolute = "{{ url('') }}/";
editor_config.content_style= ".mce-content-body  {height: 180px}";
tinymce.init(editor_config);
</script>    
<?php 
    $categoryId = isset($category) ? $category->id : 0; 
?>    
    <script type="text/javascript">
        $(document).ready(function() {   
        $('input[name="name"]').blur(function () {
            $.ajax({
                url: '/admin/category/generate-slug',
                method: 'POST',
                data: {
                    name: $(this).val(), categoryId: {{$categoryId}}
                },
                success: function (data) {
                    $('input[name="slug"]').val(data);
                }
            });
        });

        $('.select-type').on('change', function() {
            if ($(this).val() == 2) {
                $('.select-parent').css('display', 'none');
            } else {
                $('.select-parent').css('display', 'block');
            }
        });
    });
    </script>

@stop