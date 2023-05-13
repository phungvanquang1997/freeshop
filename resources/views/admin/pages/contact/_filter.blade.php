<div class="row no-padding filter-container">
	 <div class="col-sm-2">
        <select data-type="type" class="filter form-control filter-type">

            <option value="">--Loại--</option>
            <option value="1" {{ request()->has('type') && request()->get('type') == 1 ? 'selected="selected"' : '' }}>Liên hệ</option>
            <option value="2" {{ request()->has('type') && request()->get('type') == 2 ? 'selected="selected"' : '' }}>Hợp tác</option>

        </select>
    </div>
    
	<div class="col-sm-2">
        <input data-type="name" type="text" class="filter form-control" value="{{ request()->has('name') ? request()->get('name') : '' }}" placeholder="Tìm theo tên">
    </div>
	<div class="col-sm-2">
        <input data-type="email" type="text" class="filter form-control" value="{{ request()->has('email') ? request()->get('email') : '' }}" placeholder="Tìm theo email">
    </div>
    <div class="col-sm-2">
        <input data-type="phone" type="text" class="filter form-control" value="{{ request()->has('phone') ? request()->get('phone') : '' }}" placeholder="Tìm theo SĐT">
    </div>
    <div class="col-sm-2">
        <input data-type="content" type="text" class="filter form-control" value="{{ request()->has('content') ? request()->get('content') : '' }}" placeholder="Tìm theo nội dung">
    </div>
   
</div>