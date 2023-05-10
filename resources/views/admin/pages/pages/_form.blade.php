@section('head')
    <link rel="stylesheet" href="{{ asset('css/iCheck/all.css') }}"/>
@stop

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
    {!! App\Helpers\MyHtml::label('title', trans('lang.name'), true) !!}
    {!! App\Helpers\MyHtml::text('title', old('title') ? old('title') : (isset($blog) ? $blog->title : null), ['class'
    =>
    'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('slug', 'Slug', false) !!}
    {!! App\Helpers\MyHtml::text('slug', old('slug') ? old('slug') : (isset($blog) ? $blog->slug : null), ['class' =>
    'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('content', trans('lang.content'), false) !!}
    {!! App\Helpers\MyHtml::textarea('content', old('content') ? old('content') : (isset($blog) ?
    $blog->content : null), ['class' => 'form-control tinymce', 'rows' => 20]) !!}
</div>

<div class="form-group">
    <div class="col-sm-7 col-sm-offset-3">
        <input type="radio" value="1" name="status" {{ !isset($blog) || $blog->status == 1 ? 'checked' : '' }} id="status-radio-2">
        <label style="margin-right: 15px;" for="status-radio-2">{{trans('lang.activate')}}</label>
        <input type="radio" value="0" name="status" {{ isset($blog) && $blog->status != 1 ? 'checked' : '' }} id="status-radio-1">
        <label for="status-radio-1">{{trans('lang.deactivate')}}</label>
    </div>
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('meta_title', 'Tiêu đề SEO') !!}
    {!! App\Helpers\MyHtml::input('text', 'meta_title', old('meta_title') ? old('meta_title') : (isset($blog) ? $blog->meta_title :
    null), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('meta_keyword', 'Từ khoá SEO') !!}
    {!! App\Helpers\MyHtml::input('text', 'meta_keyword', old('meta_keyword') ? old('meta_keyword') : (isset($blog) ? $blog->meta_keyword :
    null), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('meta_description', 'Mô tả SEO ') !!}
    {!! App\Helpers\MyHtml::input('text', 'meta_description', old('meta_description') ? old('meta_description') : (isset($blog) ? $blog->meta_description :
    null), ['class' => 'form-control']) !!}
</div>

@section('footer-content')

    @parent

    <script src="{{ asset('js/icheck.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ url('') }}/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="{{ url('') }}/tinymce/tinymce_editor.js"></script>
<script type="text/javascript">
editor_config.selector = "textarea.tinymce";
editor_config.path_absolute = "{{ url('') }}/";
tinymce.init(editor_config);
</script>    
<?php 
    $postId = isset($blog) ? $blog->id : 0; 
?>
    <script type="text/javascript">
        //generate slug
        $('input[name="title"]').blur(function () {
            $.ajax({
                url: '/admin/page/generate-slug',
                method: 'POST',
                data: {
                    title: $(this).val(),
                    postId: {{$postId}},
                    _token: $('input[name="_token"]').val()
                },
                success: function (data) {
                    $('input[name="slug"]').val(data);
                }
            });
        });

        //iCheck
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });

    </script>

@stop
