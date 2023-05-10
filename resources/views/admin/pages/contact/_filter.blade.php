<div class="row no-padding filter-container">
	 <div class="col-sm-2">
        <select data-type="type" class="filter form-control filter-type">

            <option value="">--Loại--</option>
            <option value="1" {{ Input::has('type') && Input::get('type') == 1 ? 'selected="selected"' : '' }}>Liên hệ</option>
            <option value="2" {{ Input::has('type') && Input::get('type') == 2 ? 'selected="selected"' : '' }}>Hợp tác</option>

        </select>
    </div>
    
	<div class="col-sm-2">
        <input data-type="name" type="text" class="filter form-control" value="{{ Input::has('name') ? Input::get('name') : '' }}" placeholder="Tìm theo tên">
    </div>
	<div class="col-sm-2">
        <input data-type="email" type="text" class="filter form-control" value="{{ Input::has('email') ? Input::get('email') : '' }}" placeholder="Tìm theo email">
    </div>
    <div class="col-sm-2">
        <input data-type="phone" type="text" class="filter form-control" value="{{ Input::has('phone') ? Input::get('phone') : '' }}" placeholder="Tìm theo SĐT">
    </div>
    <div class="col-sm-2">
        <input data-type="content" type="text" class="filter form-control" value="{{ Input::has('content') ? Input::get('content') : '' }}" placeholder="Tìm theo nội dung">
    </div>
   
</div>