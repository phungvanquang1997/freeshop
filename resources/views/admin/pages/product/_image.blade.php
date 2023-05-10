<style>
.show{
    display: block;
}
.Jcrop{

}
</style>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
@foreach ($product->images()->get() as $image)

    <div id="row-image-{{ $image->id }}" class="row border-b" style="margin-bottom: 20px;">
        <div class="col-sm-10" id="image-item-{{ $image->id }}" style="z-index: 0;position: relative">
            <img product-id="{{$product->id}}" image-id="{{$image->id}}" src="{{ App\Helpers\MyHtml::showImage($image->image, 'product') }}" style="height: 700px; width:auto;max-height: initial;" id="Jcrop-{{ $image->id }}" class="Jcrop">
            <span id="g-s-{{ $image->id }}" class="label label-primary" style="display: none;" >Width: <span id="s-w-{{ $image->id }}"></span>, Height: <span id="s-h-{{ $image->id }}"></span></span>
        </div>

        <div class="col-sm-2">
            <a style="display: none;" id="btn-crop-{{ $image->id }}" class="btn btn-xs btn-default font14 cropImage" image="{{ $image->id }}" product-id="{{$product->id}}">
                <i class="fa fa-crop"></i> Crop
            </a>
            <a href="javascript:void(0);" class="btn btn-xs btn-default font14 featured-image" image="{{ $image->id }}">
                            @if ($image->is_featured === 1)
            <i class="fa fa-check-circle" style="color:green"></i>
            @else 
            <i class="fa fa-check-circle" style="display: none;color:green"></i>
            @endif Mặc định
            </a>
            <a href="javascript:void(0);" class="btn btn-xs btn-default font14 remove-image" image="{{ $image->id }}">
                <i class="fa fa-times-circle"></i> Xóa
            </a>
        </div>
        <input type="hidden" size="4" id="x-{{ $image->id }}" name="x{{ $image->id }}" readonly="readonly">
        <input type="hidden" size="4" id="y-{{ $image->id }}" name="y{{ $image->id }}" readonly="readonly">
        <input type="hidden" size="4" id="w-{{ $image->id }}" name="w{{ $image->id }}" readonly="readonly">
        <input type="hidden" size="4" id="h-{{ $image->id }}" name="h{{ $image->id }}" readonly="readonly">
    </div>
@endforeach

@section('footer-content')

    @parent
<script>
        $(document).ready(function(){
            @foreach ($product->images()->get() as $image)
            $('#Jcrop-{{$image->id}}').Jcrop({
                onChange:showCoords{{$image->id}},
                setSelect:[0,575,385,0]
            }); 

            function showCoords{{$image->id}}(c)
            {            
                $('#x-{{$image->id}}').val(c.x);
                $('#y-{{$image->id}}').val(c.y);
                $('#w-{{$image->id}}').val(c.w);
                $('#h-{{$image->id}}').val(c.h);
                $('#g-s-{{$image->id}}').show();
                $('#btn-crop-{{$image->id}}').show();
                $('#s-w-{{$image->id}}').empty().html(c.w);
                $('#s-h-{{$image->id}}').empty().html(c.h);
                if(parseInt(c.w) > 0) {
                }            
            };

            function clearCoords{{$image->id}}()
            {
                $('#g-s-{{$image->id}}').hide();
                $('#btn-crop-{{$image->id}}').hide();
                $('#x-{{$image->id}}').val('');
                $('#y-{{$image->id}}').val('');
                $('#w-{{$image->id}}').val('');
                $('#h-{{$image->id}}').val('');
            };                       
            @endforeach

            $('.cropImage').on('click', function(){
                var imageId = $(this).attr('image');
                var productId = $(this).attr('product-id');
                var imageWidth = $('#w-' + imageId).val();
                var imageHeight = $('#h-' + imageId).val();
                var xPos = $('#x-' + imageId).val();
                var yPos = $('#y-' + imageId).val();
                params = {
                        imageId:imageId,
                        imageWidth:imageWidth,
                        imageHeight:imageHeight,
                        productId:productId,
                        x:xPos,
                        y:yPos
                    };
                $.ajax({
                    url: '/admin/image/do/crop',
                    type: 'GET',
                    data: params,                 
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                })
                .done(function (data) {
                    if (data.error == false) {
                        $('#image-item-' + imageId).empty().append(data.html_img);
                        $.growl.notice({message: "Đã crop nhật ảnh đại diện!"});
                    } else {
                        $.growl.error({message: "Không thể crop ảnh đại diện!"});
                    }
                })
                .fail(function () {
                    $.growl.error({message: "Không thể crop ảnh đại diện!"});
                });
            });
        });  

        function showCoords(c, imageId)
        {            
            $('#x-' + imageId).val(c.x);
            $('#y-' + imageId).val(c.y);
            $('#w-' + imageId).val(c.w);
            $('#h-' + imageId).val(c.h);
            $('#g-s-' + imageId).show();
            $('#btn-crop-' + imageId).show();
            $('#s-w-' + imageId).empty().html(c.w);
            $('#s-h-' + imageId).empty().html(c.h);
            if(parseInt(c.w) > 0) {
            }            
        };

        function clearCoords(imageId)
        {
            $('#g-s-' + imageId).hide();
            $('#btn-crop-' + imageId).hide();
            $('#x-' + imageId).val('');
            $('#y-' + imageId).val('');
            $('#w-' + imageId).val('');
            $('#h-' + imageId).val('');
        };    
    </script>

    <script type="text/javascript">
        $('a.featured-image').on('click', function () {

            var image = $(this).attr('image');

            $.ajax({
                url: '/admin/product/{{ $product->id }}/featured-image/' + image,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                }
            })
            .done(function (json) {
                var data = JSON.parse(json);
                if (data.success) {
                    $.growl.notice({message: "Đã cập nhật ảnh đại diện!"});
                    $('i.fa-check-circle').hide();
                    //remove row
                    $('#row-image-' + image + ' i').show();

                } else {
                    $.growl.error({message: "Không thể cập nhật ảnh đại diện!"});
                }
            })
            .fail(function () {
                $.growl.error({message: "Không thể cập nhật ảnh đại diện!"});
            });
        });

        $('a.remove-image').on('click', function () {

            var image = $(this).attr('image');

            $.ajax({
                url: '/admin/product/{{ $product->id }}/delete-image/' + image,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                }
            })
            .done(function (json) {
                var data = JSON.parse(json);
                if (data.success) {
                    $.growl.notice({message: "Delete image successful!"});

                    //remove row
                    $('#row-image-' + image).fadeOut();

                } else {
                    $.growl.error({message: "Cannot delete this image!"});
                }
            })
            .fail(function () {
                $.growl.error({message: "Cannot delete this image!"});
            });
        });

    </script>

@stop
