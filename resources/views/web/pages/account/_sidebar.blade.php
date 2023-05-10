<div class="col-sm-3 account-sidebar">
    <div class="btn-group-vertical" role="group" aria-label="group">
        <a class="btn btn-{{ Request::url() === url('tai-khoan/ho-so.html') ? 'primary' : 'default' }}" href="{{ url('tai-khoan/ho-so.html') }}">
            <i class="fa fa-user"></i> Thông tin tài khoản
        </a>
        <a class="btn btn-{{ Request::url() === url('tai-khoan/thay-doi-mat-khau.html') ? 'primary' : 'default' }}" href="{{ url('tai-khoan/thay-doi-mat-khau.html') }}">
            <i class="fa fa-lock"></i> Đổi mật khẩu
        </a>
        <a class="btn btn-{{ Request::url() === url('tai-khoan/don-hang.html') ? 'primary' : 'default' }}" href="{{ url('tai-khoan/don-hang.html') }}">
            <i class="fa fa-tags"></i> Đơn hàng
        </a>                
        <a class="btn btn-{{ Request::url() === url('tai-khoan/dang-xuat.html') ? 'primary' : 'default' }}" href="{{ url('tai-khoan/dang-xuat.html') }}">
            <i class="fa fa-sign-out"></i> Thoát
        </a>
    </div>
</div>