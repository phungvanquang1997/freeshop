<div class="row no-padding filter-container">


    <div class="col-sm-3">
        <select data-type="brand" class="filter form-control">
            <option value="">{{trans('lang.supplier')}}</option>
            <option value="{{ App\ProductSource::BRAND_TAOBAO }}" {{ Input::has('brand') && Input::get('brand') == \App\ProductSource::BRAND_TAOBAO ? 'selected="selected"' : '' }}>TaoBao</option>
            <option value="{{ App\ProductSource::BRAND_TMALL }}" {{ Input::has('brand') && Input::get('brand') == \App\ProductSource::BRAND_1688 ? 'selected="selected"' : '' }}>TMall</option>
            <option value="{{ App\ProductSource::BRAND_TMALL }}" {{ Input::has('brand') && Input::get('brand') == \App\ProductSource::BRAND_1688 ? 'selected="selected"' : '' }}>1688</option>
        </select>
    </div>

    <div class="col-sm-3">
        <select data-type="status" class="filter form-control">
            <option value="">{{trans('lang.status')}}</option>
            <option value="1" {{ Input::has('status') && Input::get('status') == \App\ProductSource::STATUS_ACTIVE ? 'selected="selected"' : '' }}>{{trans('lang.activate')}}</option>
            
            <option value="0" {{ Input::has('status') && Input::get('status') == \App\ProductSource::STATUS_INACTIVE ? 'selected="selected"' : '' }}>{{trans('lang.deactivate')}}</option>

        </select>
    </div>

    <div class="col-sm-3">
        <select data-type='category_id' class="filter form-control">
            <option value="">{{trans('lang.categories')}}</option>
            @if($categories) 
               {!! $categories !!}
            @endif
        </select>
    </div>


</div>