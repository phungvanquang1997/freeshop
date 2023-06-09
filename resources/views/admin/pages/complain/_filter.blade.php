<div class="row no-padding filter-container">

    <div class="col-sm-3">
        <input data-type="user_name" type="text" class="filter form-control" value="{{ Input::has('user_name') ? Input::get('user_name') : '' }}" placeholder="{{trans('lang.customer')}}">
    </div>

    <div class="col-sm-3">
        <select data-type="status" class="filter form-control">
            <option value="">{{trans('lang.status')}}</option>
            @forelse ($status as $key => $value) 
            <option value="{{ $key }}" {{ Input::has('status') && Input::get('status') == $key ? 'selected="selected"' : '' }}>{{ trans($value) }}</option>
            @empty
            @endforelse

        </select>
    </div>


</div>