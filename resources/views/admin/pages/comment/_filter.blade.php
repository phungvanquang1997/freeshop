<div class="row no-padding filter-container">
	<div class="col-sm-3">
        <select data-type="product" class="filter form-control select2 product-filter">
            <option value="">Sản phẩm</option>
            @forelse(\App\Product::with('comments')->get() as $key => $value)
                <option value="{{ $value->id }}" {{ Input::has('product') && Input::get('product') == $value->id ? 'selected="selected"' : '' }}>{{ $value->name }}</option>
            @empty
            @endforelse
        </select>
    </div>
    
	<div class="col-sm-2">
        <input data-type="name" type="text" class="filter form-control" value="{{ Input::has('name') ? Input::get('name') : '' }}" placeholder="Tìm theo tên">
    </div>
	<div class="col-sm-2">
        <input data-type="email" type="text" class="filter form-control" value="{{ Input::has('email') ? Input::get('email') : '' }}" placeholder="Tìm theo email">
    </div>
    <div class="col-sm-2">
        <input data-type="content" type="text" class="filter form-control" value="{{ Input::has('content') ? Input::get('content') : '' }}" placeholder="Tìm theo nội dung">
    </div>
    <div class="col-sm-2">
        <select data-type="status" class="filter form-control filter-status">

            <option value="">Tất cả</option>
            <option value="1" {{ Input::has('status') && Input::get('status') == 1 ? 'selected="selected"' : '' }}>Kích hoạt</option>
            <option value="0" {{ Input::has('status') && Input::get('status') == 0 ? 'selected="selected"' : '' }}>Vô hiệu</option>

        </select>
    </div>
</div>