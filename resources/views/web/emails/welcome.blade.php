<p>Xin chào {{ $name }},</p>

<p>Cám ơn Bạn đã đăng ký thành viên của AOGIASI.COM.</p>

<p><b>Tài khoản: </b>{{ $to }}</p>
<p><b>Mật khẩu: </b>{{ $password }}</p>

<p>Bấm vào link: {{ url('/tai-khoan/xac-nhan-tai-khoan/' . $auth_token) }} để kích hoạt tài khoản.</p>

<p>Chúc bạn có những trải nghiệm mua sắm thú vị khi sử dụng dịch vụ đặt hàng của {{$site_name}}.</p>

<p>Quý khách vui lòng không trả lời thư này.</p>