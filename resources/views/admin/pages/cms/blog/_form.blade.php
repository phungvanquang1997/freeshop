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
    {!! App\Helpers\MyHtml::label('category_id', trans('lang.categories')) !!}
    {!! App\Helpers\MyHtml::select('category_id', $categories, old('category_id') ? old('category_id')
    : (isset($blog) ? $blog->category_id : 1), ['class' => 'form-control']) !!}
</div>

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

@if (isset($blog))
    <div class="form-group">
        <div class="col-sm-7 col-sm-offset-3">
            <img class="blog-form-image" src="{{ App\Helpers\MyHtml::showImage($blog->image, 'blog') }}"/>
        </div>
    </div>
@endif

<div class="form-group">
    {!! App\Helpers\MyHtml::label('image', trans('lang.image')) !!}
    {!! App\Helpers\MyHtml::file('image', ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <div class="col-sm-7 col-sm-offset-3">
        <input type="radio" value="0" name="is_featured" {{ !isset($blog) || $blog->is_featured != 1 ? 'checked' : '' }} id="is_featured-radio-2">
        <label style="margin-right: 15px;" for="is_featured-radio-2">{{trans('lang.popular')}}</label>
        <input type="radio" value="1" name="is_featured" {{ isset($blog) && $blog->is_featured == 1 ? 'checked' : '' }} id="is_featured-radio-1">
        <label for="is_featured-radio-1">{{trans('lang.featured')}}</label>
    </div>
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('description', trans('lang.intro')) !!}
    {!! App\Helpers\MyHtml::textarea('description', old('description') ? old('description') : (isset($blog) ? $blog->description :
    null), ['class' => 'form-control', 'rows' => '3']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('content', trans('lang.content'), true) !!}
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
    <label class="col-sm-3 text-right" for="title">Tags</label>
    <div class="col-sm-7">
        <div class="input-group">
            <input type="text" id="tag-text" class="form-control"> 
            <span class="input-group-btn">
                <button type="button" id="add-tag" class="btn btn-primary">{{trans('lang.add')}}</button>
            </span>
            <input type="hidden" id="tag-input" name="tags" value="{{old('tags') ? old('tags') : (isset($blog) ? $blog->tags : null)}}">
        </div>
        <div class="col-sm-12" id="tags-box"></div>
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
editor_config.selector = "textarea";
editor_config.path_absolute = "{{ url('') }}/";
editor_config.content_style= ".mce-content-body  {height: 380px}";
editor_config.relative_urls = false;
tinymce.init(editor_config);
</script>    
<?php 
    $postId = isset($blog) ? $blog->id : 0; 
?>
    <script type="text/javascript">
        //generate slug
        $('input[name="title"]').blur(function () {
            $.ajax({
                url: '/admin/posts/generate-slug',
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

            //Add a new tag article
            $('#add-tag').click(function(){
                var tag = $.trim( $('#tag-text').val() );
                if( tag != '' ) {
                    $('#tags-box').append('<span><i class="fa fa-times-circle"></i>&nbsp;' + tag + '</span>');
                    var tag_input = $('#tag-input').val();
                    if( tag_input != '' ) {
                        $('#tag-input').val( tag_input + ',' + tag );
                    } else {
                        $('#tag-input').val( tag );
                    }
                }
                $('#tag-text').val('');
                return false;
            });
            $('#hot-tag-content a').click(function(e){
                e.preventDefault();
                var tag = $(this).text();
                var tag_input = $('#tag-input').val();
                $('#tags-box').append('<span><i class="fa fa-times-circle"></i>' + tag + '</span>');
                if( tag_input != '' ) {
                    $('#tag-input').val( tag_input + ',' + tag );
                } else {
                    $('#tag-input').val( tag );
                }
            });
            $(document).on('click', '#tags-box span i', function(){
                $(this).parent().remove();
                var text = '';
                $('#tags-box span' ).each(function(){
                    if(text == ''){
                        text += $(this).text();
                    } else {
                        text += ',' + $(this).text();
                    }
                });
                $('#tag-input').val( text );
            });
            $('#tag-text').focusin(function(){
                $(this).change(function(){
                    var tag = $.trim( $('#tag-text').val() );
                    if( tag != '' ) {
                        $('#tags-box').append('<span><i class="fa fa-times-circle"></i>&nbsp;' + tag + '</span>');
                        var tag_input = $('#tag-input').val();
                        if( tag_input != '' ) {
                            $('#tag-input').val( tag_input + ',' + tag );
                        } else {
                            $('#tag-input').val( tag );
                        }
                    }
                    $('#tag-text').val('');
                    return false;
                })
            });
            $('#tag-text').keypress(function (e) {
              if (e.which == 13) {
                e.preventDefault();
                $('#add-tag').click();
                return false;
              }
            });

            if ($('input[name=tags]').val() != null) {
                var tags = $('input[name=tags]').val();
                if (tags != '') {
                    var arr = tags.split(',');
                    $.each(arr, function(k, v){
                        $('#tags-box').append('<span><i class="fa fa-times-circle"></i>&nbsp;' + v + '</span>');
                    });
                }
            }

    </script>

@stop
