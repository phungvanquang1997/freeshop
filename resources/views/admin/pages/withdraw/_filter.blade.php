<div class="row no-padding filter-container">

    <div class="col-sm-3">
        <input data-type="user_name" type="text" class="filter form-control" value="{{ request()->has('user_name') ? request()->get('user_name') : '' }}" placeholder="{{trans('lang.fill_user')}}">
    </div>

    <div class="col-sm-3">
        <select data-type="status" class="filter form-control">
            <option value="">{{trans('lang.status')}}</option>
            <option value="1" {{ request()->has('status') && request()->get('status') == \App\Withdraw::STATUS_UNVERIDIED ? 'selected="selected"' : '' }}>{{trans('lang.STATUS_UNVERIDIED')}}</option>
            <option value="2" {{ request()->has('status') && request()->get('status') == \App\Withdraw::STATUS_VERIFIED ? 'selected="selected"' : '' }}>{{trans('lang.STATUS_VERIDIED')}}</option>
            <option value="3" {{ request()->has('status') && request()->get('status') == \App\Withdraw::STATUS_SUCCESS ? 'selected="selected"' : '' }}>{{trans('lang.STATUS_SUCCESS')}}</option>
            <option value="3" {{ request()->has('status') && request()->get('status') == \App\Withdraw::STATUS_INACTIVE ? 'selected="selected"' : '' }}>{{trans('lang.STATUS_INACTIVE')}}</option>

        </select>
    </div>


</div>