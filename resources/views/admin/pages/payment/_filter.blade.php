<div class="row no-padding filter-container">

    <div class="col-sm-3">
        <input data-type="user_name" type="text" class="filter form-control" value="{{ Input::has('user_name') ? Input::get('user_name') : '' }}" placeholder="{{trans('lang.fill_user')}}">
    </div>

    <div class="col-sm-3">
        <select data-type="type" class="filter form-control">
            <option value="">{{trans('lang.specie')}}</option>
            <option value="1" {{ Input::has('type') && Input::get('type') == \App\Payment::TYPE_RECHARGE ? 'selected="selected"' : '' }}>{{trans('lang.TYPE_RECHARGE')}}</option>
            <option value="2" {{ Input::has('type') && Input::get('type') == \App\Payment::TYPE_PAY ? 'selected="selected"' : '' }}>{{trans('lang.TYPE_PAY')}}</option>
            <option value="3" {{ Input::has('type') && Input::get('type') == \App\Payment::TYPE_WITHDRAW ? 'selected="selected"' : '' }}>{{trans('lang.TYPE_WITHDRAW')}}</option>

        </select>
    </div>


</div>