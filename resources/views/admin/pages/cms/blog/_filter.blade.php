<div class="row no-padding filter-container">
    <form method="GET" action="{{ url('admin/article') }}">
        <div class="col-sm-2">
            <input name="name" type="text" class=" form-control" value="{{ Input::has('name') ? Input::get('name') : '' }}" placeholder="Tiêu đề">
        </div>
        <div class="col-sm-3">
            <select data-type="category_id" class="filter form-control">
                <option value="">{{trans('lang.categories')}}</option>
                @forelse($categories as $category)
                    <option value="{{ $category->id }}" {{ Input::get('category_id') == $category->id ? 'selected="selected"' : '' }}>{{ $category->name }}</option>
                @empty
                @endforelse
            </select>
        </div>

        <div class="col-sm-3 talign-r">
            <select data-type="special" class="filter form-control">
                <option value="">{{trans('lang.type_featured')}}</option>
                <option value="0" {{ Input::has('special') && Input::get('special') == 0 ? 'selected="selected"' : '' }}>{{trans('lang.popular')}}</option>
                <option value="1" {{ Input::get('special') == 1 ? 'selected="selected"' : '' }}>{{trans('lang.featured')}}</option>
            </select>
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>
</div>