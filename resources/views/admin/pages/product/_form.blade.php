
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
    {!! App\Helpers\MyHtml::label('name', 'Tên sản phẩm', true) !!}
    {!! App\Helpers\MyHtml::text('name', old('name') ? old('name') : (isset($product) ? $product->name : null), ['class'
    =>
    'form-control']) !!}
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('total_views', 'Tổng lượt mua', true) !!}
    {!! App\Helpers\MyHtml::text('total_views', old('total_views') ? old('total_views') : (isset($product) ? $product->total_views : null), ['class'
    =>
    'form-control']) !!}
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('model', 'Model', false) !!}
    {!! App\Helpers\MyHtml::text('model', old('model') ? old('model') : (isset($product) ? $product->model : null), ['class'
    =>
    'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('sku', 'Sku', true) !!}
    {!! App\Helpers\MyHtml::text('sku', old('sku') ? old('sku') : (isset($product) ? $product->sku : null), ['class' =>
    'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('slug', 'Slug', false) !!}
    {!! App\Helpers\MyHtml::text('slug', old('slug') ? old('slug') : (isset($product) ? $product->slug : null), ['class'
    => 'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('images', 'Ảnh') !!}
    {!! App\Helpers\MyHtml::file('images[]', ['class' => 'form-control', 'multiple' => true]) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('category_id', 'Danh mục', false) !!}
    <div class="col-sm-7">
        <select class="form-control select2" name="category_id">
            <option value="">Root</option>
            @if($categories)
               {!! $categories !!}
            @endif
        </select>
    </div>
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('market_price', 'Giá thị trường') !!}
    {!! App\Helpers\MyHtml::input('number', 'market_price', old('market_price') ? old('market_price') : (isset($product) ? $product->market_price :
    null), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('price', 'Giá bán') !!}
    {!! App\Helpers\MyHtml::input('number', 'price', old('price') ? old('price') : (isset($product) ? $product->price :
    null), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('promotion_price', 'Giá khuyến mại') !!}
    {!! App\Helpers\MyHtml::input('number', 'promotion_price', old('promotion_price') ? old('promotion_price') : (isset($product) ? $product->promotion_price :
    null), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('stock_status', 'Tình trạng') !!}
    {!! App\Helpers\MyHtml::select('stock_status', $availabilities, old('stock_status') ? old('stock_status') :
    (isset($product) ? $product->stock_status : null), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('quantity', 'Số lượng') !!}
    {!! App\Helpers\MyHtml::input('number', 'quantity', old('quantity') ? old('quantity') : (isset($product) ?
    $product->quantity : null), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label class="col-sm-3 text-right" for="title">Màu sắc</label>
    <div class="col-sm-7">
        <div class="input-group">
            <input type="text" id="color-text" class="form-control"> 
            <span class="input-group-btn">
                <button type="button" id="add-color" class="btn btn-primary">{{trans('lang.add')}}</button>
            </span>
            <input type="hidden" id="color-input" name="colors" value="{{old('colors') ? old('colors') : (isset($product) ? $product->colors : null)}}">
        </div>
        <div class="col-sm-12" id="colors-box"></div>
    </div>
</div> 

<div class="form-group">
    <div class="col-sm-7 col-sm-offset-3">
        <input type="checkbox" value="1" name="is_featured" {{ isset($product) && $product->is_featured == 1 ? 'checked' : '' }} id="is_featured">
        <label for="is_featured" style="margin-right: 15px;">Nổi bật</label>

        <input type="checkbox" value="1" name="is_hot" {{ isset($product) && $product->is_hot == 1 ? 'checked' : '' }} id="is_hot">
        <label for="is_hot" style="margin-right: 15px;">Hot</label>

        <input type="checkbox" value="1" name="is_bestseller" {{ isset($product) && $product->is_bestseller == 1 ? 'checked' : '' }} id="is_bestseller">
        <label for="is_bestseller" style="margin-right: 15px;">Bán chạy </label>

        <input type="checkbox" value="1" name="is_new" {{ isset($product) && $product->is_new == 1 ? 'checked' : '' }} id="is_new">
        <label for="is_new" style="margin-right: 15px;">Mới</label>

        <input type="checkbox" value="1" name="is_promotion" {{ isset($product) && $product->    is_promotion == 1 ? 'checked' : '' }} id="is_promotion">
        <label for="is_promotion">Khuyến mại</label>
    </div>
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('special', 'Đặc điểm nổi bật') !!}
    {!! App\Helpers\MyHtml::textarea('special', old('special') ? old('special') : (isset($product) ?
    $product->special : null), ['class' => 'product-des tinymce form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('description', 'Mô tả') !!}
    {!! App\Helpers\MyHtml::textarea('description', old('description') ? old('description') : (isset($product) ?
    $product->description : null), ['class' => 'product-des tinymce form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('content', 'Nội dung') !!}
    {!! App\Helpers\MyHtml::textarea('content', old('content') ? old('content') : (isset($product) ?
    $product->content : null), ['class' => 'product-des tinymce form-control']) !!}
</div>
<div class="form-group">
    {!! App\Helpers\MyHtml::label('code_adword', 'Code Tracking Adword') !!}
    {!! App\Helpers\MyHtml::textarea('code_adword', old('code_adword') ? old('code_adword') : (isset($product) ?
    $product->code_adword : null), ['class' => 'product-des form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('code_remarketing', 'Code Remarketing') !!}
    {!! App\Helpers\MyHtml::textarea('code_remarketing', old('code_remarketing') ? old('code_remarketing') : (isset($product) ?
    $product->code_remarketing : null), ['class' => 'product-des form-control']) !!}
</div>

<div class="form-group">
    <label class="col-sm-3 text-right" for="title">Tags</label>
    <div class="col-sm-7">
        <div class="input-group">
            <input type="text" id="tag-text" class="form-control"> 
            <span class="input-group-btn">
                <button type="button" id="add-tag" class="btn btn-primary">{{trans('lang.add')}}</button>
            </span>
            <input type="hidden" id="tag-input" name="tags" value="{{old('tags') ? old('tags') : (isset($product) ? $product->tags : null)}}">
        </div>
        <div class="col-sm-12" id="tags-box"></div>
    </div>
</div> 

<div class="form-group">
    {!! App\Helpers\MyHtml::label('meta_title', 'Tiêu đề SEO') !!}
    {!! App\Helpers\MyHtml::input('text', 'meta_title', old('meta_title') ? old('meta_title') : (isset($product) ? $product->meta_title :
    null), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('meta_keyword', 'Từ khoá SEO') !!}
    {!! App\Helpers\MyHtml::input('text', 'meta_keyword', old('meta_keyword') ? old('meta_keyword') : (isset($product) ? $product->meta_keyword :
    null), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label('meta_description', 'Mô tả SEO ') !!}
    {!! App\Helpers\MyHtml::input('text', 'meta_description', old('meta_description') ? old('meta_description') : (isset($product) ? $product->meta_description :
    null), ['class' => 'form-control']) !!}
</div>

@section('footer-content')

    @parent

<script src="{{ asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>
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
    $productId = isset($product) ? $product->id : 0; 
?>  
    <script type="text/javascript">

        $(document).ready(function() {
            $('input[name="name"]').blur(function () {
                $.ajax({
                    url: '/admin/product/generate-slug',
                    method: 'POST',
                    data: {
                        name: $(this).val(), postId: {{$productId}}
                    },
                    success: function (data) {
                        $('input[name="slug"]').val(data);
                    }
                });
            });

            $(".select2").select2();
            
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

             //Add a new color article
            $('#add-color').click(function(){
                var color = $.trim( $('#color-text').val() );
                if( color != '' ) {
                    $('#colors-box').append('<span><i class="fa fa-times-circle"></i>&nbsp;' + color + '</span>');
                    var color_input = $('#color-input').val();
                    if( color_input != '' ) {
                        $('#color-input').val( color_input + ',' + color );
                    } else {
                        $('#color-input').val( color );
                    }
                }
                $('#color-text').val('');
                return false;
            });
            $('#hot-color-content a').click(function(e){
                e.preventDefault();
                var color = $(this).text();
                var color_input = $('#color-input').val();
                $('#colors-box').append('<span><i class="fa fa-times-circle"></i>' + color + '</span>');
                if( color_input != '' ) {
                    $('#color-input').val( color_input + ',' + color );
                } else {
                    $('#color-input').val( color );
                }
            });
            $(document).on('click', '#colors-box span i', function(){
                $(this).parent().remove();
                var text = '';
                $('#colors-box span' ).each(function(){
                    if(text == ''){
                        text += $(this).text();
                    } else {
                        text += ',' + $(this).text();
                    }
                });
                $('#color-input').val( text );
            });
            $('#color-text').focusin(function(){
                $(this).change(function(){
                    var color = $.trim( $('#color-text').val() );
                    if( color != '' ) {
                        $('#colors-box').append('<span><i class="fa fa-times-circle"></i>&nbsp;' + color + '</span>');
                        var color_input = $('#color-input').val();
                        if( color_input != '' ) {
                            $('#color-input').val( color_input + ',' + color );
                        } else {
                            $('#color-input').val( color );
                        }
                    }
                    $('#color-text').val('');
                    return false;
                })
            });
            $('#color-text').keypress(function (e) {
              if (e.which == 13) {
                e.preventDefault();
                $('#add-color').click();
                return false;
              }
            });

            if ($('input[name=colors]').val() != null) {
                var colors = $('input[name=colors]').val();
                if (colors != '') {
                    var arr = colors.split(',');
                    $.each(arr, function(k, v){
                        $('#colors-box').append('<span><i class="fa fa-times-circle" title="Xóa"></i>&nbsp;' + v + '</span>');
                    });
                }
            }

        });

    </script>

@stop

