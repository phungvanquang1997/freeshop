<div class="row no-padding filter-container">

    <div class="col-sm-2">
        <select data-type="is_admin" class="filter form-control">

            <option value="0">{{trans('lang.customer')}}</option>
            <option value="1" {{ request()->has('is_admin') && request()->get('is_admin') == \App\User::IS_ADMIN ? 'selected="selected"' : '' }}>{{trans('lang.admin')}}</option>

        </select>
    </div>

   <div class="col-sm-2">
        <select data-type="status" class="filter form-control">
            <option value="">{{trans('lang.status')}}</option>
            <option value="1" {{ request()->has('status') && request()->get('status') == \App\User::STATUS_ACTIVE ? 'selected="selected"' : '' }}>{{trans('lang.activate')}}</option>
            <option value="0" {{ request()->has('status') && request()->get('status') == \App\User::STATUS_INACTIVE ? 'selected="selected"' : '' }}>{{trans('lang.deactivate')}}</option>

        </select>
    </div>

    <div class="col-sm-3">
        <input data-type="user_name" type="text" class="filter form-control" value="{{ request()->has('user_name') ? request()->get('user_name') : '' }}" placeholder="{{trans('lang.fill_user')}}">
    </div>

    <div class="col-sm-3">
        <input data-type="user_email" type="text" class="filter form-control" value="{{ request()->has('user_email') ? request()->get('user_email') : '' }}" placeholder="{{trans('lang.fill_email')}}">
    </div>
	
    <div class="col-sm-2 text-right">
        @if (Auth::user()->group == \App\User::IS_ADMINISTRATOR)
		<a class="btn btn-primary" href="{{ url('admin/user/create') }}">{{trans('lang.add_admin')}}</a>
        @endif
    </div>

</div>