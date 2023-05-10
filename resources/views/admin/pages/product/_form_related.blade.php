
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
    {!! App\Helpers\MyHtml::label(null, 'Chọn danh mục', true) !!}
    <div class="col-sm-7">
        <select class="form-control select2" id="js-category-selected">
            <option value="">Root</option>
            @if ($categories)
               {!! $categories !!}
            @endif
        </select>
    </div>
</div>

<div class="form-group">
    {!! App\Helpers\MyHtml::label(null, 'Chọn sản phẩm', true) !!}
    <div class="col-sm-7">
        <select class="form-control select2" name="related_products[]" id="related_products" multiple="multiple">          
        </select>
    </div>
</div>

<table id="data-related" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th width="40">ID</th>
        <th>Tên sản phẩm</th>
        <th width="90">Hình ảnh</th>
        <th>Model</th>
        <th width="15%">Danh mục</th>
        <th>Giá (đ)</th>
        <th width="90"></th>
    </tr>
    </thead>
    <tbody>
    	@if (isset($relatedProducts) && count($relatedProducts) > 0)
    		@foreach ($relatedProducts as $item)    		
    	<tr>
    		<td>{{$item->id}}</td>
    		<td>{{$item->name}}</td>
    		<td class="text-center">
                @if (isset($item->images[0]))
                <img width="50" src="{{ MyHtml::showThumb($item->images[0]->image, 'product') }}" alt="">
                @endif   			
    		</td>
            <td>{{ $item->model }}</td>
            <td>{{ $item->category->name }}</td>
            <td>{{ number_format($item->price) }}</td>
            <td>
            	<a href="/admin/product/delete-related/{{$product->id}}/{{$item->id}}" class="btn btn-danger" onclick="confirm('Bạn chắc chắn muốn xóa sản phẩm gợi ý này?');">Xóa</a>
            </td>    		
    	</tr>
    		@endforeach
    	@endif
    </tbody>
</table>

@section('footer-content')

    @parent

    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('js/icheck.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".select2").select2();
            $('#js-category-selected').on('change', function(){
            	var categoryId = $(this).val();
            	getProducts(categoryId);
            });
        });

	    function getProducts(categoryId)
	    {
	        $('#related_products').select2({
	            placeholder: "Chọn sản phẩm",
	            allowClear: true
	        });
	        var products = [];
	        $.ajax({
	            type: 'get',
	            url: "/admin/products-by-category/" + categoryId,
	            data: {categoryId:categoryId},
	            dataType: 'json',
	            success: function (data) {
	                if (categoryId == null) {
	                    products.push({id:data.id, text:data.name});
	                } else {
	                    $.each(data, function(k, v) {
	                        products.push({id:v.id, text:v.name});
	                    });
	                }
	                $('#related_products').select2({
	                    allowClear: true,
	                    placeholder: "Chọn sản phẩm",
	                    data: products,
	                });
	            },
	            error: function (jqXhr) {
	                showErrorResponse(jqXhr, '');
	            }
	        })
	    }        
    </script>
@stop
