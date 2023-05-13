<div class="row no-padding filter-container">
    <form method="GET" action="{{ url('admin/product') }}">    <div class="col-sm-2">
        <input name="name" type="text" class=" form-control" value="{{ request()->has('name') ? request()->get('name') : '' }}" placeholder="Tên sản phẩm">
    </div>
    <div class="col-sm-3">
        <select class="select2 form-control" name="category_id">
            <option value="0">--Danh mục--</option>
            @if($categories)
               {!! $categories !!}
            @endif
        </select>
    </div>
    <div class="col-sm-2">
        <select data-type="status" name="status" class="filter form-control">
            <option value="">Tất cả</option>
            @forelse(\App\Product::allStatus() as $key => $value)
                <option value="{{ $key }}" {{ request()->has('status') && request()->get('status') == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
            @empty
            @endforelse
        </select>
    </div>    
    <div class="col-sm-2">
        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
    </div>
    </form>
</div>