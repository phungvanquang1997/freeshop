<div class="row no-padding filter-container">
	<div class="col-sm-3">
        <select data-type="product" class="filter form-control select2 product-filter">
            <option value="">Sản phẩm</option>
            @forelse(\App\Product::with('comments')->get() as $key => $value)
                <option value="{{ $value->id }}" {{ request()->has('product') && request()->get('product') == $value->id ? 'selected="selected"' : '' }}>{{ $value->name }}</option>
            @empty
            @endforelse
        </select>
    </div>
    
	<div class="col-sm-2">
        <input data-type="name" type="text" class="filter form-control" value="{{ request()->has('name') ? request()->get('name') : '' }}" placeholder="Tìm theo tên">
    </div>
	<div class="col-sm-2">
        <input data-type="email" type="text" class="filter form-control" value="{{ request()->has('email') ? request()->get('email') : '' }}" placeholder="Tìm theo email">
    </div>
    <div class="col-sm-2">
        <input data-type="content" type="text" class="filter form-control" value="{{ request()->has('content') ? request()->get('content') : '' }}" placeholder="Tìm theo nội dung">
    </div>
    <div class="col-sm-2">
        <select data-type="status" class="filter form-control filter-status">

            <option value="">Tất cả</option>
            <option value="1" {{ request()->has('status') && request()->get('status') == 1 ? 'selected="selected"' : '' }}>Kích hoạt</option>
            <option value="0" {{ request()->has('status') && request()->get('status') == 0 ? 'selected="selected"' : '' }}>Vô hiệu</option>

        </select>
    </div>
</div>